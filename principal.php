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
  <body>
    <?php
        if (isset($_POST["usuario"])) {

          $connection = new mysqli("192.168.1.145", "root", "Admin2015", "agromoise", 3316);

          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }
}
?>
<?php


   if($_SESSION['roll']=='admin') {

   }

   if (!isset($_SESSION['usuario'])) {

   }

  $v1=0;
  if (isset($_SESSION["roll"])) {
    $v1 = $_SESSION["roll"];
    echo ($v1);
  }
  if ($_SESSION['roll']=='admin') {
    ?>
    <a href="/admin/modificar.php" style="padding-right: 2cm;"><button type="button">Modificar Productos</button></a>
    <a href="admin/logout.php" style="padding-right: 2cm;"><button type="button">Cerrar session</button></a>
<?php
}elseif ($_SESSION['roll']=='usuario') {
?>
<a href="admin/logout.php" style="padding-right: 2cm;"><button type="button">Cerrar session</button></a>
<?php
} elseif (!isset($_SESSION['usuario'])) {
      ?>
    <a href="iniciosesion.php" style="padding-right: 2cm;"><button type="button">Iniciar sesion</button></a>
    <a href="Registro.php" style="padding-right: 2cm;"><button type="button">Registrarse</button></a>
<?php
  }
?>
    <a href="principal.php"> <img src="imagenes/logo_actualizado.jpg"></a>

      <div>
        <a href="remolques.php"><img src="imagenes/remolques/1.jpg" style="width:200px;height:80px"></a>
        <p><a href="remolques.php"<p style="margin-left:50px">Remolques</p></a></p>
      </div>
      <div>
        <a href="ordeñadoras.php"><img src="imagenes/ordeñadoras/1.jpg" style="width:200px;height:80px"></a>
        <p><a href="ordeñadoras.php"<p style="margin-left:50px">Ordeñadoras</p></a></p>
      </div>
      <div>
        <a href="mezclador.php"><img src="imagenes/mezclador/1.PNG" style="width:200px;height:80px"></a>
        <p><a href="mezclador.php"<p style="margin-left:50px">Mezclador</p></a></p>
      </div>
  </body>
</html>
