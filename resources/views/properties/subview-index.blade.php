<div class="col-sm-3 " id="PropertyField">
    <div class="card text-white mb-3 " id="card" style="width: 25rem; height: 36rem ;">
        <a href="{{ route('properties.show', $property,  Auth::user() ) }}" style="flex: 1;">


            @if ($photos[$i] != null)
                <img class="card-img-top" height="300px" src="/property_images/{{ $photos[$i]->url_image }}"
                    alt="Card image cap">
            @else
                <img class="card-img-top" height="300px" src="/property_images/defaultImage.jpg" alt="Card image cap">
            @endif
            <blockquote class="blockquote ml-3 mt-3">
                <div class="row">
                    <h4 class="col-8">
                        <div>{{ $property->name }}</div>
                    </h4>

                    <div class="col-auto " id="qualification">
                        <i class="fa-solid fa-thumbs-up"></i>
                        <span class="likes" id="likes">{{ $qualifications[$i]['likes'] }}</span>
                        <i class="fa-solid fa-thumbs-down"></i>
                        <span class="dislikes" id="dislikes">{{ $qualifications[$i]['dislikes'] }}</span>
                    </div>

                </div>
                <div id="borderZone">
                    <div class="whiteBotton"></div>
                    <small class="text-muted">{{ __($property->type) }}</small>
                </div>
            </blockquote>

            <div class="ml-4 descriptionField texto">
                Descripcion:
                <div class="compact texto">{{ $property->description }} <span></span></div>
                <div class="whiteBotton"></div>

                <div class="row">
                    <div class=" col-9 mt-3  " style="color: rgb(70, 67, 69)"> Precio Diario: </div>
                    <div class="money col-3 ">${{ $property->daily_Lease_Value }}</div>
                </div>
            </div>
        </a>
    </div>
</div>
