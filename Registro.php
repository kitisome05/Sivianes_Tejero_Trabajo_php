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
  <style>
      span {
        width: 200px;
        display: inline-block;
      }
    </style>
  </head>
  <body class="container">
    <a href="principal.php"><img src="imagenes/logo_actualizado.jpg" id="logo-tamaño"></a>
    <?php if (!isset($_POST["usuario"])) : ?>

      <div class="container">
        <form method="post">
          <div class="form-group row">
            <label for="inlineFormInput" class="col-sm-2 col-form-label">Nombre</label>
            <div class="col-sm-10">
              <input type="text" name="nombre" class="form-control" id="inlineFormInput" placeholder="Nombre">
            </div>
          </div>
          <div class="form-group row">
            <label for="inlineFormInput" class="col-sm-2 col-form-label">Apellidos</label>
            <div class="col-sm-10">
              <input type="text" name="apellidos" class="form-control" id="inlineFormInput" placeholder="Apellidos">
            </div>
          </div>
          <div class="form-group row">
            <label for="inlineFormInput" class="col-sm-2 col-form-label">Teléfono</label>
            <div class="col-sm-10">
              <input type="text" name="telefono" maxlength="9" class="form-control" id="inlineFormInput" placeholder="123456789">
            </div>
          </div>
          <div class="form-group row">
            <label for="inlineFormInput" class="col-sm-2 col-form-label">Dirección</label>
            <div class="col-sm-10">
              <input type="text" name="direccion" class="form-control" id="inlineFormInput" placeholder="c/'Nombre de la calle'">
            </div>
          </div>
          <div class="form-group row">
      <label for="inlineFormInput" class="col-sm-2 col-form-label">Usuario</label>
      <div class="col-sm-10">
        <input type="text" name="usuario" class="form-control" id="inlineFormInput" placeholder="Usuario">
      </div>
    </div>
    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
      <div class="col-sm-10">
        <input type="password" name="contrasena" class="form-control" id="inputPassword3" placeholder="Password">
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
          echo "<h3>Showing data coming from the form</h3>";
          var_dump($_POST);

          //CREATING THE CONNECTION
          $connection = new mysqli("localhost", "root", "Admin2015", "agromoise", 3316);

         //TESTING IF THE CONNECTION WAS RIGHT
         if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $connection->connect_error);
         exit();
        }

   var_dump($_POST);
   $pass=$_POST['contrasena'];
   $consulta= "INSERT INTO clientes (cod_cliente,nombre, apellidos, telefono, direccion, roll, usuario, contrasena)
   VALUES(null,'".$_POST['nombre']."','".$_POST['apellidos']."','".$_POST['telefono']."','".$_POST['direccion'].
   "','usuario','".$_POST['usuario']."',md5('".$pass."'))";

   var_dump($consulta);


    if ($result = $connection->query($consulta)) {
      echo "CONSULTA CORRECTO";
      header("Location: principal.php");
    } else {
      echo "NO";
      echo $connection->error;
    }

    var_dump($result);

      ?>

    <?php endif ?>

</body>
</html>
