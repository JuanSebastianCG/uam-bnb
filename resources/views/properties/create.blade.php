
@extends('layouts.app')

@section('content')


<form action="{{ route('properties.store') }}" method="POST">
        @csrf
        <div class="container">
            <div class="row">


            <div class="form-group">
            <label class="col-form-label mt-4" for="inputDefault">Nombre del inmobiliario</label>
            <input type="text" class="form-control" placeholder="Ingreselo aqui" id="inputDefault" name="name">
            </div>


            <div class="form-group">
            <label for="exampleTextarea" class="form-label mt-4">Descripcion</label>
            <textarea class="form-control" id="exampleTextarea" rows="3" name="description"></textarea>
            </div>


            <div class="form-group col-4">
            <label class="col-form-label mt-4" for="inputDefault">Area</label>
            <input type="number" step="0.000001" class="form-control" placeholder="Numero" id="inputDefault" name="area">
            </div>

            <div class="form-group col-4">
                <label class="col-form-label mt-4" for="inputDefault">Capacidad</label>
                <input type="number"  class="form-control" placeholder="Numero" id="inputDefault" name="capacity">
            </div>

            <div class="form-group col-4">
            <label class="col-form-label mt-4" for="inputDefault">Valor Diario</label>
            <input type="number" step="0.000001" class="form-control" placeholder="Numero" id="inputDefault" name="daily_Lease_Value">
            </div>

            <div class="form-group col-4">
            <label for="exampleSelect1" class="form-label mt-4">Tipo de nmobiliario</label>
            <select class="form-select" id="exampleSelect1">
            <option value="house">Casa</option>
            <option value="apartment">Apartamento</option>
            </select>
            </div>

            <div class="form-group col-4">
            <label class="col-form-label mt-3" for="inputDefault">latitude</label>
            <input type="number" step="0.0000000000001" class="form-control" placeholder="Numero" id="inputDefault" name="latitude">
            </div>

            <div class="form-group col-4">
            <label class="col-form-label mt-3" for="inputDefault">longitude</label>
            <input type="number" step="0.00000000000001" class="form-control" placeholder="Numero" id="inputDefault" name="longitude">
            </div>

            <p class="mb-4">Caracteristicas</p>

            <div class="row ">
            @forelse($characteristics as $characteristic)
                <div class="col-2">
                    <div class="form-check">
                    <input name="checkbox[]" type="checkbox" class="btn-check" id="{{$characteristic->name}}" autocomplete="off" value="{{$characteristic->id}}">
                    <label class="btn btn-outline-primary" for="{{$characteristic->name}}">{{$characteristic->name}}</label><br>
                        </label>
                    </div>
                </div>

            @empty
            <option value="-1">no hay ninguno</option>
            @endforelse
            </div>
            </div>
            <span class="text-center ">
                <div class="mt-5" >
                <button type="submit" class="btn btn-primary">Agregar inmobiliario</button>
                </div>
            </span>
        </div>

    </form>
    
    @include('layouts.sweetalert')
    @endsection
