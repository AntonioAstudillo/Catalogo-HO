 <!doctype html>
 <html lang="en">
   <head>
   	<title>HO | Administradores</title>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 	  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
 	  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 	  <link rel="stylesheet" href="<?php echo RUTA;?>css/login.css">
     <script src="https://www.google.com/recaptcha/api.js?render="></script>

 	</head>
 	<body>
 	<section class="ftco-section">
 		<div class="container">
 			<div class="row justify-content-center">
 				<div class="col-md-7 col-lg-5">
 					<div class="login-wrap p-4 p-md-5">
 		      	<div class="icon d-flex align-items-center justify-content-center">
 		      		<span class="fa fa-user-o"></span>
 		      	</div>
 		      	<h3 class="text-center mb-4">Administradores</h3>
 						<form method="post" id="formLoginHO" class="login-form">
 		      		<div class="form-group">
 		      			<input type="text" class="form-control rounded-left" name="userHO" placeholder="Username" required>
                <input type="hidden" name="tokenHO" value="<?php echo $token ?>">
 		      		</div>
 	            <div class="form-group d-flex">
 	              <input type="password" class="form-control rounded-left" name="passwordHO" placeholder="Password" required>
 	            </div>
 	            <div class="form-group">
 	            	<button type="submit" id="btnIngresarL" class="form-control btn btn-primary rounded submit px-3">Ingresar</button>
 	            </div>
 	          </form>
 	        </div>
 				</div>
 			</div>
 		</div>
 	</section>
  <div class="container">
    <a href="../../index.php" class="btn btn-outline-primary">Regresar</a>
  </div>
 	</body>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script src="<?php echo RUTA; ?>JS/login.js"></script>
 </html>
