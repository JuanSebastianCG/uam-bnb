<!-- likes and dislike -->
@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

<script>

/* ======== agregar ======== */
$(function() {
  $('#sendComment').on('click', function(e) {
    let text = document.getElementById('MakeCommentSection').value;
    createComment(text)
  });
});

function createComment(text) {
     console.log(" a crear "+ text);
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
     $.ajax({
         type:"POST",
         url: '{{ route("comments.store") }}',
         data:{'user': user,'property': property, 'text':text},
            success:function(data){
                console.log(data);
                Swal.fire({
                icon: 'success',
                title: 'Creación realizada con éxito',
                showConfirmButton: false,
                timer: 1500
                })
                allComents();
            },
            error:function(){
                console.log(JSON.stringify(error));
            }
		});
}






/* ======== listar ======== */
function allComents(){

var  url =   '{{ route("allComments", ":id") }}'
url = url.replace(':id', property['id'])
$.ajax({
    type:'GET',
    url:url,
        success:function(data){
        console.log(data);
         addFieldswithOptionalException(data['comments']['data'], data['userComments'], -1 );
        },
        error:function(){
            console.log(JSON.stringify(error));
        }
    });

}

function addFieldswithOptionalException(comments, user, exception) {
    console.log(comments);
    $( "div" ).remove( "#commentsSection" );

  /*   for (let i = 0; i < comments.length; i++) {
        var CommentSectionDiv
        console.log(comments[i]['text']);

    } */

}




/* eliminar comentario */
 function deleteQualification(id) {
     console.log(" a eliminar "+ id['id']);

     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

     $.ajax({
         type:"DELETE",
         url:"/qualifications/"+id,
            success:function(data){
             console.log(data);

            },
            error:function(){
                console.log(JSON.stringify(error));
            }
		});

}


/* editar comentarios */
function editQualification(id, type) {

    console.log(" a editar "+ id);
    var  url =   '{{ route("qualifications.update", ":id") }}'
    url = url.replace(':id', id)

$.ajaxSetup({
   headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
});

$.ajax({
    type:"PUT",
    url:url,
    data:{'type': type},
       success:function(data){
        console.log(data);

       },
       error:function(){
           console.log(JSON.stringify(error));
       }
   });

}


</script>



