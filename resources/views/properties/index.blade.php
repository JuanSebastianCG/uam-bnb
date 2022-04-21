@extends('layouts.app')

@section('content')
    @include('layouts.subview-form-errors')



    <!-- side var -->
    <div class="row">
        <div class="nav-var col-auto ">

            <h2 class='navTitle'>Filtros</h2>

            <label for="startDate" class="navLavel form-label mt-4">Fecha de Inicio</label>
            <input name="startDate" id="startDate" type="date" class="navbarInput form-control"
                placeholder="fecha de inicio" />


            <label for="exampleSelect1" class="navLavel form-label mt-4">Fecha final</label>
            <input name="endDate" id="endDate" type="date" class="navbarInput form-control" placeholder="fecha de inicio" />


            <div class="form-group">
                <label for="exampleSelect1" class="navLavel form-label mt-4">Precio</label>
                <select class="navbarInput form-select" id="price">
                    <option selected value="default">Elegir orden</option>
                    <option value="asc">Mayor Precio</option>
                    <option value="desc">Menor precio</option>

                </select>
            </div>

            <div class="form-group">
                <label class="col-form-label navLavel " for="inputDefault">Ciudad</label>
                <input type="text" class="navbarInput form-control" placeholder="Default input" id="city">
            </div>

            <div class="form-group">
                <button type="button" class="btn btn-outline-light" id="filter">Filtrar</button>
            </div>

        </div>

        <!-- propiedades -->
        <div class="indexContainer col-8">
            <h4 class="mb-5">Propiedades de {{ $user->name }}</h4>
            <div class="row">
                @for ($i = 0; $i < count($properties); $i++)
                    @include('properties.subview-index')
                @endfor
            </div>
        </div>

    </div>
    @include('layouts.sweetalert')
    @include('properties.filterIndex')
@endsection
