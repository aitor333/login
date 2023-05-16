<?php
session_start();
require_once 'metodos.php';
conectarBD();
showData();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login de Usuario</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
		<h1>Login de Usuario</h1>
		<form action="registrar.php" method="post">

			<label for="username"><b>Usuario</b></label>
			<input type="text" placeholder="Ingrese su usuario" name="username" required>
			<label for="password"><b>Contraseña</b></label>
			<input type="password" placeholder="Ingrese su contraseña" name="password" required>
            <label for="correo"><b>Correo</b></label>
			<input type="text" placeholder="Ingrese su correo" name="correo" required>
			<button type="submit" name="registrar">Registrarse</button>
		</form>
      <?php
        if(isset($_POST['registrar'])){
            $state = validarUser($_POST['username'],$_POST['password']);
            if($state){
				header("location:login.php");
			}else{
				try{
					echo "Fallo al registrar,el usuario y el correo ya existen";
				} catch (mysqli_sql_exception $e) {
					echo "Error al validar el usuario: " . $e.getMessage();
				}
				
			}
			
        }
      ?>

        
	</div>
</body>