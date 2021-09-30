@extends('layouts.admin')



@section('content')
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Clientes</h1>
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
                        <a class="btn app-btn-primary" href="{{ url('/admin/clientes/create') }}"><i class="far fa-plus me-2"></i>Nuevo cliente</a>
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
                            <th class="meta stat-cell">CURP</th>
                            <th class="meta stat-cell">Fecha de nacimiento</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                        <tr>
                            <td>{{ $customer->lastname }}</td>
                            <td>{{ $customer->curp }}</td>
                            <td>{{ $customer->birthdate }}</td>
                            <td>
                                <a class="btn app-btn-primary" href="{{ url('/admin/clientes/'.$customer->id) }}"><i class="far fa-pencil me-2"></i>Modificar</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $customers->links('customs.pagination') }}
            </div>
        </div>
    </div>
@endsection
