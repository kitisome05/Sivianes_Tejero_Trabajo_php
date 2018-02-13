<?php
  session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passing info with POST and HTML FORMS using a single file.</title>
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
<?php if (!isset($_POST["nombre"])) : ?>

  <form method="post">
    <fieldset>
      <legend>Información del nuevo producto</legend>
      <span>Nombre:</span><input type="text" name="nombre" required><br>
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

  $query = "INSERT INTO proveedores (nombre)
  VALUES ('$nombre')";
  header("Location: administrar_proveedores.php");
  echo $query;

  if ($connection->query($query)) {

    echo "Proveedor insertado";

    $query = "SELECT * FROM proveedores";

    if ($result = $connection->query($query)) {
      echo "<table>";

      //FETCHING OBJECTS FROM THE RESULT SET
      //THE LOOP CONTINUES WHILE WE HAVE ANY OBJECT (Query Row) LEFT
      while($obj = $result->fetch_object()) {
          //PRINTING EACH ROW
          echo "<tr>";
            echo "<td>".$obj->nombre."</td>";
          echo "</tr>";
      }
      echo "</table>";
    }

  } else {
    echo "ERROR AL INSERTAR PROVEEDOR";
  }
  ?>

  <?php endif ?>
  </body>
  </html>
