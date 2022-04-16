@extends('layouts.app')
@section('links')
<script src='https://api.mapbox.com/mapbox-gl-js/v2.8.1/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.8.1/mapbox-gl.css' rel='stylesheet' />
<link href="{{ asset('css/mapbox.css') }}" rel="stylesheet">
@endsection


@section('content')
@include('layouts.subview-form-errors')


<!-- side var -->

<!-- propiedades -->
<div class="container" >
    <div class="container " id="mapa">
        <div class="row">

            <h3 class="mt-2 "> {{ $property->name}}</h3>
            <div id="carouselExampleControls" class="carousel slide col-6" data-ride="carousel">
                
                <div class="carousel-inner">
                <div class="carousel-item active">
                <img class="d-block w-100" src="..." alt="First slide">
                </div>
                <div class="carousel-item">
                <img class="d-block w-100" src="..." alt="Second slide">
                </div>
                <div class="carousel-item">
                <img class="d-block w-100" src="..." alt="Third slide">
                </div>
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

        <div class="mb-4 col-6" id='map' style='width: 400px; height: 300px;'></div>
    </div>

    </div>
</div>


@include('layouts.sweetalert')
@include('layouts.mapbox')
@endsection

