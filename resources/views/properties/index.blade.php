@extends('layouts.app')

@section('content')
@include('layouts.subview-form-errors')



<!-- side var -->
<div id="wrapper" class="toggled">
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
                <a href="#">
                    Filtros
                </a>
            </li>
            <li>
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




@endsection
