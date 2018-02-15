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
    <link rel="stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-4.0.0-dist/js/bootstrap.min.js">
    <script src="jquery-3.2.1.min.js"></script>
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
          $connection->set_charset("utf8");
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
  if (isset($_SESSION['roll'])) {
    ?>
    <a href="principal.php" id="boton">Inicio</a>
    <a href="admin/logout.php" id="boton">Cerrar sesion</a>
    <span id="quantity">0</span><a href="carrito.php">Comprar</a>
<?php
} elseif (!isset($_SESSION['usuario'])) {
?>
    <a href="principal.php" id="boton">Inicio</a>
    <a href="iniciosesion.php" id="boton">Iniciar Session</a>
    <a href="Registro.php" id="boton">Registrarse</a>
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
          echo "</tr>";
          echo "<tr>";
            echo "<td>".$obj->precio_unidad."</td>";
            echo "<a class='addtocart' href='add_to_cart.php?cod_producto=".$obj->cod_producto."' id='boton'>Añadir al carro</a>";
          echo "</tr>";
        //  echo "<a href='add_to_cart.php?cod_producto=".$obj->cod_producto."' id='boton'><button type='button'>Añadir al carro</button></a>";
        }
?>
        <?php
        $result->close();
        unset($obj);
        unset($connection);
      }
       ?>
    </table>
    <script>
            $(function() {
               $("#quantity").text(0);
               $(".addtocart").click(function(event) {
                // alert("HOLA");
                 event.preventDefault();
                 $.ajax({
                   url: $(this).attr("href"),
                 }).done(function(data) {
                  // alert(data);
                    if (data=="OK") {
                      $("#quantity").text(parseInt($("#quantity").text())+1);
                    } else {
                      alert("Something went wrong!!!"+data);
                    }

                 });
               });
            });
    </script>

  </body>
  </html>
