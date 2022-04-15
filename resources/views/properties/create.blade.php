@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col s6">
           <h4>AÑADIR UNA PROPIEDAD</h4>
        </div>
    </div>
    <div class="row">
        {!! Form::open(['route' => 'properties.store', 'method'=>'post']) !!}
            <form>
                <div class="row">
                    <div class="col s4">
                        <div class="mb-1">
                            <label for="name" class="h5"> Nombre de su propiedad </label>
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col s4">
                        <div class="mb-1">
                            <label for="description" class="h5"> Descripcion </label>
                            {!! Form::text('description', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s4">
                        <div class="mb-1">
                            <label for="area" class="h5"> Area de la propiedad </label>
                            {!! Form::number('area', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s4">
                        <div class="mb-1">
                            <label for="capacity" class="h5"> Capacidad de personas </label>
                            {!! Form::number('capacity', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s4">
                        <div class="mb-1">
                            <label for="daily_Lease_Value" class="h5"> Precio diario </label>
                            {!! Form::number('daily_Lease_Value', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s4">
                        <div class="mb-1">
                            <label for="type" class="h5"> Tipo de propiedad </label>
                            <select name="type" class="form-select">
                                <option value="house">Casa</option>
                                <option value="apartment">Apartamento</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s4">
                        <div class="mb-1">
                            <label for="latitude" class="h5"> Latitud </label>
                            {!! Form::number('latitude', null, ['class' => 'form-control', 'step'=>'any']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s4">
                        <div class="mb-1">
                            <label for="longitude" class="h5"> Longitud </label>
                            {!! Form::number('longitude', null, ['class' => 'form-control', 'step'=>'any']) !!}
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success btn-lg">   Añadir   </button>

            </form>
        {!! Form::close() !!}
    </div>
</div>

@endsection

