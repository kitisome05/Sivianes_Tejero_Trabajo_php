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

          $connection = new mysqli("192.168.1.145", "root", "Admin2015", "tf", 3316);

          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }

          $consulta="select * from clientes where
    username='".$_POST["usuario"]."' and password=md5('".$_POST["contraseña"]."');";

    if ($result = $connection->query($consulta)) {
    //No rows returned
    if ($result->num_rows===0) {
      echo "LOGIN INVALIDO";
    } else {
      //VALID LOGIN. SETTING SESSION VARS
      $_SESSION["usuario"]=$_POST["usuario"];
      $_SESSION["language"]="es";
      header("Location: principal.php");
    }
    } else {
    echo "Wrong Query";
    }
    }
    ?>


    <a href="principal.php"><img src="imagenes/logo_actualizado.jpg" style="width:250px;height:80px;margin-left:100px;"></a>
    <?php if (!isset($_POST["usuario"])) : ?>
      <form method="post">
        <fieldset>
          <legend style="margin-left:170px">Inisiar sesion</legend>
          <span>Nombre de usuario:</span><input type="text" name="usuario" required><br>
          <span>Contraseña:</span><input type="text" name="contraseña" required><br>
          <p style="margin-left:170px"><input type="submit" value="Enviar"></p>
        </fieldset>
      </form>
    <?php else: ?>

      <?php
          echo "<h3>Showing data coming from the form</h3>";
          var_dump($_POST);
      ?>

    <?php endif ?>

</body>
  </html>
