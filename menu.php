<?php
session_start();
require_once 'metodos.php';
require_once 'header.php';
?>
<html>
    <head>
        <title>Pagina de menu</title>
    </head>
    <style>

        .container{
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            height:500px;
        }

        .botones{
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
        }

        .data{
            width:70%;
            height:40%;
            box-shadow: 0 30px 40px rgba(0,0,0,.5);
        }

        button{
            font-size:20px;
            padding:20px 20px;
            border-radius:50%;
        }
    </style>
    <body>
        <h1 style='text-align:center;font-size:30px;font-style:bold;'>Pagina Oficial del menu de prueba de login y registro de usuario</h1>
        <div class="row class='icono'">
            <div class="col-12 d-flex justify-content-end align-items-around">
                <a href="logout.php"><i class="fa-solid fa-right-from-bracket px-3" name="icono"></i></a>    
            </div>    
        </div>

        <?php
        function eventoIconoCerrarSesion(){
                //Eliminamos todas las sesiones del usuario
                session_destroy();
                //Nos redirige a la pantalla de login
                header('location:login.php');
        }
        ?>
        
        <div class="container-fluid d-flex align-items-center justify-content-center">
                    <div class="data">
                        <div class="info_user">
                            <?php
                            echo "<h2 style='text-align:center;font-size:30px;font-style:bold;'> Bienvenido Usuario ".$_SESSION['nombreBd']."</h2>";
                            ?>
                        </div>
                        <div class="botones">
                            <form action="menu.php" method="post">
                                <button type="submit" name="change">Cambiar Contraseña</button>
                            </form>
                            <?php
                            if(isset($_POST['change'])){
                                header("location:recovery.php");
                            }
                            ?>
                        </div>
                    </div>
               
            </div>        
        </div>
    </body>
</html>