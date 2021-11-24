@extends('layouts.admin')

@section('content')

<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">Modificar cita</h1>
    </div>
</div>

    <div class="app-card">
        <div class="app-card-body p-3 p-lg-4">
            <form action="{{ url('/admin/citas/'.$date->id) }}" class="row" method="POST">
                @csrf
                @method('PUT')
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">Cliente</label>
                        <select name="user_id" id="user_id" class="form-control" required>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $date->customer_id == $user->id ? 'selected':''}}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">Fecha/Hora</label>
                        <div class="input-group">
                            <input type="datetime-local" id="datetimepicker" value="{{ $date->dating_time }}" class="form-control datetimepicker"
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
                        <input type="name" class="form-control" id="name" name="name" value="{{ $date->name}}" required>
                        @if ($errors->has('name')) <p style="color:red;">{{ $errors->first('name') }}</p> @endif
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Descripción</label>
                        <input type="description" class="form-control" id="description" value="{{ $date->description}}" name="description" required>
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

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script>
    $(document).ready(function() {
            $('#dating_time').datetimepicker({date: new Date($('#dating_time').val())});
        });
</script>
@endsection
