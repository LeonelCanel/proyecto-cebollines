
<?php
    include '../conexion/conexion.php';        
    $contador = 0;
    $usuarioObtenido = "";
    $usuarioApellido = "";
    $tipoRol = "";
    $result = mysqli_query($mysqli, "SELECT u.uuid_usuario, u.usuario, u.nombres_usuario, u.apellidos_usuario, u.correo, u.uuid_rol, r.uuid_rol, r.tipo_rol  FROM usuarios as u INNER JOIN rol as r ON u.uuid_rol = r.uuid_rol WHERE u.uuid_usuario = '$uuid_usuario'");
    $contador = 0;
    while ($row = mysqli_fetch_assoc($result)):
        $contador++;
        $usuarioObtenido = $row['nombres_usuario'];
        $usuarioApellido = $row['apellidos_usuario'];
        $tipoRol = $row['tipo_rol'];
    endwhile;
?>




<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">
            <b>Usuario Logueado</b> 
        </li>
        <li class="nav-header"><?php echo $usuarioObtenido." ".$usuarioApellido; ?></li>
        <hr>
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <?php if ($tipoRol == 'ADMINISTRADOR'){ ?>
            <li class="nav-header" style="margin-top: 3%;">
            <b>Usuarios</b> 
            </li>
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
                        <i class="fas fa-eye"></i>
                        <p>Ver Usuarios</p>
                    </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="../usuarios/roles.php" class="nav-link">
                        <i class="fas fa-user-tie"></i>
                        <p>Roles</p>
                    </a>
                    </li>
                </ul>
            </li>
        <?php } ?>


            <hr>
        <li class="nav-header">
            <i class="fas fa-map-marked-alt"></i>
            <b>Guatemala</b>
        </li> 
        
        <li class="nav-item">
        <a href="../menus/menus.php" class="nav-link">
            <i class="nav-icon fas fa-utensils"></i>
            <p>
                Menú Guatemala
            </p>
        </a>
        </li>

        <li class="nav-item">
        <a href="../carruselGuate/carrusel.php" class="nav-link">
            <i class="fas fa-photo-video"></i>
            <p>
                Carrusel Guatemala
            </p>
        </a>
        </li>

        <hr>
        <li class="nav-header">
            <i class="fas fa-map-marked-alt"></i>
            <b>Salvador</b>
        </li> 
        
          <li class="nav-item">
            <a href="../salvador/menusSalvador.php" class="nav-link">
              <i class="nav-icon fas fa-utensils"></i>
              <p>
                Menú Salvador
              </p>
            </a>
          </li>


          <li class="nav-item">
        <a href="../carruselSalva/carruselSV.php" class="nav-link">
            <i class="fas fa-photo-video"></i>
            <p>
                Carrusel Salvador
            </p>
        </a>
        </li>
        <br>

        <li class="nav-header">
            <i class="fas fa-business-time"></i>
            <b>Mercadito</b>
        </li> 
        
          <li class="nav-item">
            <a href="../mercadito/mercadito.php" class="nav-link">
            <i class="fas fa-drumstick-bite"></i>
              <p>
                Mercadito
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