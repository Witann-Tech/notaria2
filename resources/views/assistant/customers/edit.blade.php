@extends('layouts.admin')

@section('content')
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Modifica cliente</h1>
        </div>
        <!--//col-auto-->
    </div>
    <div class="app-card">
        <div class="app-card-body p-3 p-lg-4">
            <form action="{{ url('/admin/clientes/'.$customer->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="">Nombres</label>
                            <input type="text" name="name" value="{{ old('name', $customer->user->name) }}" class="form-control">
                        </div>
                        @error('name')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="">Apellidos</label>
                            <input type="text" name="lastname" value="{{ old('lastname', $customer->lastname) }}" class="form-control">
                            @error('lastname')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" value="{{ old('email', $customer->user->email) }}" class="form-control">
                            @error('email')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="">Fecha de nacimiento</label>
                            <input type="date" name="birthdate" value="{{ old('birthdate',  $customer->birthdate) }}" class="form-control">
                        </div>
                        @error('birthdate')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="">Domicilio</label>
                            <input type="text" name="address" value="{{ old('address', $customer->address) }}" class="form-control">
                        </div>
                        @error('address')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="">Teléfono</label>
                            <input type="text" name="phone" value="{{ old('phone', $customer->phone) }}" class="form-control">
                        </div>
                        @error('phone')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="">CURP</label>
                            <input type="text" name="curp" value="{{ old('curp', $customer->curp) }}" class="form-control">
                        </div>
                        @error('curp')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="">RFC</label>
                            <input type="text" name="rfc" value="{{ old('rfc', $customer->rfc) }}" class="form-control">
                        </div>
                        @error('rfc')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="">Ocupación</label>
                            <input type="text" name="job" value="{{ old('job', $customer->job) }}" class="form-control">
                        </div>
                        @error('job')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="">Estado civil</label>
                            <select name="civil_status" id="" class="form-control">
                                <option value="">Seleccione opción</option>
                                <option value="Soltero" {{ $customer->civil_status == 'Soltero' ? 'selected':''}}>Soltero</option>
                                <option value="Casado" {{ $customer->civil_status == 'Casado' ? 'selected':''}}>Casado</option>
                                <option value="Union libre" {{ $customer->civil_status == 'Union libre' ? 'selected':''}}>Union libre</option>
                                <option value="Divorciado" {{ $customer->civil_status == 'Divorciado' ? 'selected':''}}>Divorciado</option>
                                <option value="Otro" {{ $customer->civil_status == 'Otro' ? 'selected':''}}>Otro</option>
                            </select>
                        </div>
                        @error('civil_status')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <a href="{{ url('/admin/clientes') }}" class="btn btn-secondary"><i
                                class="far fa-times me-2"></i>Cancelar</a>
                        <button class="btn btn-primary text-white"><i class="far fa-check me-2"></i>Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
