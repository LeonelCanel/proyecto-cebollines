
?>
<script LANGUAGE="javascript">
    $(document).ready(function() {
        Swal.fire({
        title: 'Error',
        text: "A ocurrido un error al eliminar los datos, por favor comuniquese con un Administrador.",
        icon: 'error',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "menus.php";
        }
        })
    });
</script>                
<?php 

