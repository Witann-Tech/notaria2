@extends('layouts.admin')

@section('content')
<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">Tipos de tramites</h1>
    </div>
    <div class="col-auto">
        <div class="page-utilities">
            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                <div class="col-auto">
                    <form class="docs-search-form row gx-1 align-items-center">
                        <div class="col-auto form-search">
                            <input type="text" class="search-query form-control rounded-pill" placeholder="Buscar..." />
                        </div>
                    </form>

                </div>
                <!--//col-->
                <div class="col-auto">
                    <a class="btn app-btn-primary" href="{{ url('/admin/tipos-de-tramites/create') }}"><i class="far fa-plus me-2"></i>Nuevo tipo de tramite</a>
                </div>
            </div>
            <!--//row-->
        </div>
        <!--//table-utilities-->
    </div>
    <!--//col-auto-->
</div>
<div class="app-card">
    <div class="app-card-body p-3 p-lg-4">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th class="meta">Nombre</th>
                        <th class="meta stat-cell">Descripción</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($formalities as $formality)
                    <tr>
                        <td>{{ $formality->name }}</td>
                        <td>{{ $formality->description }}</td>
                        <td>
                            <a class="btn app-btn-primary" href="{{ url('/admin/tipos-de-tramites/'.$formality->id.'/edit') }}"><i class="far fa-pencil me-2"></i>Modificar</a>
                            <a class="btn app-btn-primary" href="{{ url('/admin/tipos-de-tramites/'.$formality->id.'/etapas') }}"><i class="far fa-list-ol me-2"></i>Etapas</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $formalities->links('customs.pagination') }}
        </div>
    </div>
</div>
    
@endsection