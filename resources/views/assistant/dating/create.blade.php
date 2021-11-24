@extends('layouts.admin')

@section('content')

<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">Nueva cita</h1>
    </div>
</div>

    <div class="app-card">
        <div class="app-card-body p-3 p-lg-4">
            <form action="{{ url('/admin/citas') }}" class="row" method="POST">
                @csrf
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">Cliente</label>
                        <select name="user_id" id="user_id" class="form-control" required>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">Fecha/Hora</label>
                        <div class="input-group">
                            <input type="datetime-local" id="datetimepicker" class="form-control datetimepicker"
                                name="dating_time" required>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">Motivo</label>
                        <input type="name" class="form-control" id="name" name="name" required>
                        @if ($errors->has('name')) <p style="color:red;">{{ $errors->first('name') }}</p> @endif
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Descripción</label>
                        <input type="description" class="form-control" id="description" name="description" required>
                        @if ($errors->has('description')) <p style="color:red;">{{ $errors->first('description') }}</p> @endif
                    </div>
                </div>
                <div class="col-md-12 mt-2 text-right">
                    <button type="submit" class="btn btn-success text-white"><i class="fas fa-save"> Guardar</i></button>
                </div>
            </form>
        </div>
    </div>
@endsection
