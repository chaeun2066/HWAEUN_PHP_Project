<?php
  session_start();

  if(!isset($_SESSION['id']) || empty($_SESSION['id'])){
    header("location: ../../index.php");
    exit();
  }

  unset($_SESSION['id']);
  unset($_SESSION['name']);
  unset($_SESSION['level']);
  unset($_SESSION['point']);

  header("location: http://127.0.0.1/hwaeun/php/index.php");
?>