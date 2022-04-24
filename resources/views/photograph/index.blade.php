@extends('layouts.app')

@section('content')

<div class="container">
@include('layouts.subview-form-errors')

    <h4 >Fotos de {{ $property->name }}</h4>
    <div class="row">
        <form action="{{ route('photographs.store',['properties_id' => $property->id] )}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="formFile" class="form-label mt-4">Subir imagen</label>
                <input type="file" class="form-control" name="images[]" id="" value="form-control" accept="image/*"  multiple >
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Guardar imagen </button>
                <a class="btn btn-outline-danger" href="{{ route('properties.show', $property,  Auth::user() ) }}">Regresar</a>
            </div>

        </form>

        @forelse($photos as $photo)
        <!-- iamgenes  -->
        <div class="col-sm-3 m-5 ">
            <div class="card" style="width: 23rem;">
            <img class="card-img-top" height="350px" src="/property_images/{{$photo->url_image}}" alt="Card image cap">
                <div class="card-body">

                 <h6 class="card-subtitle mb-2 text-muted">{{ $photo->created_at->diffForHumans()}}</h6>

                    <form action="{{ route('photographs.destroy', $photo) }}" method="POST" class="formEliminar">
                    @csrf
                    @method('DELETE')
                        <button type="submit" class="btn btn-primary" >
                            Eliminar imagen
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @empty

            <div class="row">
                <br>
            </div>

            <div class="alert alert-info" role="alert">
                No se poseen fotografías de este inmueble.
            </div>
        @endforelse
    </div>

    <div class="mt-3">
        {{$photos->links()}}
    </div>

</div>
@include('layouts.sweetalert')


@endsection
