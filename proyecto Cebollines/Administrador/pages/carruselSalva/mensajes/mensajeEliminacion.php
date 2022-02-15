
?>
<script LANGUAGE="javascript">
    $(document).ready(function() {
        Swal.fire({
        title: 'Eliminación',
        text: "Datos eliminados correctamente. =)",
        icon: 'success',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "carruselSV.php";
        }
        })
    });
</script>                
<?php 

