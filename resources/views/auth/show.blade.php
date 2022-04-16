@extends('layouts.app')

@section('content')
    <div class="container">
        <form>
            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" disabled>
                </div>
            </div>

            <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo electrónico') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" disabled>
                </div>
            </div>

            <div class="row mb-3">
                <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Telefono') }}</label>

                <div class="col-md-6">
                    <input id="phone" type="number" class="form-control" name="phone" value="{{ $user->phone }}" disabled>
                </div>
            </div>

            <div class="row mb-3">
                <label for="age" class="col-md-4 col-form-label text-md-end">{{ __('Edad') }}</label>

                <div class="col-md-6">
                    <input id="age" type="number" min="9" class="form-control" name="age" value="{{ $user->age }}" disabled>
                </div>
            </div>
            <center>
                <div class="row">
                    <div class="col-5">
                        <br>
                    </div>

                    <div class="col-2">
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">{{ __('Editar') }}</a>
                    </div>
                    <div class="col-2">
                        <a href="{{-- {{ route('users.edit', $user) }} --}}" class="btn btn-danger">{{ __('Eliminar') }}</a>
                    </div>
                </div>
            </center>
        </form>
    </div>

    @include('layouts.sweetalert')
@endsection
