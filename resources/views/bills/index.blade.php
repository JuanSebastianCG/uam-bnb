@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h4>{{ $user->name}} estos son sus recibos</h4>
        </div>

        @forelse ($bills as $bill)
        <div class="card md-2" style="width: 48rem;">
            <div class="card-body">
              <h5 class="card-title">Recibo</h5>
              @foreach ($properties as $property)
                @if ($property->id === $bill->property_id)
                    <h6 class="card-subtitle mb-2 text-muted">Propiedad {{ $property->name }}</h6>
                @endif
              @endforeach
              <p class="list-group-item" style="width: 18rem">Valor de la renta ${{ $bill->rental_value}}</p>
              <p class="list-group-item" style="width: 18rem">Valor de la limpieza ${{ $bill->cleaning_cost}}</p>
              <p class="list-group-item" style="width: 18rem">Valor del servicio ${{ $bill->service_cost}}</p>
              @if ($bill->paid_out)
                <p class="card-text" style="color: limegreen">Cancelado</p>
                <p class="card-text" style="color: black">Total pagado</p>
                <p class="card-text" style="color:black">{{ $bill->service_cost + $bill->cleaning_cost + $bill->rental_value}}</p>
              @else
                <p class="card-text" style="color:red">Pendiente</p>
                <p class="card-text" style="color: black">Total a pagar</p>
                <p class="card-text" style="color:black">{{ $bill->service_cost + $bill->cleaning_cost + $bill->rental_value}}</p>
                {!! Form::model($bill, ['method' => 'PUT', 'route' => ['bills.update', $bill->id]]) !!}
                            {!! Form::button('<i class="btn btn-dark">Pagar</i>', [
                                'type' => 'submit',
                                'title' => "Pagar recibo",
                                'class' => 'btn',
                                'onclick' => "return confirm('¿Está seguro que quiere pagar?')"
                            ]) !!}
                        {!! Form::close() !!}

              @endif



            </div>
          </div>
          <br>

        @empty

        @endforelse
    </div>

@endsection
