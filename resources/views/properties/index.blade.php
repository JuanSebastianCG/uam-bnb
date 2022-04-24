@extends('layouts.app')

@section('content')
    @include('layouts.subview-form-errors')



    <!-- side var -->
    <div class="row">
        <div class="nav-var col-auto ">

            <h2 class='navTitle'>Filtros &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <img src="https://cdn.icon-icons.com/icons2/1993/PNG/512/filter_filters_funnel_list_navigation_sort_sorting_icon_123212.png"
                style="width: 2rem; height: 2rem; background-color: white"
                ></h2>


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
        <div class=" container indexContainer col-8">
            @if($user == true)
            <h3 class="mb-5 blackBotton">Propiedades de {{ $user->name }}</h3>
            @else
            <h3 class="mb-5 blackBotton">hola!{{Auth::user()->name}}, aqui estan todas las propeidades </h3>

            @endif
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
