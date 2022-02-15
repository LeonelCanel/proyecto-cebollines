?>
<script LANGUAGE="javascript">
    $(document).ready(function() {
        Swal.fire({
        title: 'Alerta',
        text: "Las contraseñas ingresadas no coinciden, por favor verifique. =)",
        icon: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "usuarios.php";
        }
        })
    });
</script>                
<?php 