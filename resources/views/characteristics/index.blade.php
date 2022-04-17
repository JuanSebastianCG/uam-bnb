@extends('layouts.app')

@section('content')
    <div class="container">
        <center>
            <h2>Características</h2>
        </center>
        <div class="row">
            <center>
            @forelse ($characteristics as $characteristic)
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Característica número {{ $characteristic->id }}</h6>
                            <h5 class="card-text">{{ $characteristic->name }}</h5>

                            @if ($user->status == 'admin')
                                <form method="POST" action="{{ route('characteristics.destroy', $characteristic->id) }}" class="formEliminar">
                                    <input name="_method" type="hidden" value="DELETE">

                                    {{ csrf_field() }}

                                    <a href="{{ route('characteristics.edit', $characteristic->id) }}" style="color:rgb(255, 255, 255)" class="btn btn-dark">
                                        {{-- <i class="fa-solid fa-pencil "></i> --}}
                                        {{ __('Editar') }}
                                    </a>
                                    <button type="submit" class="btn btn-danger" {{-- onclick="return confirm('¿Está seguro de querer eliminar esta característica?')" --}}>
                                        {{ __('Eliminar') }}
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
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
                {{ $characteristics->links()}}
            </div>

            </center>
        </div>
    </div>
    @include('layouts.sweetalert')
@endsection
