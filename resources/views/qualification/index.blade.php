@extends('layouts.app')

@section('content')
    <div class="container">
        <center>
            <h2>Calificaciones</h2>
        </center>
        <div class="row">
            <center>
            @forelse ($qualifications as $qualification)
                <a href="{{ route('properties.show', $qualification->property_id) }}">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title" style="color: rgb(255, 0, 0)">{{ $qualification->type }}</h6>
                                @foreach ($properties as $property)
                                    @if ($property->id == $qualification->property_id)
                                        <h5 class="card-text">{{ $property->name }}</h5>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </a>
                <br>
            @empty
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            @endforelse

            <div class="mt-2" style="color:black">
                {{ $qualifications->links() }}
            </div>

            </center>
        </div>
    </div>
    @include('layouts.sweetalert')
@endsection
