

<script>

const latitude = {!! json_encode($property->latitude) !!}
const longitude ={!! json_encode($property->longitude) !!}

mapboxgl.accessToken = 'pk.eyJ1Ijoic2F0eXJpZDMwMjciLCJhIjoiY2wyMXo2YWx4MDl3NDNvcnJ0MDFpNG1zbSJ9._3tO4Xv2SfT4-170jkvNVQ';
const map = new mapboxgl.Map({
container: 'map', // container ID
style: 'mapbox://styles/mapbox/streets-v11', // style URL
center: [ longitude,latitude], // starting position [lng, lat]
zoom: 14 // starting zoom


});

let element = document.createElement('div')


const marker1 = new mapboxgl.Marker()
.setLngLat([ longitude,latitude])
.addTo(map);

map.on('load', function () {
    map.resize();
});

</script>
