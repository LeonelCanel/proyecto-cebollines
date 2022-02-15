<?php
    $uuid_usuario = substr($usuario, 0, 23);
    include 'pages/conexion/conexion.php';
    $uuid_rol = "";
    $result = mysqli_query($mysqli, "SELECT * FROM usuarios WHERE uuid_usuario = '".$uuid_usuario."'");
    while ($row = mysqli_fetch_assoc($result)):
        $uuid_rol = $row['uuid_rol'];
        echo "<script>console.log('uuid rol: " . $uuid_rol . "' );</script>";
    endwhile
?>
<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
            
        <?php
        echo "<script>console.log('antes del if: " . $uuid_rol . "' );</script>";
        if ($uuid_rol == "61ce75d996e339.36871378") { ?> 
        <li class="nav-header">Usuarios</li>
            <li class="nav-item">
                <a href="" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                    Usuarios
                    <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="../usuarios/usuarios.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Ver Usuarios</p>
                    </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="../usuarios/roles.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Roles</p>
                    </a>
                    </li>
                </ul>
            </li>
            <?php } ?>
        <li class="nav-header">Menús</li>
        <li class="nav-item">
        <a href="../menus/menus.php" class="nav-link">
            <i class="nav-icon fas fa-utensils"></i>
            <p>
            Menús
            </p>
        </a>
        </li>
        <li class="nav-header">Salvador</li>
        <li class="nav-item">
        <a href="../salvador/menusSalvador.php" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p>
                Administración Salvador
            </p>
        </a>
        </li>
        <li class="nav-header" style="margin-top:45%;">Salir</li>
        <li class="nav-item">
        <a href="../../login/login.php" class="nav-link">
        <i class="fas fa-sign-out-alt"></i>
            <p>
            Cerrar Sesión
            </p>
        </a>
        </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->