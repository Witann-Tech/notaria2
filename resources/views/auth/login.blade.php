@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-8 col-lg-6 col-xl-4">
            <div class="card border-0 card-transparent">
                <div class="card-body">
                    <div class="row">
                        <img src="{{ asset('images/white_log.png') }}" class="d-block mx-auto my-4 w-50" alt="">
                    </div>
                    <form method="POST" action="{{ url('/auth/login') }}">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control form-control-material text-white fs-3" id="floatingInput" placeholder="Correo electronico">
                            <label class="text-white" for="floatingInput">Correo electronico</label>
                            @error('email')
                                    <span class="invalid-feedback d-block text-center fs-4 fw-bolder" role="alert">
                                       {{ $message }}
                                    </span>
                                @enderror
                          </div>
                          <div class="form-floating mb-2">
                            <input type="password" name="password" class="form-control form-control-material text-white form-control-lg" id="floatingPassword" placeholder="Contraseña">
                            <label for="floatingPassword" class="text-white">Contraseña</label>
                            @error('password')
                                    <span class="invalid-feedback d-block text-center fs-4 fw-bolder" role="alert">
                                       {{ $message }}
                                    </span>
                                @enderror
                          </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label text-white" for="remember">
                                        {{ __('Mantener sesión') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 text-end">
                                    <a class="btn btn-link text-white" href="">
                                        {{ __('Olvide mi Contraseña') }}
                                    </a>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    {{ __('Iniciar sesión') }}
                                </button>                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

