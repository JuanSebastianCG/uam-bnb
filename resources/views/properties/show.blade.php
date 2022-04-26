@extends('layouts.app')
@section('links')
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.8.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.8.1/mapbox-gl.css' rel='stylesheet' />
    <link href="{{ asset('css/mapbox.css') }}" rel="stylesheet">
@endsection


@section('content')
    @include('layouts.subview-form-errors')

    <!-- propiedades -->
    <div class="containerFotos">

        <div class="container bLackContainer">
            <div class="row">
                <h3 class="mt-4 mb-4 ml-3 WhiteTitle col-sm-10 "> {{ $property->name }}</h3>

                {{-- boton para modificar la propiedad --}}
                @if ($property->user_id == $user->id)
                    <div class="btn-group col-auto buttonSetting" >
                        <button type="button" data-toggle="dropdown"
                            class=" fa-solid fa-gear  btn btn-outline-danger  "
                            style="margin-top:  1rem; margin-bottom:  1rem ; margin-left:5rem  "></button>

                        <ul class="dropdown-menu " role="menu" style="background-color: black">

                            <form method="POST" action="{{ route('properties.destroy', $property->id) }}"
                                class="formEliminar">
                                <input name="_method" type="hidden" value="DELETE">
                                {{ csrf_field() }}

                                <a href="{{ route('properties.edit', $property->id) }}"
                                    style="color:rgb(255, 255, 255); width: 13rem" class="btn btn-dark">
                                    {{ __('Editar') }}
                                </a>

                                <button style="color:rgb(255, 255, 255); width: 13rem" type="submit" class="btn btn-danger"
                                    {{-- onclick="return confirm('¿Está seguro de querer eliminar esta característica?')" --}}>
                                    {{ __('Eliminar propiedad') }}
                                </button>
                            </form>

                        </ul>
                    </div>
                @endif


                <!-- fotos  -->
                <div id="carouselExampleControls" class="carousel slide col-4 ml-3 mr-3 " data-ride="carousel">
                    <div class="carousel-inner ButtonWhite">

                        @if (count($photos) != 0)
                            @for ($i = 0; $i < count($photos); $i++)
                                @if ($i == 0)
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" height="300px"
                                            src="/property_images/{{ $photos[$i]->url_image }}"
                                            alt="{{ $i }} slide">
                                    </div>
                                @else
                                    <div class="carousel-item">
                                        <img class="d-block w-100" height="300px"
                                            src="/property_images/{{ $photos[$i]->url_image }}"
                                            alt="{{ $i }} slide">
                                    </div>
                                @endif
                            @endfor
                        @else
                            <div class="carousel-item active">
                                <img class="d-block w-100" height="300px" src="/property_images/defaultImage.jpg"
                                    alt="slide">
                            </div>
                        @endif
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"
                        id="carouselButton">
                        <span class="carousel-control-prev-icon" aria-hidden="true" id="carouselIcon"
                            style="color:black"></span>
                        <span class="sr-only">Previous</span>
                    </a>

                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"
                        id="carouselButton">
                        <span class="carousel-control-next-icon" aria-hidden="true" id="carouselIcon"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    @include('qualification.qualificationButtons')

                    <!-- likes -->
                </div>
                <!-- mapa -->
                <div class="mb-auto col-8" id='map' style='width: 800px; height: 350px;'></div>
            </div>

        </div>
    </div>
    <!-- caracteristicas -->
    <div class="container mt-3 grayContainer">
        <div class="row">

            <h4 class="ml-3 mt-4 mb-4 " id="title"> Caracteristicas</h4>
            <div class="container ">
                <p class="ml-4 mr-5" id="text" style="word-break: break-all;">{{ $property->description }}</p>
            </div>

            <ul class="mb-5 ">
                <li class="ml-5" id="text"> Area: {{ $property->area }} m2 </li>
                <li class="ml-5" id="text"> Valor Diario: {{ $property->daily_Lease_Value }}$ </li>
                <li class="ml-5" id="text"> Tipo: {{ __($property->type) }} </li>
                <li class="ml-5" id="text"> Capacidad: {{ $property->capacity }} Personas </li>
                <li class="ml-5 " id="text"> Ciudad: {{ $property->city }} </li>
                <li class="ml-5" id="text"> Longitud: {{ $property->longitude }} </li>
                <li class="ml-5 " id="text"> Latitud: {{ $property->latitude }} </li>
            </ul>
            <div class="ButtonBlack"></div>
        </div>
        <!-- caracteristicas -->

        <div class="row mb-3">
            <h4 class="ml-3 mt-4 mb-4 " id="title"> Este inmobiliario cuenta con: </h4>
            &nbsp; &nbsp;&nbsp;&nbsp;
            @forelse($characteristics as $characteristic)
                <h4 class=" ml-2 mt-4 mb-4 col-2 " id="caracteristicas"> {{ $characteristic->name }}</h4>
            @empty
            <div style="width: 100rem">
                @include('layouts.subview-for-advice')
            </div>

            @endforelse

        </div>
    </div>

    <!-- Fechas disponibles -->
    <div class="container mt-3 grayContainer">
        <h4 class="ml-3 mt-4 mb-4 " id="title"> Fechas disponibles</h4>
        @forelse($rental_availabilities as $rental_availability)
            <div class="ml-4 card border-dark mb-3 " id="grayCard" style="">
                <div class="row">
                    <div class="card-body col-9">
                        <div class="row">
                            <h4 class="ml-3 card-title col-auto">
                                {{ date('d-m-Y', strtotime($rental_availability->start_date)) }}</h4>
                            <h4 class="ml-3 card-title col-auto">hasta&nbsp;&nbsp;&nbsp;
                                {{ date('d-m-Y', strtotime($rental_availability->departure_date)) }}</h4>
                            @if ($rental_availability->availability)
                                <p class="card-text ml-4 " id="disponiblidadTrue">Disponible</p>
                            @else
                                <p class="card-text ml-4" id="disponiblidadFalse"> No Disponible</p>
                            @endif
                        </div>
                    </div>
                    <div class="card-body col-2">
                        @if ($rental_availability->availability)
                            <center>
                                <a href="{{ route('bills.create', $property->id) }}" class="btn btn-outline-success btn-ls">
                                    {{ __('Alquilar') }}
                                </a>
                            </center>
                        @endif
                    </div>

                </div>
            </div>
        @empty
        @include('layouts.subview-for-advice')
        @endforelse
        @if ($property->user_id == $user->id)

            <center><a href="{{ route('create_renta', $property->id) }}" class="btn btn-dark">Agregar fecha</a></center>
         @endif


    </div>

    <div class="container mt-5" id="Contenedor">

        <div class="TopBlack"></div>
        <h4 class="mt-4 mb-4 " id="title"> Comentarios</h4>

        <!-- crear comentario -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group mt-1">

            <label for="MakeCommentSection" class="form-label mt-2 ">Agregar comentario</label>

            <textarea class="form-control" id="MakeCommentSection" rows="3" name="text"></textarea>
            <button type="button" class="btn btn-outline-primary mt-2" id="sendComment">enviar</button>

        </div>

        {{-- mostrar comentarios --}}
        <div id="commentsSection" class="commentsSection">
            @for ($i = 0; $i < count($comments['comments']); $i++)
                <div class="card border-dark mb-3" style="" id="commentCard">
                    <div class="card-body">
                        <div class="row">
                            <h4 class="card-title col-10 mr-5" id="">{{ $comments['userComments'][$i]->name }}</h4>

                            @if ($comments['userComments'][$i]->id === $user->id)
                                <button class=" deleteIcon btn col-auto ml-4 " onClick="allComents(this.id)"
                                    id="{{ $comments['comments'][$i]->id }}"><i class="ml-1 fa-solid fa-trash"></i>
                                </button>
                                <button class=" updateIcon btn col-auto" onClick="allComents(this.id)"
                                    id="{{ $comments['comments'][$i]->id }}"><i
                                        class="ml-auto fa-solid fa-pen-to-square"></i> </button>
                            @endif
                            <h6 class="card-subtitle mb-2 text-muted">
                                {{ $comments['userComments'][$i]->created_at->diffForHumans() }}</h6>
                            <p class="card-text">{{ $comments['comments'][$i]->text }}</p>
                        </div>

                    </div>
                </div>
            @endfor
        </div>


    </div>



    @include('layouts.sweetalert')
    @include('qualification.qjs')
    @include('comment.qjs')
    @include('layouts.mapbox')
@endsection
