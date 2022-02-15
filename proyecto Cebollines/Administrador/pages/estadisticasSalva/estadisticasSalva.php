  <!-- Content Wrapper. Contains page content -->

  <!-- /.content-wrapper -->  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Guatemala</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php
        include '../Administrador/pages/conexion/conexion.php';
        $cantidadObtenidaMenus = 0;
        $contador = 0;
        $result = mysqli_query($mysqli, "SELECT * FROM menus;");
        while ($row = mysqli_fetch_assoc($result)){ 
            $contador = $contador + 1;
    }
    ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3><?= $contador;?></h3>

                <p><b>Cantidad de menús activos.</b></p>
              </div>
              <div class="icon">
                <i class="ion ion-fork"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
        <?php
            include '../Administrador/pages/conexion/conexion.php';
            $cantidadObtenidaMenus = 0;
            $contadorPrecio = 0;
            $result = mysqli_query($mysqli, "SELECT s.uuid_seccion, s.nombre_seccion, s.uuid_menu, m.uuid_menu, m.nombre_menu, 
            i.uuid_item, i.nombre_item, i.uuid_seccion, p.uuid_precio, p.precio_normal, p.precio_doble, p.uuid_item FROM secciones s 
            INNER JOIN items i ON s.uuid_seccion = i.uuid_seccion 
            INNER JOIN precios p ON i.uuid_item = p.uuid_item 
            INNER JOIN menus m ON s.uuid_menu = m.uuid_menu WHERE m.uuid_menu = '61ce95f8bed869.59036717'
            ORDER BY p.precio_normal DESC LIMIT 1;");
            while ($row = mysqli_fetch_assoc($result)){ 
                $contadorPrecio = $row['precio_normal'];
            }
            
        ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><sup style="font-size: 20px">Q. </sup><?= $contadorPrecio;?></h3>

                <p>Precio más alto (Almuerzo)</p>
              </div>
              <div class="icon">
                <i class="ion ion-cash"></i>
              </div>
              <a href="pages/estadisticasGuate/detallesAlmuerzo.php" class="small-box-footer">Más detalles <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <?php
            include '../Administrador/pages/conexion/conexion.php';
            $cantidadObtenidaMenus = 0;
            $contadorPrecio = 0;
            $result = mysqli_query($mysqli, "SELECT s.uuid_seccion, s.nombre_seccion, s.uuid_menu, m.uuid_menu, m.nombre_menu, 
            i.uuid_item, i.nombre_item, i.uuid_seccion, p.uuid_precio, p.precio_normal, p.precio_doble, p.uuid_item FROM secciones s 
            INNER JOIN items i ON s.uuid_seccion = i.uuid_seccion 
            INNER JOIN precios p ON i.uuid_item = p.uuid_item 
            INNER JOIN menus m ON s.uuid_menu = m.uuid_menu WHERE p.precio_normal <> 0 and s.uuid_menu = '61ce95cc4463c8.11575921'
            ORDER BY p.precio_normal DESC LIMIT 1;");
            while ($row = mysqli_fetch_assoc($result)){ 
                $contadorPrecio = $row['precio_normal'];
            }
            
        ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><sup style="font-size: 20px">Q. </sup><?= $contadorPrecio;?></h3>

                <p>Precio más alto (Desayuno)</p>
              </div>
              <div class="icon">
                <i class="ion ion-cash"></i>
              </div>
              <a href="pages/estadisticasGuate/detallesDesayuno.php" class="small-box-footer">Más detalles <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->


          <?php
            include '../Administrador/pages/conexion/conexion.php';
            $cantidadObtenidaMenus = 0;
            $contadorUsuarios = 0;
            $result = mysqli_query($mysqli, "SELECT * FROM usuarios;");
            while ($row = mysqli_fetch_assoc($result)){ 
                $contadorUsuarios = $contadorUsuarios + 1;
            }
        ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $contadorUsuarios;?></h3>

                <p>Usuarios Registrados</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->

          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->

        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
