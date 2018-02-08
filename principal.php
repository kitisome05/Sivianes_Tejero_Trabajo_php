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
    <link rel="stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-4.0.0-dist/js/bootstrap.min.js">
  <style>
      span {
        width: 200px;
        display: inline-block;
      }
    </style>
  </head>
  <body class="container">
    <?php //Conexion
      //  if (isset($_POST["usuario"])) {

          $connection = new mysqli("localhost", "root", "Admin2015", "agromoise", 3316);
          $connection->set_charset("utf8");
          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }
?>

<div name="logo">
    <a href="principal.php"> <img src="imagenes/logo_actualizado.jpg"></a>
</div>
<?php
  // if($_SESSION['roll']=='admin') {

   //}
   if (!isset($_SESSION['usuario'])) {
   }
   //Usuario iniciado como Admin/Usuario
  if (isset($_SESSION['roll']) && $_SESSION['roll']=='admin') {
    ?>
    <?php// Menu de Administrador ?>
<div class="row">
      <div class="col-md-9">
            <a href="principal.php"><button type="button">Inicio</button></a>
            <a href="admin/administrar_productos.php"><button type="button">Administrar Productos</button></a>
      </div>
      <div class="col-md-3">
            <?php
            $v1=0;
            if (isset($_SESSION["roll"])) {
            $v1 = $_SESSION["roll"];
            echo ("<b>User:</b> $v1");
            }
            ?>
              <a href="admin/logout.php"><button type="button">Cerrar session</button></a>
      </div>
</div>
      <?php
      }elseif (isset($_SESSION['roll']) && $_SESSION['roll']=='usuario') {
      ?>
<div class="row">
      <div class="col-md-9">
          <a href="principal.php"><button type="button">Inicio</button></a>
      </div>
      <div class="col-md-3">
            <?php
            $v1=0;
            if (isset($_SESSION["roll"])) {
            $v1 = $_SESSION["roll"];
            echo ("<b>User:</b> $v1");
            }
            ?>
          <a href="admin/logout.php"><button type="button">Cerrar session</button></a>
    </div>
</div>
      <?php
      } elseif (!isset($_SESSION['usuario'])) {
            ?>
<div class="row">
    <div class="col-md-8">
          <a href="principal.php"><button type="button">Inicio</button></a>
    </div>
    <div class="col-md-4">
          <?php
          $v1=0;
          if (empty($_SESSION["roll"])) {
          echo ("<b>User:</b> No logged");
          }
          ?>
          <a href="iniciosesion.php"><button type="button">Iniciar sesion</button></a>
          <a href="Registro.php"><button type="button">Registrarse</button></a>
    </div>
</div>
      <?php
        }
      ?>
    <div class="row" id="productos">
        <div class="col-md-4">
          <a href='remolques.php?tipo=remolques'><img src="imagenes/remolques/1.jpg" id="imagen-tamaño"></a>
          <p><a href='remolques.php?tipo="remolques"'<p id="imagen-position">Remolques</p></a></p>
        </div>
        <div class="col-md-4">
          <a href='ordeñadoras.php?tipo=ordeñadoras'><img src="imagenes/ordeñadoras/1.jpg" id="imagen-tamaño"></a>
          <p><a href='ordeñadoras.php?tipo="ordeñadoras"'<p id="imagen-position">Ordeñadoras</p></a></p>
        </div>
        <div class="col-md-4">
          <a href='mezclador.php?tipo=mezclador'><img src="imagenes/mezclador/1.PNG" id="imagen-tamaño"></a>
          <p><a href='mezclador.php?tipo="mezclador"'<p id="imagen-position">Mezclador</p></a></p>
        </div>
      </div>
  </body>
</html>
