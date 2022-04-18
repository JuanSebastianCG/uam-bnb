
   <div class="col-sm-3 m-5 " >
       <div class="card text-white bg-primary mb-3" style="width: 23rem;">
        <a  target="_blank" href="{{ route('properties.show', $properties[$i], $user) }}" style="flex: 1;">


        @if($photos[$i] != null)
                <img class="card-img-top"  height="300px" src="/property_images/{{$photos[$i]->url_image}}" alt="Card image cap">
        @else
        <img class="card-img-top"  height="300px" src="/property_images/defaultImage.jpg" alt="Card image cap">
        @endif
         <blockquote class="blockquote">
            <h4 class="text-white"><p class="ml-3 mt-3">{{ $properties[$i]->name }}</p></h4>
        </blockquote>

            <div class="card-body">

                    <p class="card-text text-white"> Tipo de propiedad: {{ __($properties[$i]->type) }}</p>
                    <p class="card-text text-white"> Nombre: {{ $properties[$i]->name }}</p>

                </div>
            </a>
        </div>
    </div>



