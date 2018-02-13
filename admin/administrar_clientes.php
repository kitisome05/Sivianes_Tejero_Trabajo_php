<?php
  session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passing info with POST and HTML FORMS using a single file.</title>
    <link rel="stylesheet" type="text/css" href="/Sivianes_Tejero_Trabajo_php/css.css">
    <link rel="stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-4.0.0-dist/js/bootstrap.min.js">
    <style>
      span {
        width: 100px;
        display: inline-block;
      }
    </style>
  </head>
  <body>
        <?php

          //CREATING THE CONNECTION
          $connection = new mysqli("localhost", "root", "Admin2015", "agromoise",3316);
          $connection->set_charset("uft8");

          //TESTING IF THE CONNECTION WAS RIGHT
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
              <a href="/Sivianes_Tejero_Trabajo_php/principal.php" id="boton"><button type="button">Inicio</button></a>
              <a href='añadir_cliente.php'><button type="button">Añadir nuevo cliente</button></a>
              <a href="admin/logout.php" id="boton"><button type="button">Cerrar session</button></a>
          <?php } ?>

          <?php
          $query="SELECT * from clientes";

          if ($result = $connection->query($query))  {
          //  printf("<p>The select query returned %d rows.</p>", $result->num_rows);
?>
<table style="border:1px solid black">
<thead>
  <tr><h2>Administración de CLientes</h2></tr>
  <tr>
    <th>Nombre</th>
    <th>Apellidos</th>
    <th>Telefono</th>
    <th>Dirección</th>
    <th>Usuario</th>
    <th>Contraseña</th>
    <th>Acción</th>
</thead>
<?php
while($obj = $result->fetch_object()) {
    //PRINTING EACH ROW
    echo "<tr>";
      echo "<td>".$obj->nombre."</td>";
      echo "<td>".$obj->apellidos."</td>";
      echo "<td>".$obj->telefono."</td>";
      echo "<td>".$obj->direccion."</td>";
      echo "<td>".$obj->usuario."</td>";
      echo "<td>".$obj->contrasena."</td>";
      echo
          "<td>";
              echo "  <a href='editarclientes.php?cod_cliente=".$obj->cod_cliente."'>
              <img src='/Sivianes_Tejero_Trabajo_php/imagenes/iconos/2.png' id='icono'></a>";
              echo "<a href='borrar_cliente.php?cod_cliente=".$obj->cod_cliente."'><img src='/Sivianes_Tejero_Trabajo_php/imagenes/iconos/3.png' id='icono'></a>";

      echo  "</td>";
    echo "</tr>";
}
$result->close();
unset($obj);
unset($connection);
}
?>

  </body>
  </html>