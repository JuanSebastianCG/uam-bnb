<script>

$(function() {
  $(document).on('click','#cleanButton', function(e) {

    city = document.getElementById('city');
    startDate = document.getElementById('startDate');
    endDate = document.getElementById('endDate');
    city.value = "";
    startDate.value = "";
    endDate.value = "";

  });
});



</script>

