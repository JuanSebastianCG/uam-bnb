@extends('layouts.app')


@section('content')

    <div class="container">
        <br><br>
        <center>
            <h3>Agregar fechas </h3>
                <h3> para {{ $property->name }}</h3>
        </center>

            <br>

        <div class="row">
            <br><br><br>
            <form action="{{ route('store_renta', ['property'=> $property->id]) }}" method="POST">
                @csrf
                <center>
                    <label for="start_date">Fecha de inicio</label>
                <input class="form-control col-6" type="date" id="start_date" name="start_date" value="2022-04-26" min="2022-04-26">
                <br>

                <label for="departure_date">Fecha final</label>
                <input class="form-control col-6" type="date" id="departure_date" name="departure_date" value="2022-04-26" min="2022-04-26">

                <div class="form-group col-6">
                    <label for="exampleSelect1" class="form-label mt-4">Disponibilidad</label>
                    <select class="form-select" id="availability" name="availability">
                        <option value="1">Disponible</option>
                        <option value="0">No disponible</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Agregar fecha</button>
                </center>
            </form>

        </div>



        {{-- {!! Form::open(['route' => ['store_renta','property'=> $property->id], 'method' => 'POST']) !!}

        {!! Form::close() !!} --}}
    </div>

@endsection
