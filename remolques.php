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
  <style>
      span {
        width: 200px;
        display: inline-block;
      }
    </style>
  </head>
  <body>
    <?php //Conexion
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
    <a href="principal.php" id="boton"><button type="button">Inicio</button></a>
    <a href="/admin/modificar.php" id="boton"><button type="button">Modificar Productos</button></a>
    <a href="admin/logout.php" id="boton"><button type="button">Cerrar session</button></a>
<?php
}elseif (isset($_SESSION['roll']) && $_SESSION['roll']=='usuario') {
?>
<a href="principal.php" id="boton"><button type="button">Inicio</button></a>
<a href="admin/logout.php" id="boton"><button type="button">Cerrar session</button></a>
<?php
} elseif (!isset($_SESSION['usuario'])) {
      ?>
    <a href="principal.php" id="boton"><button type="button">Inicio</button></a>
    <a href="iniciosesion.php" id="boton"><button type="button">Iniciar sesion</button></a>
    <a href="Registro.php" id="boton"><button type="button">Registrarse</button></a>
<?php
  }
?>
    <?php
    if (empty($_GET)) {
      echo "No tengo datos del cliente";
      exit();

    }
     ?>
     <?php
     $query="SELECT * from productos WHERE tipo='".$_GET["tipo"]."'";
    //  echo $query;
   if ($result = $connection->query($query)) {

      // printf("<p>The select query returned %d rows.</p>", $result->num_rows);

      ?>

    <a href="principal.php">
      <img src="imagenes/logo_actualizado.jpg">
    </a>

    <table>
      <?php
        while($obj = $result->fetch_object()) {
          echo "<tr>";
            echo "<td><img src=".$obj->imagen."></td>";
          echo "</tr>";
          echo "<tr>";
            echo "<td>".$obj->nombre."</td>";
          echo "</tr>";
          echo "<tr>";
            echo "<td>".$obj->descripcion."</td>";
            echo "<td>".$obj->precio_unidad."</td>";
          echo "</tr>";
        }
        $result->close();
        unset($obj);
        unset($connection);
      }
       ?>
    </table>

  </body>
  </html>
