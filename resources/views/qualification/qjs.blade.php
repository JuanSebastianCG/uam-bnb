<!-- likes and dislike -->

<script>
    const property = {!! json_encode($property) !!};
    const user = {!! json_encode($user) !!};
$(function() {
  $('#dislike').on('click', function(e) {
    lookForQuailification("dislike")
  });
});
$(function() {
  $('#like').on('click', function(e) {
    lookForQuailification("like")
  });
});
function likesDislikesCounter() {
var likes = document.getElementById('likes');
var dislikes = document.getElementById('dislikes');
console.log(likes)
var  url =   '{{ route("allQualifications", ":id") }}'
url = url.replace(':id', property['id'])
$.ajax({
    type:'GET',
    url:url,
        success:function(data){
            console.log(data)
             likes.textContent = data['likes'];
            dislikes.textContent = data['dislikes'];
        },
        error:function(){
            console.log(JSON.stringify(error));
        }
    });
}
/* buscar  */
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
/* eliminar */
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
/* agregar */
function createQualification(type) {
     console.log(" a crear ");
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
     $.ajax({
         type:"POST",
         url:'{{route('qualifications.store')}}',
         data:{'user': user,'property': property, 'type': type},
            success:function(data){
             console.log(data);
            },
            error:function(){
                console.log(JSON.stringify(error));
            }
		});
}
/* editar */
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

