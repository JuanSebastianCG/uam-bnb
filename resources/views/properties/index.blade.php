@extends('layouts.app')

@section('content')
@include('layouts.subview-form-errors')



<!-- side var -->
<div id="wrapper" class="toggled nav">
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">

            <li>
                <h2 id='navTitle'>Filtros</h2>
            </li>

            <li>
                <label for="startDate" class="navLavel form-label mt-4">Fecha de Inicio</label>
                <input name="startDate" id="startDate" type="date" class="navbarInput form-control" placeholder="fecha de inicio"/>
            </li>

            <li>
                <label for="exampleSelect1" class="navLavel form-label mt-4">Fecha final</label>
                <input name="endDate" id="endDate" type="date" class="navbarInput form-control" placeholder="fecha de inicio"/>
            </li>


            <li>
                <div class="form-group">
                    <label for="exampleSelect1" class="navLavel form-label mt-4">Precio</label>
                    <select class="navbarInput form-select" id="price">
                        <option selected value="default">Elegir orden</option>
                        <option value="asc">Mayor Precio</option>
                        <option value="desc">Menor precio</option>

                    </select>
                </div>
            </li>

            <li>
                <div class="form-group">
                    <label class="col-form-label navLavel " for="inputDefault">Ciudad</label>
                    <input type="text" class="navbarInput form-control" placeholder="Default input" id="city">
                </div>
            </li>

            <li>
                <div class="form-group">
                    <button type="button" class="btn btn-outline-light" id="filter">Filtrar</button>
                </div>
            </li>
        </ul>
    </div>
</div>

<!-- propiedades -->
<div class="container indexContainer">

    <center>
        <h4 >Propiedades pertenencientes a {{ $user->name}}</h4>
    </center>

    <div class="row">
        @for($i = 0; $i < count($properties); $i++)
            @include('properties.subview-index')
        @endfor
    </div>
</div>


@include('layouts.sweetalert')
@include('properties.filterIndex')


@endsection
