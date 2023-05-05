<?php
global $datosValidadosLogin;
function validarUser($user,$password){

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Los datos del formulario se han enviado correctamente.
        // Verificar que el nombre de usuario no esté vacío y tenga al menos 4 caracteres.
        if (empty($_POST['username']) || strlen($_POST['username']) < 4) {
            $errors[] = "El nombre de usuario debe tener al menos 4 caracteres.";
        }
        
        // Verificar que la contraseña no esté vacía y tenga al menos 8 caracteres.
        if (empty($_POST['password']) || strlen($_POST['password']) < 8) {
            $errors[] = "La contraseña debe tener al menos 8 caracteres.";
        }

        if (!empty($errors)) {
            echo "<ul name='l2'>";
            foreach ($errors as $error) {
              echo '<li>' . $error . '</li>';
            }
            echo '</ul>';
          } else {
            // No hay errores, los datos del formulario son válidos.
            // Guardar los datos del usuario en la base de datos.
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $correo = $_POST['correo'];

            $datosValidadosLogin = array();
            array_push($datosValidadosLogin,$username,$password,$correo);

            if(insertarUsuario($username,$password,$correo)){
                return true;
            }else{
               return false;
            }
          }
    }
}

function showData(){
    $inicial = array();
    $msg1 = "El nombre de usuario debe tener al menos 4 caracteres.";
    $msg2 = "La contraseña debe tener al menos 8 caracteres.";
    array_push($inicial,$msg1,$msg2);
    if (!empty($inicial)) {
        echo "<ul name='l1'>";
        foreach ($inicial as $init) {
          echo '<li>' . $init . '</li>';
        }
        echo '</ul>';
    }
}

function showSesiones(){
    echo "Nombre Formulario :". $_SESSION['nombreForm'];
	echo "NombreBd:". $_SESSION['nombreBd'];
    echo "Contraseña Formulario : ". $_SESSION['contrasenaForm'] ."<br>";
    echo "Contraseña Bd : ".$_SESSION['contrasenaBd'];
}

function redirigir($direccion,$boton){
    if(isset($boton)){
        header("location:".$direccion);
    }
}

function conectarBD(){
    $servername = "localhost";
    $database = "usersBD";
    $username = "root";
    $password = "";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

function insertarUsuario($user,$password,$correo){
    try{
        $conn = conectarBD();
        $sql = "INSERT INTO usuarios (nombre, contrasena,correo) VALUES ('$user', '$password','$correo')";
        if (mysqli_query($conn, $sql)) {
            echo "Se ha completado el registro correctamente.";
        } else {
        // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        return true;
        mysqli_close($conn);
    }catch(Exception $e){
        echo "Fallo ".$e;
        return false;
    }
}


function updatePassword($password){
    try{
        $correo = $_SESSION['nombreForm'];
        $user = getNombreFromCorreo($correo);
        $passwordOld = getPassword($user);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $conn = conectarBD();
        $sql = "UPDATE usuarios set contrasena = '$password' where nombre = '$user'";
        //echo $sql;
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
        return true;
        mysqli_close($conn);
    }catch(Exception $e){
        echo "Fallo ".$e;
        return false;
    }
}

function getNombreFromCorreo($correo){
    $conn = conectarBD();
    $sql = "SELECT nombre FROM usuarios WHERE correo='$correo'";
    $result = mysqli_query($conn,$sql);
    while($mostrar=mysqli_fetch_array($result)){
      return $mostrar["nombre"];
    }
}

function getUserFromPassword($password){
    $conn = conectarBD();
    $sql = "SELECT nombre FROM usuarios WHERE contrasena='$password'";
    echo $sql;
    $result = mysqli_query($conn,$sql);
    while($mostrar=mysqli_fetch_array($result)){
      return $mostrar["nombre"];
    }
}

function getUsername($nombre){
    $conn = conectarBD();
    $sql = "SELECT nombre FROM usuarios WHERE nombre='$nombre'";
    $result = mysqli_query($conn,$sql);
    while($mostrar=mysqli_fetch_array($result)){
      return $mostrar["nombre"];
    }
}

function getPassword($user){
    $conn = conectarBD();
    $sql = "SELECT contrasena FROM usuarios WHERE correo='$user'";
    echo $sql;
    $result = mysqli_query($conn,$sql);
    while($mostrar=mysqli_fetch_array($result)){
      return $mostrar["contrasena"];
    }
}

function getCorreo($correo){
    $conn = conectarBD();
    $sql = "SELECT correo FROM usuarios WHERE correo='$correo'";
    $result = mysqli_query($conn,$sql);

    while($mostrar=mysqli_fetch_array($result)){
      return $mostrar["correo"];
    }
}

function getIdUsuario($nombre){
    $conn = conectarBD();
    $sql = "SELECT id_usr FROM usuarios WHERE nombre='$nombre'";
    $result = mysqli_query($conn,$sql);
    while($mostrar=mysqli_fetch_array($result)){
      return $mostrar["id_usr"];
    }
}