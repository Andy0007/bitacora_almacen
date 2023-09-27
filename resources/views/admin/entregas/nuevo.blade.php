@extends('layouts.template_admin')

@section('content') 

<div class="card mb-3">
    <div class="card-header">
      <h5 class="mb-0">Registro Nuevo</h5>
    </div>
    <div class="card-body bg-light">
        <form action="{{ route('admin_firma_entrega.nuevo') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="row gx-2">          
                <div class="col-sm-1 mb-3">
                    <input type="text" class="form-control" id="action_by" name="action_by"
                    value="{{auth()->user()->id}}" hidden>
                </div> 
                <div class="col-sm-5 mb-3">
                    @error('pedido')
                        <button type="text" disabled class="btn btn-danger btn-block" id="error" name="error">
                            {{$message}}
                        </button> 
                    @enderror
                    @error('linea')
                        <button type="text" disabled class="btn btn-danger btn-block" id="error" name="error">
                            {{$message}}
                        </button> 
                    @enderror
                    @error('usuario_pedido')
                        <button type="text" disabled class="btn btn-danger btn-block" id="error" name="error">
                            {{$message}}
                        </button> 
                    @enderror
                    @error('usuario_entrega')
                        <button type="text" disabled class="btn btn-danger btn-block" id="error" name="error">
                            {{$message}}
                        </button> 
                    @enderror
                </div> 


                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="event-venue">Subir Evidencia</label>
                    <input class="form-control"  type="file" name="image" id="image" />
                </div>
                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="event-venue">Entregado a</label>
                    <input class="form-control" id="usuario_entrega" name="usuario_entrega" type="text" value="{{ old('usuario_entrega') }}" />
                </div>
                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="event-venue">Departamento</label>
                    <select class="form-control" id="group_id" name="group_id">
                        @foreach ($grupos as $grupo)                    
                            <option value="{{ $grupo->id }}">{{ $grupo->group }}</option> 
                        @endforeach 
                    </select>                        
                </div>

                
                <div class="col-sm-6 mb-3">
                    <a id="h1btn" name="h1btn" href="#" class="btn btn-primary btn-block mb-3" onclick="agrega(); "> + </a> 
                </div>
                <div class="col-sm-6 mb-3">
                </div>
                

                <div  class="col-sm-12 mb-3 row">
                    <div class="text-center col-lg-1">
                        <label class="form-label" for="event-venue">N°</label>
                    </div>
                    <div class="col-sm-2 mb-2">
                        <label class="form-label" for="event-venue">Pedido / Guía</label>
                    </div>
                    <div class="col-sm-1 mb-2">
                        <label class="form-label" for="event-venue">Línea</label>
                    </div>
                    <div class="col-sm-2 mb-2">
                        <label class="form-label" for="event-venue">Descripción</label>
                    </div>
                    <div class="col-sm-1 mb-2">
                        <label class="form-label" for="event-venue">Cantidad</label>
                    </div>
                    <div class="col-sm-2 mb-2">
                        <label class="form-label" for="event-venue">Factura</label>
                    </div>
                    <div class="col-sm-2 mb-2">
                        <label class="form-label" for="event-venue">Dueño del Pedido</label>
                    </div>
                    <div class="col-sm-1 mb-2">
                        <label class="form-label" for="event-venue">Eliminar</label>
                    </div>
                </div>
                
                <div id="dinamic">
                </div>  
                
                
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Registrar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
    @error ('user')
        @if ($message == 'inactivo')
            <script>
                Swal.fire({
                    title: 'El usuario ya existe, ¿Desea activarlo?',
                    showDenyButton: true,
                    confirmButtonText: 'Ir',
                    denyButtonText: `No`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        window.location.href = "usuarios_inactvos";
                    }
                })
            </script>        
        @endif
    @enderror
    
    <script>
        nrow=0;
        function agrega(){
            nrow++;
            console.log(nrow);
            console.log("Ingresarás un nuevo elemento")
            $("#dinamic").append("<div class='row' id='ag"+nrow+"'>" +
                "<div class='text-center col-sm-1 mb-2'>"+nrow+"</div>"+
                "<div class='col-sm-2 mb-2'><input class='form-control' name='pedido[]' id='pe"+nrow+"' placeholder='Pedido' required></div>"+
                "<div class='col-sm-1 mb-2'><input class='form-control' name='linea[]' id='lin"+nrow+"' placeholder='Línea' required></div>"+
                "<div class='col-sm-2 mb-2'><input class='form-control' name='descripcion[]' id='desc"+nrow+"' placeholder='Descripcion' required></div>"+
                "<div class='col-sm-1 mb-2'><input class='form-control' name='cantidad[]' id='cant"+nrow+"' placeholder='Cantidad' required></div>"+
                "<div class='col-sm-2 mb-2'><input class='form-control' name='factura[]' id='fac"+nrow+"' placeholder='Factura'></div>"+
                "<div class='col-sm-2 mb-2'><input class='form-control' name='usuario_pedido[]' id='usu_ped"+nrow+"' placeholder='Dueño del Pedido' required></div>"+
                "<div class='col-sm-1 mb-2'><button class='btn btn-outline-danger' onclick='elimina();return false;' >X</button></div>"+
            "</div>");
        }
        function elimina(index){
            console.log("Ingresa a eliminar input");
            $("#ag"+nrow).remove();
            nrow--;
            console.log(nrow);
        
        }
    </script>
@endsection