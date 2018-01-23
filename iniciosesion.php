<?php
  session_start();
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passing info with POST and HTML FORMS using a single file.</title>
    <link rel="stylesheet" type="text/css" href=" ">
  <style>
      span {
        width: 200px;
        display: inline-block;
      }
    </style>
  </head>
  <body style="margin-left: 450px">
    <?php
        if (isset($_POST["usuario"])) {

          $connection = new mysqli("192.168.1.145", "root", "Admin2015", "agromoise", 3316);

          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }
    }
    ?>


    <a href="principal.php"><img src="imagenes/logo_actualizado.jpg" style="width:250px;height:80px;margin-left:100px;"></a>
    <?php if (!isset($_POST["usuario"])) : ?>
      <form method="post">
        <fieldset>
          <legend style="margin-left:170px">Inisiar sesion</legend>
          <span>Nombre de usuario:</span><input type="text" name="usuario" required><br>
          <span>Contraseña:</span><input type="password" name="contrasena" required><br>
          <p style="margin-left:170px"><input type="submit" value="Enviar"></p>
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
              } else {
                $_SESSION["usuario"]=$_POST["usuario"];
                $_SESSION["contrasena"]=$_POST["contrasena"];

                header("Location: principal.php");
      }
      } else {
      echo "Wrong Query";
      }
      ?>
    <?php endif ?>

</body>
  </html>
