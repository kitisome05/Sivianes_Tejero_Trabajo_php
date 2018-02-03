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
        width: 100px;
        display: inline-block;
      }
    </style>
  </head>
  <body>
    <?php
      if (empty($_GET)) {
        echo "No se han recibido datos del producto";
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
        <a href="/admin/añadir.php" id="boton"><button type="button">Añadir Producto</button></a>
        <a href="/admin/borrar.php" id="boton"><button type="button">Borrar Producto</button></a>
        <a href="admin/logout.php" id="boton"><button type="button">Cerrar session</button></a>
    <?php } ?>

    <?php if (!isset($_POST["cod_producto"])) : ?>

      <?php

        //CREATING THE CONNECTION
        $connection = new mysqli("localhost", "root", "Admin2015", "agromoise",3316);
        $connection->set_charset("uft8");

        //TESTING IF THE CONNECTION WAS RIGHT
        if ($connection->connect_errno) {
            printf("Connection failed: %s\n", $connection->connect_error);
            exit();
        }

        $query="SELECT * from productos where cod_producto='".$_GET["cod_producto"]."'";
        echo "$query";

        if ($result = $connection->query($query))  {

          $obj = $result->fetch_object();

          if ($result->num_rows==0) {
            echo "NO EXISTE ESE PRODUCTO";
            exit();
          }

          $codigo = $obj->cod_producto;
          $tipo = $obj->tipo;
          $nombre = $obj->nombre;
          $descripcion = $obj->descripcion;
          $precio_unidad = $obj->precio_unidad;
          $cod_proveedor = $obj->cod_proveedor;
          $imagen = $obj->imagen;

        } else {
          echo "No se han recuperado los datos del producto";
          exit();
        }
        ?>

        <form method="post">
          <fieldset>
            <legend>Información del Producto</legend>
            <span>Nombre:</span><input value='<?php echo $nombre; ?>' type="text" name="nombre" required><br>
            <span>Tipo:</span><input value='<?php echo $tipo; ?>'type="text" name="tipo" required><br>
            <span>Descripción:</span><input type="text" value='<?php echo $descripcion; ?>'name="descripcion" required><br>
            <span>Precio_Unidad:</span><input type="text" name="precio_unidad" value='<?php echo $precio_unidad; ?>'><br>
            <span>Imagen: </span><input type="text" name="imagen" value='<?php echo $imagen; ?>'><br>
            <input type="hidden" name="codigo" value='<?php echo $codigo; ?>'>
            <p><input type="submit" value="Actualizar"></p>
          </fieldset>
        </form>

      <!-- DATA IN $_POST['dni']. Coming from a form submit -->
      <?php else: ?>

        <?php

        $codigo = $_POST["codigo"];
        $nombre = $_POST["nombre"];
        $tipo = $_POST["tipo"];
        $descripcion = $_POST["descripcion"];
        $precio_unidad = $_POST["precio_unidad"];
        $imagen = $_POST["imagen"];

        //CREATING THE CONNECTION
        $connection = new mysqli("localhost", "root", "Admin2015", "agromoise",3316);
        $connection->set_charset("uft8");

        if ($connection->connect_errno) {
            printf("Connection failed: %s\n", $connection->connect_error);
            exit();
        }

        $query="update productos set tipo='$tipo',nombre='$nombre',
        descripcion='$descripcion',precio_unidad='$precio_unidad',imagen='$imagen'
        WHERE cod_producto='$codigo'";

        echo $query;
        if ($result = $connection->query($query)) {
          echo "Datos actualizados";
        } else {
          echo "Error al actualizar los datos";
        }

        ?>

        <?php endif ?>
  </body>
  </html>
