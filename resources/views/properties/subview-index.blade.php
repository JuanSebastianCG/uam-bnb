
   <div class="col-sm-3 m-5 ">
        <div class="card text-white bg-dark" style="width: 23rem;">

        @for ($i = 0; $i < count($photos); $i++)
            @if ($photos[$i]->property_id == $property->id && $photos[$i]->url_image != 'defaultImage.jpg' )
                <img class="card-img-top" src="/property_images/{{$photos[$i]->url_image}}" alt="Card image cap">
                @break
            @elseif($i+1 == count($photos))
            <img class="card-img-top" src="/property_images/defaultImage.jpg" alt="Card image cap">

            @endif
         @endfor

            <h4><div class="card-header">Nombre: {{ $property->name }}</div></h4>
            <div class="card-body">

                    <p class="card-text"> Tipo de propiedad: {{ __($property->type) }}</p>
                    <p class="card-text"> Nombre: {{ $property->name }}</p>

            </div>
        </div>
    </div>




