@extends('layouts.template_admin')

@section('title', 'Dashboards')

@section('content')
  <!-- Contenido -->
<div id="tableExample2" data-list='{"valueNames":["pedido","usuario_pedido","usuario_entrega", "action_by"],"page":10,"pagination":true}'>
  <div class="table-responsive scrollbar">
    <table class="table table-bordered table-striped fs--2 mb-0">
      <div class="d-flex bg-200 mb-3 flex-row-reverse">
        <a href="{{ route('admin_entrega.nuevo') }}" class="btn btn-primary btn-sm" title="Nueva Entrega"><i class="text-100 fas fa-plus-circle"></i></a>
        
        <div class="search-box" data-list='{"valueNames":["pedido", "usuario_pedido", "usuario_entrega", "factura"]}'>
          <input class="form-control search-input fuzzy-search" type="search" placeholder="Buscar Entrega..." aria-label="Search" data-column="3"/>
          <span class="fas fa-search search-box-icon"></span>          
        </div> 
      </div>
    </br>
      <thead class="bg-500 text-900">
        <tr>
          <th class="text-center sort" >N°</th>
          <th class="text-center sort" data-sort="pedido">Pedido/Guía</th>
          <th class="text-center sort" data-sort="factura">Factura</th>
          <th class="text-center sort" data-sort="linea">Línea</th>
          <th class="text-center sort" data-sort="usuario_pedido">Usuario del Pedido</th>
          <th class="text-center sort" data-sort="usuario_entrega">Entregado A</th>
          <th class="text-center sort" data-sort="grupo">Grupo</th>
          <th class="text-center sort" data-sort="action_by">Entregado Por</th>
          <th class="text-center sort" data-sort="created_at">Fecha</th>
        </tr>
      </thead>
      <tbody class="list">
          @php
              $n = 1;
          @endphp
          @foreach ($entregas as $row)
          <tr>
              <td>{{ $n }}</td>
              <td class="pedido">{{ $row->pedido }}</td>
              <td class="pedido">{{ $row->factura }}</td>
              <td class="linea">{{ $row->linea }}</td>
              <td class="usuario_pedido">{{ $row->usuario_pedido }}</td>
              <td class="usuario_entrega">{{ $row->usuario_entrega }}</td>
              <td class="grupo">{{ $row->group_id }}</td>
              <td class="action_by">{{ $row->action_by }}</td>
              <td class="created_at">{{ $row->created_at }}</td>
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
  <!-- Contenido -->
@endsection
@section('script')

@if (session('resguardo_add'))
  <script>
      Swal.fire({
          title: "Artículos Asignados a:",
          text: "{{ session('resguardo_add') }}",
          confirmButtonText: "Aceptar",
      });
  </script>
@endif

@endsection