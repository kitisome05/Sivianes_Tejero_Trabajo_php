<?php
  session_start();
  if ($_SESSION['roll']=='admin') {

  }else {
    session_destroy();
    header("Location: /Sivianes_Tejero_Trabajo_php/principal.php");
  }
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passing info with POST and HTML FORMS using a single file.</title>
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
       if (!isset($_SESSION['usuario'])) {

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
    <h2>Producto Nuevo</h2>
<?php if (!isset($_POST["nombre"])) : ?>

  <div class="container">
    <form method="post">
      <div class="form-group row">
        <label for="inlineFormInput" class="col-sm-2 col-form-label">Nombre</label>
        <div class="col-sm-10">
          <input type="text" name="nombre" class="form-control" id="inlineFormInput" placeholder="Nombre">
        </div>
      </div>
      <div class="row">
      <div class="col-2">
        <label class="mr-sm-2" for="inlineFormCustomSelect">Tipo</label>
      </div>
      <div class="col-10">
        <select class="form-control" name="tipo">
          <option selected>Elige un tipo de producto</option>
          <option value="remolques">Remolques</option>
          <option value="ordeñadoras">Ordeñadoras</option>
          <option value="mezclador">Mezclador</option>
        </select>
      </div>
      </div>
      <div class="form-group row">
        <label for="inlineFormInput" class="col-sm-2 col-form-label">Descripción</label>
        <div class="col-sm-10">
          <input type="text" name="descripcion" class="form-control" id="inlineFormInput" placeholder="Descripción">
        </div>
      </div>
      <div class="form-group row">
        <label for="inlineFormInput" class="col-sm-2 col-form-label">Precio</label>
        <div class="col-sm-10">
          <input type="text" name="precio_unidad" class="form-control" id="inlineFormInput" placeholder="Precio">
        </div>
      </div>
      <div class="row">
      <div class="col-2">
        <label class="mr-sm-2" for="inlineFormCustomSelect">Proveedor</label>
      </div>
      <div class="col-10">
        <select class="form-control" name="cod_proveedor">
          <option selected>Elige un proveedor</option>
          <option value="1">1</option>
        </select>
      </div>
      </div>
      <br>
      <div class="form-group row">
        <div class="offset-sm-2 col-sm-10">
          <button type="submit" class="btn btn-primary">Añadir</button>
        </div>
      </div>
    </form>
  </div>

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
  $imagen = $_POST["imagen"];

  $query = "INSERT INTO productos (nombre,tipo,descripcion,precio_unidad,cod_proveedor,imagen)
  VALUES ('$nombre','$tipo','$descripcion','$precio_unidad','$cod_proveedor','$imagen')";
  header("Location: administrar_productos.php");
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
    echo "ERROR AL INSERTAR PRODUCTO";
  }
  ?>

  <?php endif ?>
  <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

  </body>
  </html>
