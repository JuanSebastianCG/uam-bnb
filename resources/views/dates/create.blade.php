@extends('layouts.app')


@section('content')

    <div class="container">

        <h4>Agregar fechas {{ $property->id }}</h4>
        {!! Form::open(['route' => ['store_renta','property'=> $property->id], 'method' => 'POST']) !!}
            <label for="start_date">Fecha de inicio</label>
            <div class="row">
                <div class="col-s6">
                    <input class="form-control" type="date" id="start_date" name="start_date" value="2022-04-26" min="2022-04-26">
                </div>
            </div>

            <label for="departure_date">Fecha final</label>
            <input class="form-control" type="date" id="departure_date" name="departure_date" value="2022-04-26" min="2022-04-26">

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
