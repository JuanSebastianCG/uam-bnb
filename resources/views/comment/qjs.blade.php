<!-- likes and dislike -->
@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

/* agregar */
$(function() {
  $('#sendComment').on('click', function(e) {
    let text = document.getElementById('commentSection').value;
    createQualification(text)
  });
});
function createQualification(text) {
     console.log(" a crear ");
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
                Swal.fire({
                icon: 'success',
                title: 'Creación realizada con éxito',
                showConfirmButton: false,
                timer: 1500
                })
            },
            error:function(){
                console.log(JSON.stringify(error));
            }
		});
}






/* listar comentarios  */
function lookForQuailification(type){
console.log(type)

$.ajax({
        type:'GET',
        url:'{!!URL::to('lookForQualification')!!}',
        data:{'user': user,'property': property},
            success:function(data){
             if (data[0]) {
                 if (data[0]['type']!=type) {

                    editQualification(data[0]['id'],type);

                 }else{
                     deleteQualification(data[0]['id']);
                 }
             }else{
                createQualification(type, user, property);
             }
             likesDislikesCounter();

            },
            error:function(){
                console.log(JSON.stringify(error));
            }
		});
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



