@extends('layouts.app')
@section('links')
<script src='https://api.mapbox.com/mapbox-gl-js/v2.8.1/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.8.1/mapbox-gl.css' rel='stylesheet' />
<link href="{{ asset('css/mapbox.css') }}" rel="stylesheet">
@endsection


@section('content')
@include('layouts.subview-form-errors')

<!-- propiedades -->
<div class="container" >

    <div class="container " id="Contenedor">
        <div class="row">
            <h3 class="mt-4 mb-4 ml-3 text-white"> {{ $property->name}}</h3>
        <!-- fotos  -->
            <div id="carouselExampleControls" class="carousel slide col-5 ml-3 mr-3" data-ride="carousel">
                <div class="carousel-inner">
                       @for ($i = 0; $i < count($photos); $i++)
                        @if ($i == 0 )
                            <div class="carousel-item active">
                            <img class="d-block w-100"  height="350px" src="/property_images/{{$photos[$i]->url_image}}" alt="{{$i}} slide">
                            </div>
                            @else
                            <div class="carousel-item">
                            <img class="d-block w-100" height="350px" src="/property_images/{{$photos[$i]->url_image}}" alt="{{$i}} slide">
                            </div>

                            @endif
                        @endfor
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <!-- mapa -->
            <div class="mb-4 col-7" id='map' style='width: 700px; height: 350px;'></div>
        </div>

    <!-- likes -->
    @include('qualification.qualificationButtons')
    </div>

    <div class="container mt-3" id="Contenedor">
            <div class="row">

                <h4 class="ml-3 mt-4 mb-4 " id="title"> Caracteristicas</h4>
                <div class="container">
                <p class="ml-4 " id="text">{{$property->description}}</p>
                </div>

                <ul class="mb-5" >
                <li class="ml-5" id="text"> Area:   {{$property->area}} m2 </li>
                <li class="ml-5" id="text"> Valor Diario:   {{$property->daily_Lease_Value}}$ </li>
                <li class="ml-5" id="text"> Tipo:   {{__($property->type)}} </li>
                <li class="ml-5" id="text"> Capacidad:   {{$property->capacity}} Personas </li>
                <li class="ml-5" id="text"> longitude:   {{$property->longitude}}  </li>
                <li class="ml-5 " id="text"> latitude:   {{$property->latitude}}  </li>
                </ul>
            </div>
        </div>

    <div class="container mt-3" id="Contenedor">
        <div class="row">
        <h4 class="ml-3 mt-4 mb-4 " id="title"> Este inmobiliario tiene...</h4>
        @forelse($characteristics as $characteristic)
                <h4 class="ml-3 mt-4 mb-4 col-2 " id="bttn"> {{$characteristic->name}}</h4>
            @empty
                <div class="card mb-2" >
                    <div class="alert alert-info" role="alert">
                        No trene atributos
                    </div>
                </div>
            @endforelse
        </div>
    </div>


    <div class="container mt-3" id="Contenedor">

    <h4 class="ml-3 mt-4 mb-4 " id="title"> Comentarios</h4>

    <!-- crear comentario -->
        <div class="form-group mt-4">
        <label for="MakeCommentSection" class="form-label mt-4 ">Agregar comentario</label>
        <textarea class="form-control" id="MakeCommentSection" rows="3" name="text"></textarea>
        <button type="button" class="btn btn-outline-light" id="sendComment">enviar</button>
        </div>

        <div id="commentsSection">
            @for ($i = 0; $i < count($comments['comments']); $i++)
                <div class="card border-dark mb-3" style="">
                    <div class="card-body">
                        <h4 class="card-title" id="">{{ $comments['userComments'][$i]->name }}</h4>
                        <p class="card-text">{{ $comments['comments'][$i]->text }}</p>
                    </div>
                </div>
            @endfor
        </div>


</div>


@include('qualification.qjs')
@include('comment.qjs')
@include('layouts.mapbox')
@endsection

