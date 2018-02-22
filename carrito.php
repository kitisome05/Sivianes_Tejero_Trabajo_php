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
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
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

          }
          if (isset($_SESSION['roll']) && $_SESSION['roll']=='admin') {
            ?>
            <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
              <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
                <a class="navbar-brand" href="/Sivianes_Tejero_Trabajo_php/principal.php"><img src="/Sivianes_Tejero_Trabajo_php/imagenes/logo_actualizado.jpg" width="200" height="80"></a>
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                  <a class="nav-item nav-link active" href="/Sivianes_Tejero_Trabajo_php/principal.php">Inicio <span class="sr-only">(current)</span></a>
                </div>
              </div>
              <div class="collapse navbar-collapse ml-5 pl-5" id="navbarNavDropdown">
                  <?php
                  $v1=0;
                  if (isset($_SESSION["roll"])) {
                  $v1 = $_SESSION["roll"]; ?>

                  <?php echo ("<b>User:</b> $v1"); }?>

                <a class="nav-link" href="admin/logout.php">Cerrar Session<span class="sr-only">(current)</span></a>

              </ul>
            </div>
          </nav>
        <?php } ?>

        <?php



        //  printf("<p>The select query returned %d rows.</p>", $result->num_rows);
 ?>
 <table style="border:1px solid black">
 <thead>
   <tr><h2>Carrito</h2></tr>
   <tr>
     <th>Nombre</th>
     <th>Tipo</th>
     <th>Precio_unidad</th>
     <th>Cantidad</th>
     <th>Total Euros</th>
   </tr>
 </thead>
 <?php
 $user = $_SESSION["codigo"];

   ?>
   <?php
   if(isset($_POST['comprar'])) {
     $valor=0;

     foreach ($_SESSION['carrito'] as $key => $value) {
       $query="SELECT * from productos where cod_producto=$key";
       if ($result = $connection->query($query))  {
         $obj = $result->fetch_object();
         $valor+=$obj->precio_unidad*$value;
       }

      }

$query="insert into ventas (cod_cliente, fecha, valor_total) values ('$user', 'curdate()','$valor')";
if ($result = $connection->query($query))  {
  unset($_SESSION['carrito']);
  header("Location: /Sivianes_Tejero_Trabajo_php/principal.php");
}

   }

 foreach ($_SESSION['carrito'] as $key => $value) {
   # code...
  // echo "{$key} => {$value}";

 $query="SELECT * from productos where cod_producto=$key";
  if ($result = $connection->query($query))  {
    $obj = $result->fetch_object();
        echo "<tr>";
          echo "<td>".$obj->nombre."</td>";
          echo "<td>".$obj->tipo."</td>";
          echo "<td>".$obj->precio_unidad."</td>";
          echo "<td>".$value."</td>";
          echo "<td>".$obj->precio_unidad*$value."</td>";
        echo "</tr>";

    }
  }

?>
 <form method="post">
   <input type="submit" name="comprar" value="comprar">
</form>
<?php
      $result->close();
      unset($obj);
      unset($connection);
?>

</table>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>
</html>
