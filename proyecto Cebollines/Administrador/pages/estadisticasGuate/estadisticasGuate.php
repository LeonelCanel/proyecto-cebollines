<!-- Inicio de las estadisticas de Guatemala -->
  
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
            date_default_timezone_set("America/Guatemala");
            $fechaYHoraInicio = date("Y-m-d");
            $fechaYHoraFin = date("Y-m-d");
            $horaInicio = ' 00:00:00';
            $horaFin = ' 23:59:00';
            $fechaYHoraInicio = $fechaYHoraInicio.$horaInicio;
            $fechaYHoraFin = $fechaYHoraFin.$horaFin;
            include '../Administrador/pages/conexion/conexion.php';
            $contador = 0;
            
            $result = mysqli_query($mysqli, "SELECT * FROM visitasgt WHERE fecha_creacion BETWEEN '$fechaYHoraInicio' AND '$fechaYHoraFin'");
            while ($row = mysqli_fetch_assoc($result)){ 
                $contador = $contador + 1;
            }
        ?>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $contador;?></h3>
                  
                <p>Cantidad de usuarios que han <br> visitado el QR. el día de hoy. <b> <?= $fecha = date("d-m-Y"); $fecha = $fechaYHoraInicio;?></b></p>
              </div>
              <div class="icon">
                <i class="ion ion-cash"></i>
              </div>
              <a href="pages/estadisticasGuate/rangosFechasVisitas.php" class="small-box-footer">Más detalles <i class="fas fa-arrow-circle-right"></i></a>
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
    </section> <!-- Fin de las estadisticas de Guatemala -->
    <!-- /.content -->





    <!-- Inicio de las estadisticas del salvador -->
    <hr>
    <?php
        include '../Administrador/pages/conexion/conexion.php';
        $cantidadObtenidaMenus = 0;
        $contador = 0;
        $result = mysqli_query($mysqli, "SELECT * FROM menusv;");
        while ($row = mysqli_fetch_assoc($result)){ 
            $contador = $contador + 1;
    }
    ?>
    <h1 style="margin-top: 5%;">Salvador</h1>
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
            $result = mysqli_query($mysqli, "SELECT s.uuid_seccion_sv, s.nombre_seccion_sv, s.uuid_menu_sv, m.uuid_menu_sv, m.nombre_menu_sv, 
            i.uuid_item_sv, i.nombre_item_sv, i.uuid_seccion_sv, p.uuid_precio_sv, p.precio_normal_sv, p.precio_doble_sv, p.uuid_item_sv FROM seccionessv s 
            INNER JOIN itemssv i ON s.uuid_seccion_sv = i.uuid_seccion_sv 
            INNER JOIN preciossv p ON i.uuid_item_sv = p.uuid_item_sv 
            INNER JOIN menusv m ON s.uuid_menu_sv = m.uuid_menu_sv WHERE m.uuid_menu_sv = '61dd212364f312.28490463'
            ORDER BY p.precio_normal_sv DESC LIMIT 1;");
            while ($row = mysqli_fetch_assoc($result)){ 
                $contadorPrecio = $row['precio_normal_sv'];
            }
            
        ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><sup style="font-size: 20px">$. </sup><?= $contadorPrecio;?></h3>

                <p>Precio más alto (Almuerzo)</p>
              </div>
              <div class="icon">
                <i class="ion ion-cash"></i>
              </div>
              <a href="pages/estadisticasGuate/detallesAlmuerzoSV.php" class="small-box-footer">Más detalles <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <?php
            include '../Administrador/pages/conexion/conexion.php';
            $cantidadObtenidaMenus = 0;
            $contadorPrecio = 0;
            $result = mysqli_query($mysqli, "SELECT s.uuid_seccion_sv, s.nombre_seccion_sv, s.uuid_menu_sv, m.uuid_menu_sv, m.nombre_menu_sv, 
            i.uuid_item_sv, i.nombre_item_sv, i.uuid_seccion_sv, p.uuid_precio_sv, p.precio_normal_sv, p.precio_doble_sv, p.uuid_item_sv FROM seccionessv s 
            INNER JOIN itemssv i ON s.uuid_seccion_sv = i.uuid_seccion_sv 
            INNER JOIN preciossv p ON i.uuid_item_sv = p.uuid_item_sv 
            INNER JOIN menusv m ON s.uuid_menu_sv = m.uuid_menu_sv WHERE p.precio_normal_sv <> 0 and s.uuid_menu_sv = '61dd21174426a0.70074746'
            ORDER BY p.precio_normal_sv DESC LIMIT 1;");
            while ($row = mysqli_fetch_assoc($result)){ 
                $contadorPrecio = $row['precio_normal_sv'];
            }
            
        ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><sup style="font-size: 20px">$. </sup><?= $contadorPrecio;?></h3>

                <p>Precio más alto (Desayuno)</p>
              </div>
              <div class="icon">
                <i class="ion ion-cash"></i>
              </div>
              <a href="pages/estadisticasGuate/detallesDesayunoSV.php" class="small-box-footer">Más detalles <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <?php
            date_default_timezone_set("America/Guatemala");
            $fechaYHoraInicio = date("Y-m-d");
            $fechaYHoraFin = date("Y-m-d");
            $horaInicio = ' 00:00:00';
            $horaFin = ' 23:59:00';
            $fechaYHoraInicio = $fechaYHoraInicio.$horaInicio;
            $fechaYHoraFin = $fechaYHoraFin.$horaFin;
            include '../Administrador/pages/conexion/conexion.php';
            $contador = 0;
            
            $result = mysqli_query($mysqli, "SELECT * FROM visitassv WHERE fecha_creacion BETWEEN '$fechaYHoraInicio' AND '$fechaYHoraFin'");
            while ($row = mysqli_fetch_assoc($result)){ 
                $contador = $contador + 1;
            }
        ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $contador;?></h3>

                <p>Cantidad de usuarios que han <br> visitado el QR. el día de hoy. <b> <?= $fecha = date("d-m-Y"); $fecha = $fechaYHoraInicio;?></b></p>
              </div>
              <div class="icon">
                <i class="ion ion-cash"></i>
              </div>
              <a href="pages/estadisticasGuate/rangosFechasVisitasSV.php" class="small-box-footer">Más detalles <i class="fas fa-arrow-circle-right"></i></a>
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
    </section><!-- Fin de las estadisticas del salvador -->











  </div>
  <!-- /.content-wrapper -->
