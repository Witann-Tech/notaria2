@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/multiple-select.css') }}">
@endsection

@section('content')
<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">Nuevo documento</h1>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ url('/admin/documentos') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
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
                        <input type="hidden" name="acceptable_formats" value="{{ old('acceptable_formats') }}">
                        <select id="my-select"  multiple="multiple" class="form-control">
                            <option value="image/*">Imagenes</option>
                            <option value=".pdf">PDF</option>
                            <option value=".docx,.doc">Word</option>
                            <option value=".xls">Excel</option>
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
                            <option value="15">15 días</option>
                            <option value="30">30 días</option>
                            <option value="90">90 días</option>
                            <option value="180">180 días</option>
                            <option value="365">365 días</option>
                            <option value="0">Sin limite</option>
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
                        <input type="text" class="form-control" name="description" value="{{ old('description') }}">
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