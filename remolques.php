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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
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
<a href="principal.php">
  <img src="imagenes/logo_actualizado.jpg">
</a>
<?php

  $v1=0;
  if (isset($_SESSION["roll"])) {
    $v1 = $_SESSION["roll"];
    echo ($v1);
  }
  if (isset($_SESSION['roll'])) {
    ?>
    <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">Agromoise</a>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="principal.php">Inicio<span class="sr-only">(current)</span></a>
          </li>
        </div>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <?php
          $v1=0;
          if (isset($_SESSION["roll"])) {
          $v1 = $_SESSION["roll"]; ?>

                  <a class="nav-link" href="carrito.php"><img src="imagenes/iconos/carrito.jpg" id='icono'><span class="sr-only">(current)</span></a>


                  <?php echo ("<b>User:</b> $v1"); }?>


                  <a class="nav-link" href="admin/logout.php">Cerrar Session<span class="sr-only">(current)</span></a>

        </ul>
      </div>
    </nav>

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
            echo "<td><a class='addtocart' href='add_to_cart.php?cod_producto=".$obj->cod_producto."' id='boton'>Añadir al carro</a></td>";
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
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

  </body>
  </html>
