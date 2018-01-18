<?php
  session_start();
  ?>
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
  <body>
    <?php
        if (isset($_POST["usuario"])) {

          $connection = new mysqli("192.168.1.145", "root", "Admin2015", "tf", 3316);

          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }

          $consulta="select * from clientes where
username='".$_POST["usuario"]."' and password=md5('".$_POST["contraseña"]."');";

if ($result = $connection->query($consulta)) {
    //No rows returned
    if ($result->num_rows===0) {
      echo "LOGIN INVALIDO";
    } else {
      //VALID LOGIN. SETTING SESSION VARS
      $_SESSION["usuario"]=$_POST["usuario"];
      $_SESSION["language"]="es";
      header("Location: principal.php");
    }
} else {
  echo "Wrong Query";
}
}
?>
    <a href="principal.php"> <img src="imagenes/logo_actualizado.jpg"></a>
     <a href="iniciosesion.php" style="padding-right: 2cm;"><button type="button">Iniciar sesion</button></a>
      <a href="Registro.php" style="padding-right: 2cm;"><button type="button">Registrarse</button></a>

      <div>
        <a href="remolques.php"><img src="imagenes/remolques/1.jpg" style="width:200px;height:80px"></a>
        <p><a href="remolques.php"<p style="margin-left:50px">Remolques</p></a></p>
      </div>
      <div>
        <a href="ordeñadoras.php"><img src="imagenes/ordeñadoras/1.jpg" style="width:200px;height:80px"></a>
        <p><a href="ordeñadoras.php"<p style="margin-left:50px">Ordeñadoras</p></a></p>
      </div>
      <div>
        <a href="mezclador.php"><img src="imagenes/mezclador/1.PNG" style="width:200px;height:80px"></a>
        <p><a href="mezclador.php"<p style="margin-left:50px">Mezclador</p></a></p>
      </div>
  </body>
</html>
