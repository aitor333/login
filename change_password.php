<?php
session_start();
require_once 'header.php';
require_once 'metodos.php';
?>
<html>
    <head>
        <title>Restablecer Contraseña</title>
    </head>
    <body>
        <form action="change_password.php" method="post" class="d-flex flex-column justify-content-center align-items-center p-2">
            <div class="col-7 mb-3 gy-5">
                <div class="row ms-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" aria-describedby="passwordHelpBlock">
                    <div id="passwordHelpBlock" class="form-text">
                        Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                    </div>
                    <button type="submit" class="btn btn-primary" name="recovery" id="recovery">Recuperar Contraseña</button>
                </div> 
                
            </div>
          
        
        </form>
        <?php
         // Verificar que la contraseña no esté vacía y tenga al menos 8 caracteres.
         if (empty($_POST['password']) || strlen($_POST['password']) < 8) {
          echo "La password debe de tener al menos 8 caracteres";
         }else{
           if(isset($_POST['recovery'])){
              $state = updatePassword($_POST['password']);
              
              if($state){
                header("location:login.php");
              }else{
                echo "Fallo al actualizar la contraseña";
              }
                  
            }
          }
                ?>
        

               
    </body>
</html>