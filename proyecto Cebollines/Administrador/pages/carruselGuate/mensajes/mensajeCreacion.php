
?>
<script LANGUAGE="javascript">
    $(document).ready(function() {
        Swal.fire({
        title: 'Creación',
        text: "Datos almacenados correctamente. =)",
        icon: 'success',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "carrusel.php";
        }
        })
    });
</script>                
<?php 

