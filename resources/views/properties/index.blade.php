@extends('layouts.app')

@section('content')
@include('layouts.subview-form-errors')



<!-- side var -->
<div id="wrapper" class="toggled">
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">



            </li>
            <li>
                <label for="start" class="h5">Fecha de Inicio:</label>
                <input name="startDate" id="startDate" type="date" class="form-control" placeholder="fecha de inicio"/>
                <a href="#">hola</a>
            </li>
        </ul>
    </div>
</div>

<!-- propiedades -->
<div class="container">
    <h4 >Propiedades de {{ $user->name}}</h4>
    <div class="row">
     @for($i = 0; $i < count($properties); $i++)
        @include('properties.subview-index')

      @endfor
    </div>
</div>


@include('layouts.sweetalert')
@include('properties.filterIndex')




@endsection
