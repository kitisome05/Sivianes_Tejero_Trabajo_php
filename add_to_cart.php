<?php

  session_start();

  if (isset($_SESSION['carrito'][$_GET['cod_producto']])) {
    $_SESSION['carrito'][$_GET['cod_producto']]++;
  } else {
    $_SESSION['carrito'][$_GET['cod_producto']]=1;
  }

  echo "OK";
?>
