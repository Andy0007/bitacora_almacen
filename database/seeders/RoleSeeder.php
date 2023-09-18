<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Grupo de Administración
        $role1 = new Role();
        $role1->role = "administrador";
        $role1->description = "Grupo de Admnistración";
        $role1->save();

        //Autorizacion por grupos
        $role2 = new Role();
        $role2->role = "usuario";
        $role2->description = "Rol para la operación del sistema";
        $role2->save();

        //Grupo de Recepcion de materiales
        $role3 = new Role();
        $role3->role = "visualizador";
        $role3->description = "Rol para busquedas en el sistema";
        $role3->save();

        
    }
}
