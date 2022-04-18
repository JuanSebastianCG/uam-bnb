<!-- likes and dislike -->
@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

<script>

/* ======== agregar ======== */
$(function() {
  $(document).on('click','#sendComment', function(e) {
    e.preventDefault();
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
         addFieldswithOptionalException(data['comments']['data'], data['userComments'],data['commentsDiffForHuman'] ,-1 );
        },
        error:function(){
            console.log(JSON.stringify(error));
        }
    });

}

function addFieldswithOptionalException(comments, userComment, diffForHumans,  exception) {
    console.log(comments);
    $('.commentsSection').html('');
    let commentSection="";

    for (let i = 0; i < comments.length; i++) {
        if (exception == i) {
            commentSection += 



        }else{
         commentSection += "<div class='card border-dark mb-3' style='' id='commentCard'>"
         commentSection += "<div class='card-body'>"
         commentSection += " <div class='row'>"
         commentSection += "<h4 class='card-title col-10 mr-5' id=''>"+userComment[i]['name'] +"</h4>"

        if (userComment[i]['id'] == user['id']) {
            commentSection += "<button class='deleteIcon2 btn col-auto ml-4 ' onClick='deleteQualification(this.id)' id='"+comments[i]['id'] +"'><i class='ml-1 fa-solid fa-trash' ></i> </button>"
            commentSection += "<button class='updateIcon btn col-auto' onClick='editQualification(this.id)' id='"+comments[i]['id'] +"' ><i class='ml-auto fa-solid fa-pen-to-square' ></i> </button>"

        }
         commentSection += "<h6 class='card-subtitle mb-2 text-muted'>"+diffForHumans[i]+"</h6>"
         commentSection += "<p class='card-text'>"+ comments[i]['text'] +"</p>"
         commentSection += "</div></div></div>"
        }

    }
    $('.commentsSection').append(commentSection);
    console.log(commentSection);
}


/* ======== eliminar ======== */
 function deleteQualification(id) {
    var  url =   '{{route("comments.destroy", ":id") }}'
    url = url.replace(':id', id)
    Swal.fire({
        title: '¿Estas seguro?',
        text: "No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'si, eliminalo!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:"DELETE",
                data:{'property_id': property['id']},
                url:url,
                    success:function(data){
                        console.log(data);
                        allComents();
                        Swal.fire(
                            'Eliminado!',
                            'Elemento elimnado.',
                            'success'
                        )

                    },
                    error:function(){
                        console.log(JSON.stringify(error));
                    }
                });
            }
        });

 }


//============ editar =============
function editQualification(id) {

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



