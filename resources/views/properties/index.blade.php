@extends('layouts.app')

@section('content')
    @include('layouts.subview-form-errors')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h3 style="color: black" class="text-dark display-6 ">
                    {{ $user-> name }}
                </h3>
            </div>
        </div>
        <div class="row">
            <h4 class="card-subtitle mb-2 text-muted">Propiedades</h4>
            @forelse ($properties as $property)

                @include('properties.subview-index')
            @empty
                <div class="alert alert-danger" role="alert">
                    El usuario no tiene propiedades
                </div>
            @endforelse
        </div>
    </div>
@endsection
