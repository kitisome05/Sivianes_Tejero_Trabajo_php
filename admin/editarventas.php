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
    <?php
      if (empty($_GET)) {
        echo "No se han recibido datos del producto";
        exit();
      }
    ?>
    <?php
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
        <a href="admin/logout.php" id="boton"><button type="button">Cerrar session</button></a>
    <?php } ?>

    <?php if (!isset($_POST["codigo"])) : ?>
      <?php

        //CREATING THE CONNECTION
        $connection = new mysqli("localhost", "root", "Admin2015", "agromoise",3316);
        $connection->set_charset("uft8");

        //TESTING IF THE CONNECTION WAS RIGHT
        if ($connection->connect_errno) {
            printf("Connection failed: %s\n", $connection->connect_error);
            exit();
        }

        $query="SELECT * from ventas where cod_ventas='".$_GET["cod_ventas"]."'";
        echo "$query";

        if ($result = $connection->query($query))  {

          $obj = $result->fetch_object();

          if ($result->num_rows==0) {
            echo "NO EXISTE ESA VENTA";
            exit();
          }

          $codigo = $obj->cod_ventas;
          $cod_cliente = $obj->cod_cliente;
          $fecha = $obj->fecha;
          $valor_total = $obj->valor_total;
        } else {
          echo "No se han recuperado los datos de la venta";
          exit();
        }
        ?>

        <form method="post">
          <fieldset>
            <legend>Información de la venta</legend>
            <span>Cod_Cliente:</span><input value='<?php echo $cod_cliente;?>' type="text" name="cod_cliente" required><br>
            <span>Fecha:</span><input value='<?php echo $fecha; ?>'type="date" name="fecha" required><br>
            <span>Precio_Unidad:</span><input type="text" name="valor_total" value='<?php echo $valor_total; ?>'><br>
            <input type="hidden" name="codigo" value='<?php echo $codigo;?>'>
            <p><input type="submit" value="Actualizar"></p>
          </fieldset>
        </form>

      <?php else: ?>

        <?php

        $codigo = $_POST["codigo"];
        $cod_cliente = $_POST["cod_cliente"];
        $fecha = $_POST["fecha"];
        $valor_total = $_POST["valor_total"];
        $connection = new mysqli("localhost", "root", "Admin2015", "agromoise",3316);
        $connection->set_charset("uft8");

        if ($connection->connect_errno) {
            printf("Connection failed: %s\n", $connection->connect_error);
            exit();
        }
        $query="update ventas set cod_cliente='$cod_cliente',fecha='$fecha',
        valor_total='$valor_total'
        WHERE cod_ventas='$codigo'";

if ($result = $connection->query($query)) {
  echo "Datos actualizados";
  header("Location: administrar_ventas.php");
} else {
  echo "Error al actualizar los datos";
}
?>

<?php endif ?>
</body>
</html>
