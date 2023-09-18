@extends('layouts.template_admin')

@section('content')
<div class="d-flex bg-200 mb-3 flex-row-reverse">

</div>
<div id="tableExample2" data-list='{"valueNames":["pedido", "linea", "usuario", "grupo", "fecha", "entregado", "entregado_x"],"page":25,"pagination":true}'>
    <div class="table-responsive scrollbar">
      <table class="table table-bordered table-striped fs--2 mb-0">
        <div class="search-box" data-list='{"valueNames":["pedido", "linea", "usuario", "grupo", "fecha", "entregado", "entregado_x"]}'>
            <input class="form-control search-input fuzzy-search" type="search" placeholder="Buscar..." aria-label="Search"/>
            <span class="fas fa-search search-box-icon"></span>
        </div> 
    </br>
        <thead class="bg-500 text-900">
          <tr>
            <th class="text-center sort" >N°</th>
            <th class="text-center sort" data-sort="pedido">Pedido</th>
            <th class="text-center sort" data-sort="linea">Línea</th>
            <th class="text-center sort" data-sort="usuario">Usuario del Pedido</th>
            <th class="text-center sort" data-sort="grupo">Grupo</th>
            <th class="text-center sort" data-sort="fecha">Fecha</th>
            <th class="text-center sort" data-sort="entregado">Entregado a</th>
            <th class="text-center sort" data-sort="firma">Firma</th>
            <th class="text-center sort" data-sort="entregado_x">Entregado x</th>
          </tr>
        </thead>
        <tbody class="list">
            @php
                $n = 1;
                $color = 'green';
            @endphp
            @foreach ($entregas as $entrega)
                <tr>
                    <td class="text-center">{{ $n }}</td>
                    <td class="text-end pedido">{{ $entrega->pedido }}</td>
                    <td class="text-center linea">{{ $entrega->linea }}</td>
                    <td class="usuario">{{ $entrega->usuario_pedido }}</td>
                    <td class="text-center grupo">{{ $entrega->group->group }}</td>
                    <td class="text-center fecha">{{ $entrega->created_at }}</td>
                    <td class="entregado">{{ $entrega->usuario_entrega }}</td>
                    <td class="text-center firma">{{ $entrega->firma }}</td>
                    <td class="text-center entregado_x">{{ $entrega->user->name }}</td>
                </tr>
                @php
                    $n++;
                @endphp
            @endforeach
        </tbody>
      </table>
    </div>
    <div class="d-flex justify-content-center mt-3">
      <button class="btn btn-sm btn-falcon-default me-1" type="button" title="Previous" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
      <ul class="pagination mb-0"></ul>
      <button class="btn btn-sm btn-falcon-default ms-1" type="button" title="Next" data-list-pagination="next"><span class="fas fa-chevron-right"> </span></button>
    </div>
</div>
@endsection