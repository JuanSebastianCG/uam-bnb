<script>

$(function() {
  $(document).on('click','#filter', function(e) {

      startDate = $('#startDate').val().split('/');
      endDate = $('#endDate').val().split('/');
      price = document.getElementById('price').value;
      city = document.getElementById('city').value;
      filterProperties(startDate,endDate,price,city)

  });
});


function filterProperties(startDate,endDate,price,city) {

var url = '{{ route('filterProperty') }}'

$.ajax({
    type: 'GET',
    url: url,
    data: {
        'startDate': startDate,
        'endDate': endDate,
        'price': price,
        'city': city
                    },
    success: function(data) {
        console.log(data);

    },
    error: function() {
        console.log(JSON.stringify(error));
    }
});

}

function showPropertys(Properties) {


}

</script>
