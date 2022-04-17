<!-- likes and dislike -->

<script>

$(function() {
  $('#dislike').on('click', function(e) {
    postAjax("dislike")
  });
});

$(function() {
  $('#like').on('click', function(e) {
    postAjax("like")

  });
});

function postAjax(type){
console.log(type)
const user = {!! json_encode($user) !!};
const property = {!! json_encode($property) !!};



$.ajax({
        type:'GET',
        url:'{!!URL::to('lookForQualification')!!}',
        data:{'type':type,'user': user,'property': property},
            success:function(data){
             console.log(data);

            },
            error:function(){
                console.log(JSON.stringify(error));
            }
			});
}


</script>



