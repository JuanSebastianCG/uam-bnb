@extends('layouts.app')


@section('content')

<div class="container">
    <h4>Comentarios</h4>
    @forelse ($comments as $comment)
        <div class="row">
            <div class="col s4">
                <div class="card">
                    <center>
                    <div class="card-header">
                      Comentario
                    </div>
                    <div class="card-body">
                      <p class="card-text">{{ $comment->text }}</p>
                      @forelse ($properties as $property)
                        @if ($property->id === $comment->property_id)
                            <h5 class="card-title">{{ $property->name }}</h5>
                        @endif
                      @empty

                      @endforelse
                      <a href="{{ route('properties.show', $comment->property_id) }}" class="btn btn-primary">Ir a la propiedad</a>
                    </div>
                </center>
                </div>

            </div>
        </div>
    @empty

    <div class="card mb-2">
        <div class="alert alert-info" role="alert">
            No ha hecho comentarios en ningun inmueble
        </div>
    </div>

    @endforelse

</div>

@endsection
