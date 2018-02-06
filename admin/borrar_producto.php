<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passing info with POST and HTML FORMS using a single file.</title>
    <link rel="stylesheet" type="text/css" href="/Sivianes_Tejero_Trabajo_php/css.css">
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
    //  $connection->set_charset("uft8");

      //TESTING IF THE CONNECTION WAS RIGHT
      if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $connection->connect_error);
          exit();
      }
      ?>

      <?php
      //  printf("<p>The select query returned %d rows.</p>", $result->num_rows);

      $query="delete from productos where cod_producto='".$_GET["cod_producto"]."'";
      echo $query;
      var_dump($_GET['cod_producto']);

      if ($result = $connection->query($query)) {
        echo "Producto borrado";
        header("Location: administrar_productos.php");
      } else {
        echo "error";
        echo $connection->error;
      }
?>

  </body>
  </html>
