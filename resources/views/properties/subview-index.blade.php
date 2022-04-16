
   <div class="col-sm-3 m-5 " >
       <div class="card text-white bg-primary mb-3" style="width: 23rem;">
        <a  target="_blank" href="{{ route('properties.show', $property, $user) }}" style="flex: 1;">

        @for ($i = 0; $i < count($photos); $i++)
            @if ($photos[$i]->property_id == $property->id && $photos[$i]->url_image != 'defaultImage.jpg' )
                <img class="card-img-top"  height="300px" src="/property_images/{{$photos[$i]->url_image}}" alt="Card image cap">
                @break
            @elseif($i+1 == count($photos))
            <img class="card-img-top" height="300px" src="/property_images/defaultImage.jpg" alt="Card image cap">

            @endif
         @endfor
         <blockquote class="blockquote">
            <h4 class="text-white"><p class="ml-3 mt-3">{{ $property->name }}</p></h4>
        </blockquote>

            <div class="card-body">

                    <p class="card-text text-white"> Tipo de propiedad: {{ __($property->type) }}</p>
                    <p class="card-text text-white"> Nombre: {{ $property->name }}</p>

                </div>
            </a>
        </div>
    </div>



