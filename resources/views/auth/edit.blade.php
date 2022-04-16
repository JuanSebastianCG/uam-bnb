@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="PUT" action="{{ route('users.update', $user->id) }}">
            @csrf

            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo electrónico') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Telefono') }}</label>

                <div class="col-md-6">
                    <input id="phone" type="number" min="0" minlength="10"  class="form-control @error('phone') is-invalid @enderror" name="password" required autocomplete="new-password" value="{{ $user->phone }}">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="age" class="col-md-4 col-form-label text-md-end">{{ __('Edad') }}</label>

                <div class="col-md-6">
                    <input id="age" type="number" min="9" class="form-control" name="password_confirmation" required autocomplete="new-password" value="{{ $user->age }}">
                </div>
            </div>
            <center>
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Editar') }}
                        </button>
                    </div>
                </div>
            </center>

        </form>
    </div>
@endsection
