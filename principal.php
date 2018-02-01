<?php
  session_start();
  //var_dump($_SESSION);
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passing info with POST and HTML FORMS using a single file.</title>
    <link rel="stylesheet" type="text/css" href="css.css">
  <style>
      span {
        width: 200px;
        display: inline-block;
      }
    </style>
  </head>
  <body>
    <?php //Conexion
      //  if (isset($_POST["usuario"])) {

          $connection = new mysqli("localhost", "root", "Admin2015", "agromoise", 3316);

          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }
?>
<?php


  // if($_SESSION['roll']=='admin') {

   //}

   if (!isset($_SESSION['usuario'])) {

   }

  $v1=0;
  if (isset($_SESSION["roll"])) {
    $v1 = $_SESSION["roll"];
    echo ($v1);
  }
  if (isset($_SESSION['roll']) && $_SESSION['roll']=='admin') {
    ?>
    <a href="/admin/añadir.php" id="boton"><button type="button">Añadir Producto</button></a>
    <a href="/admin/borrar.php" id="boton"><button type="button">Borrar Producto</button></a>
    <a href="admin/logout.php" id="boton"><button type="button">Cerrar session</button></a>
<?php
}elseif (isset($_SESSION['roll']) && $_SESSION['roll']=='usuario') {
?>
<a href="admin/logout.php" id="boton"><button type="button">Cerrar session</button></a>
<?php
} elseif (!isset($_SESSION['usuario'])) {
      ?>
    <a href="iniciosesion.php" id="boton"><button type="button">Iniciar sesion</button></a>
    <a href="Registro.php" id="boton"><button type="button">Registrarse</button></a>
<?php
  }
?>
    <a href="principal.php"> <img src="imagenes/logo_actualizado.jpg"></a>

      <div>
        <a href='remolques.php?tipo=remolques'><img src="imagenes/remolques/1.jpg" id="imagen-tamaño"></a>
        <p><a href='remolques.php?tipo="remolques"'<p id="imagen-position">Remolques</p></a></p>
      </div>
      <div>
        <a href='ordeñadoras.php?tipo=ordeñadoras'><img src="imagenes/ordeñadoras/1.jpg" id="imagen-tamaño"></a>
        <p><a href='ordeñadoras.php?tipo="ordeñadoras"'<p id="imagen-position">Ordeñadoras</p></a></p>
      </div>
      <div>
        <a href='mezclador.php?tipo=mezclador'><img src="imagenes/mezclador/1.PNG" id="imagen-tamaño"></a>
        <p><a href='mezclador.php?tipo="mezclador"'<p id="imagen-position">Mezclador</p></a></p>
      </div>
  </body>
</html>
