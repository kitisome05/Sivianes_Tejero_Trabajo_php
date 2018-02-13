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
      // if($_SESSION['roll']=='admin') {
       //}

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
$query="SELECT * from clientes where cod_cliente='".$_GET["cod_cliente"]."'";
echo "$query";

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
  </body>
  </html>
