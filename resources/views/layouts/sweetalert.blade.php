

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- borrado -->
@if(session('deleted')=='ok')
    <script>
       Swal.fire(
      'Eliminado!',
      'Elemento elimnado.',
      'success'
    )
    </script>
@endif

@if(session('added')=='ok')
    <script>
        Swal.fire({
        icon: 'success',
        title: 'Agregado con exito :)',
        showConfirmButton: false,
        timer: 1500
        })

    </script>
@endif

@if($comprobado ?? ''==1)
    <script>
    Swal.fire({
        icon: 'success',
        title: 'Actualizado con exito :)',
        showConfirmButton: false,
        timer: 1500
        })

    </script>
@endif

@if($creado ?? ''==1)
    <script>
 Swal.fire({
        icon: 'success',
        title: 'Creación realizada con éxito',
        showConfirmButton: false,
        timer: 1500
        })

    </script>
@endif


<!-- eliminar -->
<script>
    $('.formEliminar').submit(function(e){
        e.preventDefault();
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
            this.submit();
        }
    })
})
</script>

<script>
    $('.formPagar').submit(function(e){
        e.preventDefault();
        Swal.fire({
        title: '¿Está seguro de que desea pagar?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, deseo pagar'
        }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    })
})
</script>

@endsection


