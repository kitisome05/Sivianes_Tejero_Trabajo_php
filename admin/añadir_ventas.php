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
<?php if (!isset($_POST["cod-cliente"])) : ?>

  <form method="post">
    <fieldset>
      <legend>Información de la nueva venta</legend>
      <span>Cod-cliente:</span><input type="text" name="cod-cliente" required><br>
      <span>Fecha:</span><input type="date" name="fecha" required><br>
      <span>Precio-total:</span><input type="text" name="precio_total" required><br>
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
  $cod_cliente = $_POST["cod-cliente"];
  $fecha = $_POST["fecha"];
  $precio_total = $_POST["precio_total"];

$query = "INSERT INTO ventas (cod_cliente,fecha,precio_total)
VALUES ('$cod_cliente','$fecha','$precio_total')";
// header("Location: administrar_ventas.php");

if ($connection->query($query)) {

  echo "Venta insertada";

  $query = "SELECT * FROM ventas";

  if ($result = $connection->query($query)) {
    echo "<table>";

    while($obj = $result->fetch_object()) {
        //PRINTING EACH ROW
        echo "<tr>";
          echo "<td>".$obj->cod_cliente."</td>";
          echo "<td>".$obj->fecha."</td>";
          echo "<td>".$obj->precio_total."</td>";
        echo "</tr>";
    }
    echo "</table>";
  }} else {
    echo "ERROR AL INSERTAR LA VENTA";
  }
?>

<?php endif ?>
</body>
</html>
