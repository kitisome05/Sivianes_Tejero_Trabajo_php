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
<?php if (!isset($_POST["nombre"])) : ?>

  <form method="post">
    <fieldset>
      <legend>Información del nuevo producto</legend>
      <span>Nombre:</span><input type="text" name="nombre" required><br>
      <span>Tipo:</span><select name="tipo">
        <option value="remolques">Remolques</option>
        <option value="ordeñadoras">Ordeñadoras</option>
        <option value="mezclador">Mezclador</option>
      </select><br>
      <span>Descripción:</span><input type="text" name="descripcion" required><br>
      <span>Precio:</span><input type="text" name="precio_unidad" required><br>
      <span>Cod_proveedor:</span><select name="cod_proveedor"><option value="1">1</option></select>
      <p><input type="submit" value="Insertar"></p>
    </fieldset>
  </form>

<?php else: ?>

  <?php
  $connection = new mysqli("localhost", "root", "Admin2015", "agromoise",3316);
  $connection->set_charset("uft8");

  //TESTING IF THE CONNECTION WAS RIGHT
  if ($connection->connect_errno) {
      printf("Connection failed: %s\n", $connection->connect_error);
      exit();
  }

  $nombre = $_POST["nombre"];
  $tipo = $_POST["tipo"];
  $descripcion = $_POST["descripcion"];
  $precio_unidad = $_POST["precio_unidad"];
  $cod_proveedor = $_POST["cod_proveedor"];

  $query = "INSERT INTO productos (nombre,tipo,descripcion,precio_unidad,cod_proveedor)
  VALUES ('$nombre','$tipo','$descripcion','$precio_unidad','$cod_proveedor')";

  echo $query;

  if ($connection->query($query)) {

    echo "Producto insertado";

    $query = "SELECT * FROM productos";

    if ($result = $connection->query($query)) {
      echo "<table>";

      //FETCHING OBJECTS FROM THE RESULT SET
      //THE LOOP CONTINUES WHILE WE HAVE ANY OBJECT (Query Row) LEFT
      while($obj = $result->fetch_object()) {
          //PRINTING EACH ROW
          echo "<tr>";
            echo "<td>".$obj->nombre."</td>";
            echo "<td>".$obj->tipo."</td>";
            echo "<td>".$obj->descripcion."</td>";
            echo "<td>".$obj->precio_unidad."</td>";
            echo "<td>".$obj->cod_proveedor."</td>";
          echo "</tr>";
      }
      echo "</table>";
    }

  } else {
    echo "ERROR AL INSERTAR COCHE";
  }
  ?>

  <?php endif ?>
  </body>
  </html>
