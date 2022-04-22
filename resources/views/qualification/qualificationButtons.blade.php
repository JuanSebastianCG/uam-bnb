    <div id="likedislike" class=" mb-4 ">
        <div type="button" class="btn btn-dark like " id="like">Like
            <i class="fa-solid fa-thumbs-up"></i>
            <span class="likes" id="likes">{{ $qualifications['likes'] }}</span>
        </div>
        <div type="button" class="btn btn-dark adislike" id="dislike">Dislike
            <i class="fa-solid fa-thumbs-down"></i>
            <span class="dislikes" id="dislikes">{{ $qualifications['dislikes'] }}</span>
        </div>
        @if (auth()->user()->id == $user->id)
            <a type="button" id="addPhoto" class="btn btn-outline-success"
                href='{{ route('photos', $property->id) }}'>Agregar Foto</a>

        @endif
    </div>
