
@extends('layouts.app')

@section('content')
@include('layouts.subview-form-errors')

    <form action="{{ route('properties.update', $property->id) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('put') }}

        <div class="container">

            <h4>Editar una propiedad</h4>

            <div class="row">


            <div class="form-group">
                <label class="col-form-label mt-4" for="inputDefault">Nombre del inmobiliario</label>
                <input type="text" class="form-control" value="{{ $property->name }}" id="inputDefault" name="name">
            </div>


            <div class="form-group">
                <label for="exampleTextarea" class="form-label mt-4">Descripcion</label>
                <textarea class="form-control" id="exampleTextarea" rows="3" name="description">{{ $property->description }}</textarea>
            </div>


            <div class="form-group col-4">
                <label class="col-form-label mt-4" for="inputDefault">Area</label>
                <input type="number" step="0.000001" class="form-control" value="{{ $property->area }}" id="inputDefault" name="area">
            </div>

            <div class="form-group col-4">
                <label class="col-form-label mt-4" for="inputDefault">Capacidad</label>
                <input type="number"  class="form-control" value="{{ $property->capacity }}" id="inputDefault" name="capacity">
            </div>

            <div class="form-group col-4">
                <label class="col-form-label mt-4" for="inputDefault">Valor Diario</label>
                <input type="number" step="0.000001" class="form-control" value="{{ $property->daily_Lease_Value }}" id="inputDefault" name="daily_Lease_Value">
            </div>

            <div class="form-group col-4">
                <label for="exampleSelect1" class="form-label mt-4">Tipo de inmobiliario</label>
                <select class="form-select" id="exampleSelect1">
                    <option value="house">Casa</option>
                    <option value="apartment">Apartamento</option>
                </select>
            </div>

            <div class="form-group col-4">
                <label class="col-form-label mt-3" for="inputDefault">latitude</label>
                <input type="number" step="0.0000000000001" class="form-control" value="{{ $property->latitude }}" id="inputDefault" name="latitude">
            </div>

            <div class="form-group col-4">
                <label class="col-form-label mt-3" for="inputDefault">longitude</label>
                <input type="number" step="0.00000000000001" class="form-control" value="{{ $property->longitude }}" id="inputDefault" name="longitude">
            </div>

            <div class="form-group mb-5">
                <label class="col-form-label mt-3" for="inputDefault">Ciudad</label>
                <input type="text" class="form-control" value="{{ $property->city }}" id="inputDefault" name="city">
            </div>


            <p class="mb-4">Caracteristicas</p>

            <div class="row ">
                    @forelse($characteristics as $characteristic)
                        <div class="col">
                            <div class="form-check">
                                <input name="checkbox[]" type="checkbox" class="btn-check" id="{{$characteristic->name}}" autocomplete="off" value="{{$characteristic->id}}">
                                <label class="btn btn-outline-primary" for="{{$characteristic->name}}">{{$characteristic->name}}</label><br>
                            </div>
                        </div>
                    @empty
                        <option value="-1">No hay ninguna característica</option>
                    @endforelse
            </div>

            </div>
                <span class="text-center ">
                <div class="mt-5" >
                    <button type="submit" class="btn btn-primary">Editar propiedad</button>
                </div>
            </span>
        </div>

    </form>

    @include('layouts.sweetalert')
    @endsection
