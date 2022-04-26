@extends('layouts.app')

@section('links')
    <link href="{{ asset('css/billIndex.css') }}" rel="stylesheet">
@endsection

@section('content')
        <div class="container">
            <div class="row">
                <div class="col-4"></div>
                <div class="card md-2 col-4" id="cardRecibo">
                    <div class="card-body">
                        <center>
                        <h5 class="title">Recibo</h5>

                        <div class="BottonBlack mb-3"></div>

                            <h6 class="card-subtitle mb-2 text-muted">Inmueble: {{ $property->name }}</h6>
                        </center>

                        <div class="BottonBlack mb-3"></div>

                        <div id="valoresInternos" class="row">
                            <p class="col-6">Valor de la renta: </p><p class="col-4" style="color: rgb(0, 194, 0)"> $ {{ $price }}</p>

                            <p class="col-6">Valor de la limpieza: </p> <p class="col-2" style="color: rgb(0, 194, 0)">$ {{ $clean }}</p>

                            <p class="col-6">Valor del servicio: </p> <p class="col-4" style="color: rgb(0, 194, 0)">$ {{ $service }}</p>
                        </div>

                        <div class="BottonBlack mb-3"></div>

                        <div id="total" class="row">
                            <p class="col-6">Total a pagar: </p><p class="col-4" style="color: rgb(0, 194, 0)"> $ {{ $total }}</p>
                        </div>

                        <div class="BottonBlack mb-3"></div>
                        <center>
                            <form method="POST" action="{{ route('bills.store', ['property'=>$property->id, 'availability'=>$availability->id]) }}" class="formCrear">
                                {{ csrf_field() }}

                                <a href="{{ route('properties.index', $property->id) }}" style="color:rgb(0, 0, 0)" class="btn btn-outline-danger">
                                    {{-- <i class="fa-solid fa-pencil "></i> --}}
                                    {{ __('Cancelar') }}
                                </a>
                                <button type="submit" class="btn btn-outline-dark">
                                    {{ __('Alquilar') }}
                                </button>
                            </form>
                        </center>
                    </div>
                </div>
                <div class="col-4"></div>
            </div>

            <br>
        </div>
        
        @include('layouts.sweetalert')
@endsection

