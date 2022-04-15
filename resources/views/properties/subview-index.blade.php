
   <div class="col-sm-3 m-5 ">
        <div class="card text-white bg-dark" style="width: 23rem;">

        @foreach ($photos as $photo)
            @if ($photo->property_id == $property->id)
                <img class="card-img-top" src="/property_images/{{$photo->url_image}}" alt="Card image cap">
                @break
            @endif
        @endforeach

            <h4><div class="card-header">Nombre: {{ $property->name }}</div></h4>
            <div class="card-body">

                    <p class="card-text"> Tipo de propiedad: {{ $property->type }}</p>
                    <p class="card-text"> Nombre: {{ $property->name }}</p>

            </div>
        </div>
    </div>




