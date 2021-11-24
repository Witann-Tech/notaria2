@extends('layouts.admin')

@section('content')

<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">Modificar tramite</h1>
    </div>
</div>

    <div class="app-card">
        <div class="app-card-body p-3 p-lg-4">
            <form action="{{ url('/admin/tramites/'.$formality->id) }}" class="row" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-4"><div class="form-group">
                        <label for="">Nombre</label>
                        <input type="name" class="form-control" name="name" value="{{ $formality->name }}" required>
                    </div></div>
                    <div class="col-sm-4"><div class="form-group">
                        <label>Tipo de trámite</label>
                        <select class="custom-select form-control" name="formalitie_type_id" id="formalitie_type_id">
                            @foreach ($types as $type)
                                <option value="{{$type->id}}" {{ $formality->formalitie_type_id == $type->id ? 'selected':''}}>{{$type->name}}</option>
                            @endforeach
                        </select>
                    </div></div>
                    <div class="col-sm-4"><div class="form-group">
                        <label>Responsable general</label>
                        <select class="custom-select form-control" name="user_id">
                            <option selected>Asignar a</option>
                            @foreach ($users as $user)
                                <option value="{{$user->id}}" {{ $formality->user_id == $user->id ? 'selected':''}}>{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div></div>
                    <div class="col-sm-4"><div class="form-group">
                        <label>Estatus</label>
                        <select class="custom-select form-control" name="status_id">
                            @foreach ($formality->type->steps as $step)
                                <option value="{{$step->id}}" {{ $formality->status_id == $step->id ? 'selected':''}}>{{$step->name}}</option>
                            @endforeach
                        </select>
                    </div></div>
                    <div class="col-sm-4"><div class="form-group">
                        <label>Descripción</label>
                        <textarea class="form-control" name="description" id="description" cols="4" rows="3">{{ $formality->description}}</textarea>
                    </div></div>
                </div> 
                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <h5>Participantes y Documentos - {{ $formality->status->name }}</h5>
                        <hr>
                    </div>
                    @foreach ($formality->status->participants as $part)
                    <div class="col-12 mt-2">
                        <div class="card">
                            <div class="card-header">
                                {{ $part->name }}
                              </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Documento</th>
                                            <th>Descripción</th>
                                            <th>Documento</th>
                                            <th>Estatus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($part->documents as $doc)
                                        <tr>
                                            <td>{{ $doc->document->name }}</td>
                                            <td>{{ $doc->document->description }}</td>
                                            <td>
                                                <label for="inputFile{{$doc->id}}" class="btn btn-primary w-100 text-white">
                                                    <input type="file" id="inputFile{{$doc->id}}" accept="{{ $doc->document->acceptable_formats }}" class="d-none">
                                                    Seleccionar documento
                                                </label>
                                            </td>
                                            <td>
                                                <i class="far fa-check-circle fa-lg text-success"></i>
                                                <i class="far fa-dot-circle fa-lg text-info"></i>
                                                <i class="far fa-check-circle fa-lg text-danger"></i>
                                            </td>
                                        </tr>                                            
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>                        
                    @endforeach
                </div>          
                <div class="row mt-2">
                    <div class="col-md-12 mt-2 text-right">
                        <button type="submit" class="btn app-btn-primary text-white"><i class="fas fa-save"></i>Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
