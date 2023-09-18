@extends('layouts.template_admin')

@section('content') 

<div class="card mb-3">
    <div class="card-header">
      <h5 class="mb-0">Registro Nuevo</h5>
    </div>
    <div class="card-body bg-light">
        <form action="{{ route('admin_resumen_entrega.nuevo') }}" method="POST" enctype="multipart/form-data">
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
                    <label class="form-label" for="event-venue">Pedido (Subir en Formato de 10 dígitos)</label>
                    <input class="form-control" id="pedido" name="pedido" type="text" value="{{ old('pedido') }}" />
                </div>
                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="event-venue">Línea</label>
                    <input class="form-control" id="linea" name="linea" type="text" value="{{ old('linea') }}" />
                </div>
                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="event-venue">Factura</label>
                    <input class="form-control" id="factura" name="factura" type="text" value="{{ old('factura') }}" />
                </div>
                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="event-venue">Dueño del Pedido</label>
                    <input class="form-control" id="usuario_pedido" name="usuario_pedido" type="text" value="{{ old('usuario_pedido') }}" />
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
                            
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Guardar
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
@endsection