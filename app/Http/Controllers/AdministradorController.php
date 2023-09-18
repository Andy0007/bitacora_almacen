<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Article;
use App\Models\Category;
use App\Models\Role;
use App\Models\Group;
use App\Models\User;
use App\Models\Ldap;
use App\Mail\ResetPass;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Mail\SalidasMailable;
use Faker\Provider\ar_EG\Person;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\GroupsEditRequest;
use App\Models\Entregas;
use Illuminate\Http\Request;
use LengthException;

class AdministradorController extends Controller
{
    //Rutas del perfil de Administrador

    public function index_admin(){

        $ruta = '';

        $fecha = Carbon::now();
        $esteMes = $fecha->format('m');
        $esteAno = $fecha->format('Y');

        $entregas = Entregas::query()->whereMonth('created_at', $esteMes)->whereYear('created_at', $esteAno)->get();
        //return $entregas;
                
        return view('admin.index', compact('ruta', 'entregas'));
    }

    /****************************************/
    /************* Usuarios *****************/
    /****************************************/
    
    public function users_index(){

        $ruta = '';
        $usuarios = User::with('group', 'role')->get();
        $user = auth()->user()->user;

        return view('admin.users.index', compact('usuarios', 'user', 'ruta'));
    }

    public function password($id){

        //return "Este es el id -> $id";
        $ruta = '../';
        $usuarios = User::find($id);

        return view('admin.users.pass', compact('usuarios', 'ruta'));
    }
    
    public function actualizar_password(Request $request){
        
        $this->validate(request(), [
            'password' => 'required|min:8',
            'password1' => 'required|min:8',
            'password1' => 'same:password',
        ],
        [
            'password.required' => 'La contraseña es obligatoria',
            'password.min' => 'La contraseña debe ser de 8 caracteres mínimo',
            'password.same' => 'Las contraseñas no coinciden',
            'password1.same' => 'Las contraseñas no coinciden',
        ]
        );

        $id = request (['id']);
        $datos = User::with('group', 'role')->where(['id' => $id])->get();
        
        foreach($datos as $user){

        }
        $usuario = User::query()->where(['id' => $id])->update(['password' => bcrypt($request->password)]);

        if(empty($user->email)){
            
        }else{
            $email[] = $user->email;            
            $correo = new ResetPass($user->name, request('password'));            
            Mail::to($user->email)->send($correo);
        }        

        return  redirect()->to('/admin_usuarios')->with('pass', $user->name);
    }
    
    public function users_nuevo(){

        $ruta = '';
        $roles = Role::query()->orderBy('role')->get();
        $grupos = Group::all();
        $ldap = Ldap::all();

        return view('admin.users.nuevo', compact('roles', 'grupos', 'ruta', 'ldap'));
    }

    public function users_crear(){
        
        $this->validate(request(), [
                'user' => 'required|unique:users',
                'name' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required|min:8',
                'pass2' => 'required|same:password',
            ],
            [
                'user.required' => 'El usuario es obligatorio',
                'user.unique' => 'Usuario Duplicado',
                'name.required' => 'El nombre es obligatorio',
                'email.required' => 'El email es obligatorio',
                'email.unique' => 'El email ya está en uso',
                'password.required' => 'La contraseña es obligatoria',
                'pass2.required' => 'La validación de la contraseña es obligatoria',
                'password.min' => 'La contraseña debe ser de 8 caracteres mínimo',
            ]
        );

        
        $usuario = User::create(request(['user', 'auten', 'name', 'email', 'password', 'comment1', 'comment2', 'role_id', 'group_id', 'action_by']));
        $last = User::all()->last()->id;

        $ruta = '../storage/app/avatars/';
        if(request()->hasFile('image')){

            //return 'Sí hay imagen';
            $imagen = request()->file('image');
            $nombre_imagen = Str::slug(request()->user).".".$imagen->guessExtension();
            //return $nombre_imagen;

            copy($imagen->getRealPath(), $ruta.$nombre_imagen);
            
            $update = User::query()->where(['id' => $last])->update(['ext'=>$imagen->guessExtension()]);
        }
        
        return  redirect()->to('/usuarios_index')->with('user_add', $usuario->user);
    }

