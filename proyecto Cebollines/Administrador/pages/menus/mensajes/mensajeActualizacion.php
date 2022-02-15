
?>
<script LANGUAGE="javascript">
    $(document).ready(function() {
        Swal.fire({
        title: 'Actualización',
        text: "Datos actualizados correctamente correctamente. =)",
        icon: 'success',
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

