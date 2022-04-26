
@extends('layouts.app')

@section('content')

<form action="{{ route('properties.store') }}" method="POST">
    @csrf


    <div class="container">
            @include('layouts.subview-form-errors')
            <h4>Agregar una propiedad</h4>
            <div class="row">


            <div class="form-group">
                <label class="col-form-label mt-4" for="inputDefault">Nombre del inmobiliario</label>
                <input type="text" value="{{old('name')}}" class="form-control" placeholder="Ingreselo aqui" id="inputDefault" name="name">
            </div>


            <div class="form-group">
                <label for="exampleTextarea" class="form-label mt-4">Descripcion</label>
                <textarea class="form-control" value="" id="exampleTextarea" rows="3" name="description">{{old('description')}}</textarea>
            </div>


            <div class="form-group col-4">
                <label class="col-form-label mt-4" for="inputDefault">Area</label>
                <input type="number" value="{{old('area')}}" step="0.000001" class="form-control" placeholder="m2" id="inputDefault" name="area">
            </div>

            <div class="form-group col-4">
                <label class="col-form-label mt-4" for="inputDefault">Capacidad</label>
                <input type="number" value="{{old('capacity')}}"  class="form-control" placeholder="Numero" id="inputDefault" name="capacity">
            </div>

            <div class="form-group col-4">
                <label class="col-form-label mt-4" for="inputDefault">Valor Diario</label>
                <input type="number" value="{{old('daily_Lease_Value')}}" step="0.000001" class="form-control" placeholder="$" id="inputDefault" name="daily_Lease_Value">
            </div>

            <div class="form-group col-4">
                <label for="exampleSelect1" class="form-label mt-4">Tipo de inmobiliario</label>
                <select class="form-select" id="type" name="type">
                    <option value="house">Casa</option>
                    <option value="apartment">Apartamento</option>
                </select>
            </div>

            <div class="form-group col-4">
                <label class="col-form-label mt-3" for="inputDefault">latitude</label>
                <input type="number" step="0.0000000000001" value="{{old('latitude')}}" class="form-control" placeholder="Numero" id="inputDefault" name="latitude">
            </div>

            <div class="form-group col-4">
                <label class="col-form-label mt-3" for="inputDefault">longitude</label>
                <input type="number" step="0.00000000000001"  value="{{old('longitude')}}" class="form-control" placeholder="Numero" id="inputDefault" name="longitude">
            </div>

            <div class="form-group mb-5">
                <label class="col-form-label mt-3" for="inputDefault">Ciudad</label>
                <input type="text" class="form-control"  value="{{old('city')}}"  placeholder="Ingreselo aqui" id="inputDefault" name="city">
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

            <div class="row">
                <div class="col-6">
                    <h6 style="color: black" class="text-dark">
                        <br><br>
                        ¿No encuentras la característica que buscas?
                        <a href="{{ route('characteristics.create') }}" style="color:rgb(255, 4, 4)">
                            {{-- <i class="fa-solid fa-pencil "></i> --}}
                            {{ __('Crea una') }}
                        </a>
                    </h6>
                </div>
            </div>

            </div>
                <span class="text-center ">
                <div class="mt-5" >
                    <button type="submit" class="btn btn-primary">Agregar inmobiliario</button>
                    <a class="btn btn-outline-danger" href="{{ URL::previous() }}">Regresar</a>

                </div>
            </span>
        </div>

    </form>

    @include('layouts.sweetalert')
    @endsection
