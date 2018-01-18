<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passing info with POST and HTML FORMS using a single file.</title>
    <link rel="stylesheet" type="text/css" href=" ">
  <style>
      span {
        width: 200px;
        display: inline-block;
      }
    </style>
  </head>
  <body style="margin-left: 450px">
    <a href="principal.php"><img src="imagenes/logo_actualizado.jpg" style="width:250px;height:80px;margin-left:100px;"></a>
    <?php if (!isset($_POST["usuario"])) : ?>
      <form method="post">
        <fieldset>
          <legend style="margin-left:170px">Registrate</legend>
          <span>Nombre:</span><input type="text" name="nombre" required><br>
          <span>Apellido:</span><input type="text" name="apellidos" required><br>
          <span>Telefono:</span><input type="number" name="telefono" required><br>
          <span>Dirección:</span><input type="text" name="direccion"><br>
          <span>Nombre de usuario:</span><input type="text" name="usuario" required><br>
          <span>Contraseña:</span><input type="password" name="contraseña" required><br>




          <p style="margin-left:170px"><input type="submit" value="Enviar"></p>
        </fieldset>
      </form>
    <?php else: ?>

      <?php
          echo "<h3>Showing data coming from the form</h3>";
          var_dump($_POST);

          //CREATING THE CONNECTION
          $connection = new mysqli("192.168.1.145", "root", "Admin2015", "tf", 3316);

         //TESTING IF THE CONNECTION WAS RIGHT
         if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $connection->connect_error);
        exit();
   }

   $codigo=$_POST['usuario'];
   $consulta= "INSERT INTO clientes VALUES('$codigo','".$_POST['nombre']."','".$_POST['apellidos']."','".$_POST['telefono']."','".$_POST['direccion']."','usuario','".$_POST['usuario']."','".$_POST['contraseña']."');";

   var_dump($consulta);

   $result = $connection->query($consulta);
      ?>

    <?php endif ?>

</body>
</html>
