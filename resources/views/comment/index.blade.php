@extends('layouts.app')


@section('content')

<div class="container">
    <h4>Comentarios</h4>
    @forelse ($comments as $comment)
        <div class="row">
            <div class="cols4">
                <div class="card">
                    <div class="card-header">
                      Comentario
                    </div>
                    <div class="card-body">
                      <p class="card-text">{{ $comment->text }}</p>
                      @forelse ($properties as $property)
                        @if ($property->id === $comment->property_id)
                            
                        @endif
                      @empty

                      @endforelse

                    </div>
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