    public function editar($id){

        //return "Este es el id -> $id";
        $ruta = '../';
        $usuarios = User::find($id);
        $grupos = Group::all()->where('status', 'activo');
        $roles = Role::all();
        $ldap = Ldap::all();

        return view('admin.users.editar', compact('usuarios', 'grupos', 'roles', 'ruta', 'ldap'));
    }

    public function actualizar(UserEditRequest $request){
        

        $id = request (['id']);
        $logged_user = auth()->user()->id;

        $updateuser = User::query()->where(['id' => $id])->update(request(['user', 'name', 'email', 'role_id', 'group_id', 'auten', 'comment1', 'comment2', 'status']));
        $usuario = User::query()->where(['id' => $id])->update(['action_by' => $logged_user]);
        $user = User::find($id);

        $ruta = '../storage/app/avatars/';
        if(request()->hasFile('image')){

            //return 'Sí hay imagen';
            $imagen = request()->file('image');
            $nombre_imagen = Str::slug(request()->user).".".$imagen->guessExtension();
            //return $nombre_imagen;

            copy($imagen->getRealPath(), $ruta.$nombre_imagen);
            $updateext = User::query()->where(['id' => $id])->update(['ext' => $imagen->guessExtension()]);
        }

        //return $user;
        $mensaje = "".$user[0]->user;

        return  redirect()->to('/usuarios_index')->with('user_update', $mensaje);
    }

    public function inactivar($id){

        $logged_user = auth()->user()->id;

        $usuario = User::query()->where(['id' => $id])->update(['status' => 'inactivo', 'action_by' => $logged_user]);

        return  redirect()->to('/admin_usuarios');
    }

    public function activar($usuario){

        $logged_user = auth()->user()->id;

        $usuario = User::query()->where(['user' => $usuario])->update(['status' => 'activo', 'action_by' => $logged_user]);

        return  redirect()->to('/admin_usuarios');
    }

    
    /****************************************/
    /*************** Grupos *****************/
    /****************************************/
    
    public function grupos_admin(){

        $ruta = '';
        $grupos = Group::all()->whereNotIn('group', 'default')->sortBy('group');
        $user = auth()->user()->user;

        return view('admin.groups.index', compact('grupos', 'user', 'ruta'));
    }

    public function nuevo_grupo(){

        $ruta = '';
        return view('admin.groups.nuevo', compact('ruta'));
    }

    public function crear_grupo(){

        $this->validate(request(), [
                'group' => 'required|unique:groups',
            ],
            [
                'group.required' => 'El Nombre del Grupo es Obligatorio',
                'group.unique' => 'El Grupo ya existe',
            ]
        );
        
        $logged_user = auth()->user()->id;
        //return request();
        $grupo = Group::create(request(['group', 'description', 'action_by']));
        return  redirect()->to('/admin_grupos')->with('group_add', $grupo->group);
    }

    public function editar_grupo($id){

        $ruta = '../';
        //return "Este es el id -> $id";
        $grupos = Group::find($id);

        return view('admin.groups.editar', compact('grupos', 'ruta'));
    }

    public function actualizar_grupo(GroupsEditRequest $request){
        //return 'Actualizar Grupos';
        $id = request (['id']);
        $logged_user = auth()->user()->id;

        $updateuser = Group::query()->where(['id' => $id])->update(request(['group', 'description', 'status']));
        $usuario = Group::query()->where(['id' => $id])->update(['action_by' => $logged_user]);

        return  redirect()->to('/admin_grupos')->with('group_update', request()->group);
    }

    public function inactivar_grupo($id){

        $logged_user = auth()->user()->id;

        $grupo = Group::query()->where(['id' => $id])->update(['status' => 'inactivo', 'action_by' => $logged_user]);

        return  redirect()->to('/admin_grupos');
    }

    public function categorias_grupo($id){
        //return $id;
        $ruta = '../';
        
        //return "Este es el id -> $id";
        $grupos = Group::find($id);
        $categorias = Category::with('categoria')->whereNot('category', 'default')->whereIn('group_id', [$id, 1])->get();
        //$perm = PermCategories::where('group_id', '');
        //return $categorias;

        return view('admin.groups.categorias', compact('grupos', 'categorias', 'ruta'));
    }

