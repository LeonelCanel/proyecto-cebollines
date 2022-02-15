<script type="text/javascript">
    window.history.forward();
    function sinVueltaAtras(){ window.history.forward(); }
</script>


<!doctype html>
<html lang="en">
  <head>
  	<title>GALA | Cebollines</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body  onload="sinVueltaAtras();" onpageshow="if (event.persisted) sinVueltaAtras();" onunload=""; class="img js-fullheight" style="background-image: url(images/bg.jpg);">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center" >
				<div class="col-md-6 text-center mb-5">
					
				</div>
			</div>
			<div class="row justify-content-center" >
				<div class="col-md-4 col-lg-4" >
					<div class="login-wrap p-0" >
					<h2 class="heading-section" style="text-align: center;">Iniciar Sesión</h2><br><br>
		      	<form action="loguear.php" method="POST" class="signin-form">
		      		<div class="form-group">
		      			<input type="email" class="form-control" id="correo" name="correo" placeholder="Correo Electrónico" required>
		      		</div>
	            <div class="form-group">
	              <input id="password-field" type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Contraseña" required>
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	            </div>
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary submit px-3">Iniciar Sesión</button>
	            </div>
	            <div class="form-group d-md-flex">
	            </div>
	          </form>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>
