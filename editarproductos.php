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
      <?php if (!isset($_POST["cod_producto"])) : ?>
        <?php

          //CREATING THE CONNECTION
          $connection = new mysqli("localhost", "root", "Admin2015", "tf",3316);
          $connection->set_charset("uft8");

          //TESTING IF THE CONNECTION WAS RIGHT
          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }
          $query="SELECT * from productos where cod_producto='".$_GET["cod_producto"]."'";

          if ($result = $connection->query($query))  {

            $obj = $result->fetch_object();

            if ($result->num_rows==0) {
              echo "NO EXISTE ESE producto";
              exit();
            }

            $codigo = $obj->cod_producto;
            $nombre = $obj->nombre;
            $descripcion = $obj->descripcion;
            $precio = $obj->precio_unidad;
            $imagen = $obj->imagen;

          } else {
            echo "No se han recuperar los datos cliente";
            exit();
          }
?>

<form method="post">
  <fieldset>
    <legend>Información del Producto</legend>
    <span>Nombre:</span><input value='<?php echo $nombre; ?>' type="text" name="nombre" required><br>
    <span>Descripción:</span><input value='<?php echo $descripcion; ?>'type="text" name="descripcion" required><br>
    <span>Precio:</span><input type="text" value='<?php echo $precio_unidad; ?>'name="precio_unidad" required><br>
    <span>Imagen:</span><input type="text" name="imagen" value='<?php echo $imagen; ?>'><br>
    <input type="hidden" name="codigo" value='<?php echo $codigo; ?>'>
    <p><input type="submit" value="Actualizar"></p>
  </fieldset>
</form>

<?php else: ?>

  <?php
  $codigo = $_POST["codigo"];
  $nombre = $_POST["nombre"];
  $descripcion = $_POST["descripcion"];
  $imagen = $_POST["imagen"];

  $connection = new mysqli("localhost", "root", "Admin2015", "agromoise",3316);
  $connection->set_charset("uft8");

  //TESTING IF THE CONNECTION WAS RIGHT
  if ($connection->connect_errno) {
      printf("Connection failed: %s\n", $connection->connect_error);
      exit();
  }

  /MAKING A SELECT QUERY
  /* Consultas de selección que devuelven un conjunto de resultados */
  $query="update productos set imagen='$imagen',nombre='$nombre',
  descripcion='$descripcion' WHERE cod_producto='$codigo'";

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
