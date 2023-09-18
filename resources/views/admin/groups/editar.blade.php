@extends('layouts.template_admin')

@section('content')
@php
    $activo = '';
    $inactivo = '';
    if ($grupos->status == 'activo') {
        $activo = 'selected';
    } else {
        $inactivo = 'selected';
    }
    
@endphp

<div class="card mb-3">
    <div class="card-header">
      <h5 class="mb-0">Editar Departamento</h5>
    </div>
    <div class="card-body bg-light">
        <form  action="{{ route('grupos.actualizar') }}" method="POST">
        @csrf
            <div class="row gx-2">             
                <div class="col-sm-12 mb-3">
                    <input type="text" class="form-control" id="id" name="id"
                    value="{{ $grupos->id }}" hidden>
                    @error('group')
                        <small type="text" class="btn btn-danger btn-block">
                            {{$message}}
                        </small> 
                    @enderror
                </div> 
                <div class="col-sm-3 mb-3">
                    <label class="form-label" for="event-venue">Grupo</label>
                    <input class="form-control" id="group" name="group" type="text" value="{{ $grupos->group }}"/>
                </div>
                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="event-venue">Descripción</label>
                    <input class="form-control" id="description" name="description" type="text" value="{{ $grupos->description }}" />
                </div>
                <div class="col-sm-3">
                    <label class="form-label" for="time-zone">Estatus</label>
                    <select class="form-select" id="status" name="status">
                        <option value="activo" {{$activo}}> Activo</option>
                        <option value="inactivo" {{$inactivo}}> Inactivo </option>     
                    </select>
                </div> 
                            
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection