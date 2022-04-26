@extends('layouts.app')

@section('content')
    @include('layouts.subview-form-errors')



    <!-- side var -->
    <div class="row">

        <div class="nav-var col-auto ">
            <form>
                <h2 class='navTitle'>Filtros &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <img src="https://t3.ftcdn.net/jpg/03/20/78/84/360_F_320788475_nEiLVViOBewea7taZWqNUR0lJAMTAaSo.jpg"
                        style="width: 2rem; height: 2rem; background-color: white">
                </h2>


                <label for="startDate" class="navLavel form-label mt-4">Fecha de Inicio</label>
                <input name="startDate" id="startDate" value="{{ $old['starDate'] }}" type="date"
                    class="navbarInput form-control" placeholder="fecha de inicio" />


                <label for="exampleSelect1" class="navLavel form-label mt-4">Fecha final</label>
                <input name="endDate" value="{{ $old['endDate'] }}" id="endDate" type="date"
                    class="navbarInput form-control" placeholder="fecha de inicio" />


                <div class="form-group">
                    <label for="exampleSelect1" class="navLavel form-label mt-4">Precio</label>
                    <select class="navbarInput form-select" id="price" name="price">
                        <option selected value="default">Elegir orden</option>
                        <option value="asc">Menor precio</option>
                        <option value="desc">Mayor Precio</option>

                    </select>
                </div>

                <div class="form-group">
                    <label class="col-form-label navLavel " for="inputDefault">Ciudad</label>
                    <input type="text" value="{{ $old['city'] }}" class="navbarInput form-control" name="city"
                        placeholder="Seleccione una ciudad." id="city">
                </div>

                <div class="row">
                    <div class="form-group col-7">
                        <button type="submit" class="btn btn-outline-light" id="filter"
                            style="width: 9rem;">Filtrar</button>

                    </div>
                    <div class="form-group col-auto mt-2">
                        <button type="button" class="btn btn-outline-danger" id='cleanButton' style="margin-top: 10%">
                            <i class="fa-solid fa-broom"></i>
                        </button>
                    </div>
                </div>
        </div>

        </form>

    <!-- propiedades -->
    <div class=" container indexContainer col-8">
        @if ($user == true)
            <h3 class="mb-5 blackBotton">Propiedades de {{ $user->name }}.</h3>
        @else
            <h3 class="mb-5 blackBotton">!Hola!&nbsp;{{ Auth::user()->name }}, aquí están todas las propiedades. </h3>
        @endif
        <div class="row propiedades">
            @php
                $i = 0;
            @endphp

            @foreach ($properties as $property)
                @include('properties.subview-index')
                @php
                    $i++;
                @endphp
            @endforeach
        </div>
    </div>

    </div>
    @include('layouts.sweetalert')
    @include('properties.filterIndex')
@endsection
