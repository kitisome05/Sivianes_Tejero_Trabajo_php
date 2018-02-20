<?php
  session_start();
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passing info with POST and HTML FORMS using a single file.</title>
    <link rel="stylesheet" type="text/css" href="css.css">
    <link rel="stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-4.0.0-dist/js/bootstrap.min.js">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <style>
      span {
        width: 200px;
        display: inline-block;
      }
    </style>
  </head>
  <body class="container">
    <?php
        if (isset($_POST["usuario"])) {

          $connection = new mysqli("localhost", "root", "Admin2015", "agromoise", 3316);

          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }
    }
    ?>
    <div>
      <div>
        <a href="principal.php"><img src="imagenes/logo_actualizado.jpg" id="logo-tamaño"></a>
      </div>
    <?php if (!isset($_POST["usuario"])) : ?>
      <div>
          <form method="post">
            <fieldset>
              <legend>Inisiar sesion</legend>
              <span>Nombre de usuario:</span><input type="text" name="usuario" required><br>
              <span>Contraseña:</span><input type="password" name="contrasena" required><br>
              <p><input type="submit" value="Enviar"></p>
            </fieldset>
          </form>
      </div>
    </div>
    <?php else: ?>

      <?php
      // Session
      $consulta="select * from clientes where
      usuario='".$_POST["usuario"]."' and contrasena=md5('".$_POST["contrasena"]."');";

      // Comprobando la conexion
       if ($result = $connection->query($consulta)) {
         //Si es invalido
         if ($result->num_rows===0) {
                echo "LOGIN INVALIDO";
                session_destroy();
                header("Location: principal.php");
              } else {
                $_SESSION["usuario"]=$_POST["usuario"];
                $obj =$result->fetch_object();

                if ($obj->roll=="admin"){
                  $_SESSION["roll"] = "admin";
                  $_SESSION["codigo"] = $obj->cod_cliente;
                } else {
                  $_SESSION["roll"] = "usuario";
                  $_SESSION["codigo"] = $obj->cod_cliente;
                }
               header("Location: principal.php");
      }
      } else {
      echo "Wrong Query";
      }
      ?>
    <?php endif ?>
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

</body>
  </html>
