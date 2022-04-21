@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h4>{{ $user->name}} estos son sus recibos</h4>
        </div>

        @forelse ($bills as $bill)
        <div class="card" style="width: 48rem;">
            <div class="card-body">
              <h5 class="card-title">Recibo</h5>
              @foreach ($properties as $property)
                @if ($property->id === $bill->property_id)
                    <h6 class="card-subtitle mb-2 text-muted">Propiedad {{ $property->name }}</h6>
                @endif
              @endforeach
              <p class="card-text">Valor de la renta ${{ $bill->rental_value}}</p>
              <p class="card-text">Valor de la limpieza ${{ $bill->cleaning_cost}}</p>
              <p class="card-text">Valor del servicio ${{ $bill->service_cost}}</p>

            </div>
          </div>
        @empty

        @endforelse
    </div>

@endsection
