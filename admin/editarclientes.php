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
      if (empty($_GET)) {
        echo "No se han recibido datos del producto";
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
$query="SELECT * from clientes where cod_cliente='".$_GET["cod_cliente"]."'";

if ($result = $connection->query($query))  {

  $obj = $result->fetch_object();

  if ($result->num_rows==0) {
    echo "NO EXISTE ESE CLIENTE";
    exit();
  }

  $codigo = $obj->cod_cliente;
  $apellidos = $obj->apellidos;
  $nombre = $obj->nombre;
  $telefono = $obj->telefono;
  $direccion = $obj->direccion;
  $usuario = $obj->usuario;
  $contrasena = $obj->contrasena;

} else {
  echo "No se han recuperado los datos del cliente";
  exit();
}
?>

<form method="post">
  <fieldset>
    <legend>Información del cliente</legend>
    <span>Usuario:</span><input value='<?php echo $usuario; ?>' type="text" name="usuario" required><br>
    <span>Contraseña:</span><input value='<?php echo $contrasena; ?>'type="password" name="contraseña" required><br>
    <span>Nombre:</span><input type="text" name="nombre" value='<?php echo $nombre; ?>'><br>
    <span>Apellidos:</span><input type="text" name="apellidos" value='<?php echo $apellidos; ?>'><br>
    <span>Teléfono: </span><input type="text" name="telefono" value='<?php echo $telefono; ?>'><br>
    <span>Dirección: </span><input type="text" name="direccion" value='<?php echo $direccion; ?>'><br>
    <input type="hidden" name="codigo" value='<?php echo $codigo; ?>'>
    <p><input type="submit" value="Actualizar"></p>
  </fieldset>
</form>

<!-- DATA IN $_POST['dni']. Coming from a form submit -->
<?php else: ?>
  <?php

  $codigo = $_POST["codigo"];
  $nombre = $_POST["nombre"];
  $apellidos = $_POST["apellidos"];
  $usuario = $_POST["usuario"];
  $contrasena = $_POST["contrasena"];
  $telefono = $_POST["telefono"];
  $direccion = $_POST["direccion"];

  //CREATING THE CONNECTION
  $connection = new mysqli("localhost", "root", "Admin2015", "agromoise",3316);
  $connection->set_charset("uft8");

  if ($connection->connect_errno) {
      printf("Connection failed: %s\n", $connection->connect_error);
      exit();
  }

  $query="update clientes set usuario='$usuario',contrasena=md5('".$contrasena."'),
  nombre='$nombre',apellidos='$apellidos',telefono='$telefono',direccion='$direccion'
  WHERE cod_cliente='$codigo'";

  header("Location: administrar_clientes.php");

  echo $query;
  if ($result = $connection->query($query)) {
    echo "Datos actualizados";
  } else {
    echo "Error al actualizar los datos";
  }

  ?>

  <?php endif ?>
  <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

  </body>
  </html>
