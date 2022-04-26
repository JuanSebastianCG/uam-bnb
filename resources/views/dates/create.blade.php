@extends('layouts.app')


@section('content')

    <div class="container">
        <h4>Agregar fechas</h4>
        {!! Form::open(['route' => 'rental_availabilities.store', 'method' => 'POST']) !!}
            <label>Fecha de inicio</label>
            {!! Form::date('start_date', null,['class' => 'form-control']) !!}
            <label>Fecha final</label>
            {!! Form::date('departure_date', null,['class' => 'form-control']) !!}
            
            <button type="submit" class="btn btn-primary">Agregar</button>
        {!! Form::close() !!}
    </div>

@endsection
