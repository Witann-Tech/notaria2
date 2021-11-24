@extends('layouts.admin')



@section('content')
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Tramites</h1>
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
                        <a class="btn app-btn-primary" href="{{ url('/admin/tramites/create') }}"><i class="far fa-plus me-2"></i>Nueva tramite</a>
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
            <!--<div class="row">
                <ul>
                    <li class="d-inline mx-2 cursor-pointer active">
                        <i class="far fa-th-large fa-lg"></i>
                    </li>
                    <li class="d-inline mx-2 cursor-pointer text-muted">
                        <i class="far fa-list fa-lg"></i>
                    </li>
                </ul>
            </div>-->
            <!--<div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">Fase 1</div>
                        <div class="card-body">
                            
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header">Fase 2</div>
                        <div class="card-body"></div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header">Fase 3</div>
                        <div class="card-body"></div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header">Fase 4</div>
                        <div class="card-body"></div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header">Fase 5</div>
                        <div class="card-body"></div>
                    </div>
                </div>
            </div>-->
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th class="meta">Nombre</th>
                            <th class="meta stat-cell">Cliente</th>
                            <th class="meta stat-cell">Tipo de tramite</th>
                            <th class="meta stat-cell">Estatus</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($formalities as $formality)
                        <tr>
                            <td>{{ $formality->name }}</td>
                            <td>{{ $formality->customer->name }}</td>
                            <td>{{ $formality->type->name }}</td>
                            <td>{{ $formality->status()->exists() ? $formality->status->name:'' }}</td>
                            <td>
                                <a class="btn app-btn-primary" href="{{ url('/admin/tramites/'.$formality->id.'/edit') }}"><i class="far fa-pencil me-2"></i>Modificar</a>
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
