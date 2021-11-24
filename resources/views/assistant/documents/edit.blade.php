@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/multiple-select.css') }}">
@endsection

@section('content')
<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">Modificar documento</h1>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ url('/admin/documentos/'.$document->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input type="text" name="name" value="{{ $document->name }}" class="form-control">
                    </div>   
                    @error('name')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                      </div>                        
                    @enderror                 
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">Formatos aceptables</label>
                        <input type="hidden" name="acceptable_formats" value="{{ $document->acceptable_formats }}">
                        <?php
                            $values = explode(",", $document->acceptable_formats);
                        ?>
                        <select id="my-select"  multiple="multiple" class="form-control">
                            <option value="image/*" {{ in_array("image/*", $values) ? 'selected':'' }}>Imagenes</option>
                            <option value=".pdf" {{ in_array(".pdf", $values) ? 'selected':'' }}>PDF</option>
                            <option value=".docx,.doc" {{ in_array(".docx", $values) ? 'selected':'' }}>Word</option>
                            <option value=".xls" {{ in_array(".xls", $values) ? 'selected':'' }}>Excel</option>
                        </select>
                    </div>
                    @error('acceptable_formats')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                      </div>                        
                    @enderror
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">Limite de caducidad</label>
                        <select name="expiration_range" id="" class="form-control">
                            <option value="">Seleccionar limite</option>
                            <option value="15" {{ $document->expiration_range == 15 ? 'selected':''}}>15 días</option>
                            <option value="30" {{ $document->expiration_range == 30 ? 'selected':''}}>30 días</option>
                            <option value="90" {{ $document->expiration_range == 90 ? 'selected':''}}>90 días</option>
                            <option value="180" {{ $document->expiration_range == 180 ? 'selected':''}}>180 días</option>
                            <option value="365" {{ $document->expiration_range == 365 ? 'selected':''}}>365 días</option>
                            <option value="0" {{ $document->expiration_range == 0 ? 'selected':''}}>Sin limite</option>
                        </select>
                    </div>
                    @error('expiration_range')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                      </div>                        
                    @enderror
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="">Descripción</label>
                        <input type="text" class="form-control" name="description" value="{{ $document->description }}">
                    </div>
                    @error('description')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                      </div>                        
                    @enderror
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <a href="{{ url('/admin/documentos') }}" class="btn btn-secondary"><i class="far fa-times me-2"></i>Cancelar</a>
                    <button class="btn btn-primary text-white"><i class="far fa-check me-2"></i>Guardar</button>
                </div>
            </div>
         

        </form>
    </div>
</div>
    
@endsection

@section('scripts')
<script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/multiple-select.js') }}"></script>
    <script>
        $('#my-select').change(function() {
            document.querySelector('input[name="acceptable_formats"]').value = $(this).val().join(',')
        }).multipleSelect({
        filter: true
    });
    </script>
@endsection