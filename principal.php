<?php
  session_start();
  //var_dump($_SESSION);
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
  <style>
      span {
        width: 200px;
        display: inline-block;
      }
    </style>
  </head>
  <body class="container">
    <?php //Conexion
      //  if (isset($_POST["usuario"])) {

          $connection = new mysqli("localhost", "root", "Admin2015", "agromoise", 3316);
          $connection->set_charset("utf8");
          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }
?>
<div name="logo">
    <a href="principal.php"> <img src="imagenes/logo_actualizado.jpg"></a>
</div>
<?php
   if (!isset($_SESSION['usuario'])) {
   }
   //Usuario iniciado como Admin
  if (isset($_SESSION['roll']) && $_SESSION['roll']=='admin') {
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
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Administración
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="admin/administrar_productos.php">Administrar Productos</a>
          <a class="dropdown-item" href="admin/administrar_clientes.php">Administrar clientes</a>
          <a class="dropdown-item" href="admin/administrar_proveedores.php">Administrar proveedores</a>
          <a class="dropdown-item" href="admin/administrar_ventas.php">Administrar Ventas</a>
        </div>
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
      <?php
      }elseif (isset($_SESSION['roll']) && $_SESSION['roll']=='usuario') {
      ?>
      <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="principal.php">Inicio<span class="sr-only">(current)</span></a>
            </li>
          </div>
          <div class="collapse navbar-collapse ml-5 pl-5" id="navbarNavDropdown">
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
      <?php
      } elseif (!isset($_SESSION['usuario'])) {
            ?>
            <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
              <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" href="principal.php">Inicio<span class="sr-only">(current)</span></a>
                  </li>
                </div>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <?php
                $v1=0;
                if (empty($_SESSION["roll"])) {?>

                          <a class="nav-link" href="carrito.php"><img src="imagenes/iconos/carrito.jpg" id='icono'><span class="sr-only">(current)</span></a>

                          <?php echo ("<b>User:</b> No logged"); }?>

                          <a class="nav-link" href="iniciosesion.php">Iniciar sesion<span class="sr-only">(current)</span></a>
                          <a class="nav-link" href="Registro.php">Registrarse<span class="sr-only">(current)</span></a>
                </ul>
              </div>
            </nav>
      <?php
        }
      ?>
    <div class="row" id="productos">
        <div class="col-md-4">
          <a href='remolques.php?tipo=remolques'><img src="imagenes/remolques/1.jpg" id="imagen-tamaño"></a>
          <p><a href='remolques.php?tipo="remolques"'<p id="imagen-position">Remolques</p></a></p>
        </div>
        <div class="col-md-4">
          <a href='ordeñadoras.php?tipo=ordeñadoras'><img src="imagenes/ordenadoras/1.jpg" id="imagen-tamaño"></a>
          <p><a href='ordeñadoras.php?tipo="ordeñadoras"'<p id="imagen-position">Ordeñadoras</p></a></p>
        </div>
        <div class="col-md-4">
          <a href='mezclador.php?tipo=mezclador'><img src="imagenes/mezclador/1.PNG" id="imagen-tamaño"></a>
          <p><a href='mezclador.php?tipo=mezclador'<p id="imagen-position">Mezclador</p></a></p>
        </div>
      </div>
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </body>
</html>
