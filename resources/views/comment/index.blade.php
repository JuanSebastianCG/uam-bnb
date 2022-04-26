

@extends('layouts.app')

@section('content')
    <div class="container">
        <center>
            <h2 class="mb-4 mt-3">Comentarios realizados por {{ Auth()->User()->name }}</h2>
        </center>

        <div class="row">
            <center>
                @if (count($comments) == 0)
                    <div class="alert alert-dismissible alert-info">
                        Usted no ha realizado ningún comentario.
                    </div>
                @else
                    @for ($i = 0; $i < count($comments); $i++)

                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title" style="color: rgb(143, 133, 133)">{{ $properties[$i]->name }}</h4>
                                    <h6 class="card-title" style="color: rgb(133, 133, 133)">{{ $comments[$i]->text }}</h6>

                                    <a href="{{ route('properties.show', $properties[$i]->id) }}" class="btn btn-sm btn-primary">Ir a la propiedad</a>
                                </div>
                            </div>
                        </div>
                    <br>
                    @endfor
                @endif

            <div class="mt-2" style="color:black">
                {{ $comments->links() }}
            </div>

            </center>
        </div>
    </div>
    @include('layouts.sweetalert')
@endsection
