@extends('layouts.app')
@section('links')
    <link href="{{ asset('css/billIndex.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="container">
        <h4 class="mb-5">{{ $user->name }} estos son sus recibos</h4>

        <div class="row">
            @forelse ($bills as $bill)
                <div class="card md-2 col-4 ml-5" id="cardRecibo">
                    <div class="card-body">
                        <h5 class="title">Recibo</h5>
                        @foreach ($properties as $property)
                            @if ($property->id === $bill->property_id)
                                <h6 class="card-subtitle mb-2 text-muted">Propiedad {{ $property->name }}</h6>
                                <div class="BottonBlack mb-3"></div>
                            @endif
                        @endforeach
                        <div id="valoresInternos" class="row">
                            <p class="col-8">Valor de la renta</p><p class="col-4"> ${{ $bill->rental_value }}</p>
                            <p class="col-8">Valor de la limpieza </p><p class="col-4">${{ $bill->cleaning_cost }}</p>
                            <p class="col-8">Valor del servicio  </p><p class="col-4">${{ $bill->service_cost }}</p>

                        </div>
                        <div class="BottonBlack mb-3"></div>
                        @if ($bill->paid_out)

                        <div class="row">
                            <p class="col-8">Total pagado</p>
                            <p class="col-auto">${{ $bill->service_cost + $bill->cleaning_cost + $bill->rental_value }}
                            </p>
                        </div>
                        <p class=" " id="pagado">CANCELADO</p>
                        @else
                            <p class="card-text">Pendiente</p>
                            <p class="card-text">Total a pagar</p>
                            <p class="card-text">
                                ${{ $bill->service_cost + $bill->cleaning_cost + $bill->rental_value }}
                            </p>

                            <form method="post" action="{{ route('bills.update', $bill->id) }}" class="formPagar">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                <button type="submit" class="btn btn-dark">
                                    Pagar
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                <br>

            @empty
            @endforelse
        </div>
    </div>

    @include('layouts.sweetalert')
@endsection
