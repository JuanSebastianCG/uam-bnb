@extends('layouts.app')

@section('content')
@include('layouts.subview-form-errors')




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
<!-- /#wrapper -->

<div class="container">
    <h4 >Propiedades de {{ $user->name}}</h4>
    <div class="row">

        @forelse($properties as $property)
        <!-- iamgenes  -->
        @include('properties.subview-index')

        @empty
            <div class="card mb-2" >
                <div class="alert alert-info" role="alert">
                    No trene unmuebles
                </div>
            </div>
        @endforelse

    </div>


</div>
@include('layouts.sweetalert')




@endsection
