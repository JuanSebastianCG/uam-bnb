@extends('layouts.app')


@section('content')

    <div class="container">
        <h4>Agregar fechas {{ $property->id }}</h4>
        {!! Form::open(['route' => ['store_renta','property'=> $property->id], 'method' => 'POST']) !!}
            <label>Fecha de inicio</label>
            {!! Form::date('start_date', null,['class' => 'form-control', 'min' => '']) !!}
            <label>Fecha final</label>
            {!! Form::date('departure_date', null,['class' => 'form-control']) !!}
            <div class="form-group col-4">
                <label for="exampleSelect1" class="form-label mt-4">Disponibilidad</label>
                <select class="form-select" id="availability" name="availability">
                    <option value="1">Disponible</option>
                    <option value="0">No disponible</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Agregar</button>
        {!! Form::close() !!}
    </div>

@endsection
