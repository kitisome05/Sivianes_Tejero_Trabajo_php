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
  <style>
      span {
        width: 200px;
        display: inline-block;
      }
    </style>
  </head>
  <body>
    <?php
        if (isset($_POST["usuario"])) {

          $connection = new mysqli("localhost", "root", "Admin2015", "agromoise", 3316);

          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }
    }
    ?>


    <a href="principal.php"><img src="imagenes/logo_actualizado.jpg" id="logo-tamaño"></a>
    <?php if (!isset($_POST["usuario"])) : ?>
      <form method="post">
        <fieldset>
          <legend>Inisiar sesion</legend>
          <span>Nombre de usuario:</span><input type="text" name="usuario" required><br>
          <span>Contraseña:</span><input type="password" name="contrasena" required><br>
          <p><input type="submit" value="Enviar"></p>
        </fieldset>
      </form>
    <?php else: ?>

      <?php
          echo "<h3>Showing data coming from the form</h3>";
          var_dump($_POST);
      ?>
      <?php
      // Session
      $consulta="select * from clientes where
      usuario='".$_POST["usuario"]."' and contrasena=md5('".$_POST["contrasena"]."');";

      var_dump($consulta);
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
                } else {
                  $_SESSION["roll"] = "usuario";
                }
               header("Location: principal.php");
      }
      } else {
      echo "Wrong Query";
      }
      ?>
    <?php endif ?>

</body>
  </html>