    public function categorias_crear_grupo(){

        $perm = request()->perm;
        $grupo = request()->group_id;
        //return request();
        
        if($perm == null){
            return  redirect()->route('grupos.categorias', [$grupo]);
        }else{
            foreach($perm as $cat){
                $updateCategorias = Category::query()->where(['id' => $cat])->update(request(['group_id', $grupo]));
            }   
            return  redirect()->route('grupos.categorias', [$grupo]);         
        }
        //return $long;

        
    }

    public function categorias_default_grupo($id, $grupo){
        
        $updateCategory = Category::query()->where(['id' => $id])->update(['group_id' => 1]);
        
        return  redirect()->route('grupos.categorias', [$grupo]);
    }

    /****************************************/
    /***************** LDAP *****************/
    /****************************************/ 
    public function server_ldap(){
        $ruta = '';

        $ldap = Ldap::all();

        //return $ldap->count();
        return view('admin.ldap.editar', compact('ldap', 'ruta'));
    }

    public function editar_ldap(){
        //return request();

        if(request()->ldap_status == 'on'){
            $ldap_status = Ldap::query()->where(['id' => 1])->update(['ldap_status' => 1]);
        }else{
            $ldap_status = Ldap::query()->where(['id' => 1])->update(['ldap_status' => 0]);
        }
        $ldap = Ldap::query()->where(['id' => 1])->update(['ldap_server' => request()->ldap_server, 'ldap_port' => request()->ldap_port, 'ldap_domain' => request()->ldap_domain, 'ldap_version' => request()->ldap_version, 'ldap_user' => request()->ldap_user, 'ldap_password' => request()->ldap_password]);
        
        return  redirect()->to('/server_ldap')->with('ldap_msg', "Actualización Exitosa");
    }

    public function probar_ldap(){
        $ldap = Ldap::all();
        //return $ldap;

        $ldap_server = $ldap[0]->ldap_server;
        $ldap_dominio = $ldap[0]->ldap_domain;
        $ldap_port = $ldap[0]->ldap_port;
        $ldap_user = $ldap[0]->ldap_user.'@'.$ldap_dominio;
        $ldap_pass =  $ldap[0]->ldap_password;
        $ldap_version = $ldap[0]->ldap_version;

        $ldap_conn = ldap_connect($ldap_server, $ldap_port);
        ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, $ldap_version);
        ldap_set_option($ldap_conn, LDAP_OPT_REFERRALS, 0);

        if(@ldap_bind($ldap_conn, $ldap_user, $ldap_pass)){
            return  redirect()->to('/server_ldap')->with('ldap_msg', "Conexión Exitosa");
        }else{
            return  redirect()->to('/server_ldap')->with('ldap_msg', "Conexión Fallida");
        }
    }
    
    /****************************************/
    /************** Entregas ****************/
    /****************************************/
    
    public function entregas_admin(){
        $ruta = '';

        $fecha = Carbon::now();
        $esteMes = $fecha->format('m');
        $esteAno = $fecha->format('Y');

        $entregas = Entregas::query()->whereMonth('created_at', $esteMes)->whereYear('created_at', $esteAno)->get();
        return view('admin.entregas.index', compact('entregas', 'ruta'));
    }

    public function entrega_nueva(){
        $ruta = '';
        $grupos = Group::query()->whereNot('group', 'default')->get()->sortBy('group');
        
        return view('admin.entregas.nuevo', compact('ruta', 'grupos'));
    }

    public function resumen_entrega_nueva(){
        $ruta = '';

        $entrega = Entregas::create(request(['pedido', 'linea', 'factura', 'usuario_pedido', 'usuario_entrega', 'group_id', 'action_by']));
        $last = Entregas::all()->last()->id;

        $ruta = '../storage/app/evidencias/';
        if(request()->hasFile('image')){

            //return 'Sí hay imagen';
            $imagen = request()->file('image');
            $nombre_imagen = Str::slug(request()->pedido)."-".request()->linea.".".$imagen->guessExtension();
            //return $nombre_imagen;

            copy($imagen->getRealPath(), $ruta.$nombre_imagen);
            
            $update = Entregas::query()->where(['id' => $last])->update(['evidencia'=>$nombre_imagen]);
        }
        return 'Test';
        return view('admin.entregas.nuevo', compact('ruta', 'grupos'));
    }

}