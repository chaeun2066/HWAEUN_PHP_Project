<?php
  include_once $_SERVER['DOCUMENT_ROOT']."/hwaeun/db/create_statement.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>HWAEUN</title>
  <link href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/img/leaf.png" rel="shortcut icon" type="image/x-icon">
  <style>
    header{
      position:fixed;
      z-index: 999 !important;
    }
    section{
      position: relative;
    }
    footer{
      position: relative;
      z-index: 999;
    }
  </style>
  <link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/css/section.css">
  <script src="../js/section.js"></script>
</head>
<body onload="call_ad()">
  <header>
    <?php include "header.php"; ?>
  </header>
  <section>
    <?php include "section.php"; ?>
  </section>
  <footer>
    <?php include "footer.php"; ?>
  </footer>
</body>
<script src="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/js/header.js"></script>
</html>