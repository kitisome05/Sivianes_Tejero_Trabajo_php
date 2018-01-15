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
    <?php if (!isset($_POST["usuario"])) : ?>
      <form method="post">
        <fieldset>
          <legend style="margin-left:170px">Inisiar sesion</legend>
          <span>Nombre de usuario:</span><input type="text" name="usuario" required><br>
          <span>Contraseña:</span><input type="text" name="contraseña" required><br>
          <p style="margin-left:170px"><input type="submit" value="Enviar"></p>
        </fieldset>
      </form>
    <?php else: ?>

      <?php
          echo "<h3>Showing data coming from the form</h3>";
          var_dump($_POST);
      ?>

    <?php endif ?>

</body>
  </html>
