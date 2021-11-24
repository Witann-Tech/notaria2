@extends('layouts.admin')

@section('content')

<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">Nuevo tramite</h1>
    </div>
</div>

    <div class="app-card">
        <div class="app-card-body p-3 p-lg-4">
            <form action="{{ url('/admin/tramites') }}" class="row" method="POST">
                @csrf
                <div class="col-sm-4"><div class="form-group">
                    <label for="">Nombre</label>
                    <input type="name" class="form-control" name="name" required>
                </div></div>
                <div class="col-sm-4"><div class="form-group">
                    <label>Tipo de trámite</label>
                    <select class="custom-select form-control" name="formalitie_type_id" id="formalitie_type_id">
                        @foreach ($types as $type)
                            <option value="{{$type->id}}">{{$type->name}}</option>
                        @endforeach
                    </select>
                </div></div>
                <div class="col-sm-4"><div class="form-group">
                    <label>Responsable general</label>
                    <select class="custom-select form-control" name="user_id">
                        <option selected>Asignar a</option>
                        @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div></div>
                <div class="col-sm-4"><div class="form-group">
                    <label>Descripción</label>
                    <textarea class="form-control" name="description" id="description" cols="4" rows="3"></textarea>
                </div></div>             
                <div class="col-md-12 mt-2 text-right">
                    <button type="submit" class="btn btn-success btn-lg text-white"><i class="fas fa-save me-1"> </i>Guardar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
