<?php
session_start();
require_once './metodos.php';
require_once './header.php';
const admin = 1;
const user = 2;
?>
<!DOCTYPE html>
<html>
<body>
	<div class="container position-relative w-100vw p-3">
		<h1>Login de Usuario</h1>
		<form method="post" action="login.php">
			<div class="form-labels">
				<div class="col-12">
					<label for="username" class="form-label"><b>Usuario</b></label>
					<input type="text" class="form-control" placeholder="Ingrese su usuario" name="username" id="username" required>
				</div>
				<div class="col-12">
					<label for="password" class="form-label" ><b>Contraseña</b></label>
					<input type="password" class="form-control" placeholder="Ingrese su contraseña" name="password" id="password" required>
				</div>
				<div class="botones">
					<div class="col-12">
						<button type="submit" class="btn-primary" name="login" id="login">Iniciar Sesión</button>
					</div>
				</div>
				<div class="complementos_enlaces">
					<span name="psw" class="psw col-8" name="forget" id="forget">¿Olvidaste tu <a href="recovery.php" name='forget'>contraseña?</a></span>
					<span name="psw" class="psw col-8">¿No tienes una cuenta? <a href="registrar.php">Regístrate</a></span>
				</div>
				
				
				
				
				
			</div>
		</form>
		<?php
		if(isset($_POST['login'])){
			$_SESSION['nombreForm'] = $_POST['username'];
			$_SESSION['nombreBd'] = getCorreo($_POST['username']);
			$_SESSION['contrasenaForm'] = $_POST['password'];
			$_SESSION['contrasenaBd'] = getPassword($_POST['username']);
			if(password_verify($_SESSION['contrasenaForm'],$_SESSION['contrasenaBd'])){
				header("location:menu.php");
			}else{
				echo "Password Incorrecto"."<br>";
			}
		}
	?>
		
	</div>
	<?php
	if(isset($_GET['message'])){
	?>
	<div class="alert alert-warning position-absolute bottom-0 start-50 translate-middle-x" role="alert">
	<?php
	switch($_GET['message']){
		case 'ok':
			echo "Por favor,revisa tu correo electronico";
			break;

		case 'success_password':
			echo 'Inicia sesion con tu nueva contraseña';
			break;
		
		default:
			echo "Algo salio mal,intentalo de nuevo";
			break;
	}
	}
	?>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>

