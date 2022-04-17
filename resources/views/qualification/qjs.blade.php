<!-- likes and dislike -->

<script>

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

function lookForQuailification(type){
console.log(type)
const user = {!! json_encode($user) !!};
const property = {!! json_encode($property) !!};
$.ajax({
        type:'GET',
        url:'{!!URL::to('lookForQualification')!!}',
        data:{'user': user,'property': property},
            success:function(data){
             if (data[0]) {
                 deleteQualification(data[0]);
             }


            },
            error:function(){
                console.log(JSON.stringify(error));
            }
		});
}


 function deleteQualification(id) {
     console.log(" a eliminar "+ id['id']);

     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

     $.ajax({
         type:"DELETE",
         url:"/destroyQualification/"+id['id'],
            success:function(data){
             console.log(data);

            },
            error:function(){
                console.log(JSON.stringify(error));
            }
		});







}


</script>



