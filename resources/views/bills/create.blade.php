@extends('layouts.app')

@section('content')
        {{$property->id}}
        <div class="container">
            <div class="row">
                <div class="col-4"></div>
                <div class="card md-2 col-4" id="cardRecibo">
                    <div class="card-body">
                        <h5 class="title">Recibo</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Propiedad:</h6>

                        <div class="BottonBlack mb-3"></div>

                        <div id="valoresInternos" class="row">
                            <p class="col-8">Valor de la renta: </p> <p class="col-4"></p>

                            <p class="col-8">Valor de la limpieza: </p> <p class="col-4"></p>

                            <p class="col-8">Valor del servicio: </p> <p class="col-4"></p>
                        </div>

                        <div class="BottonBlack mb-3"></div>
                    </div>
                </div>
                <div class="col-4"></div>
            </div>

            <br>
        </div>
@endsection

