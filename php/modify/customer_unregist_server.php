<?php
  include('../../db/db_connect.php');

  session_start();

  if (isset($_SESSION["id"])){
    $id = $_SESSION["id"];
  }else{
    $id = "";
  }

  $sql = "select * from customer where id='$id'";
  $result = mysqli_query($con, $sql);

  if(mysqli_num_rows($result) == 1){
    $sql_customer = "delete from customer where id ='$id'";
    $sql_board = "delete from board where id ='$id'";
    $sql_board_ripple = "delete from board_ripple where id ='$id'";
    // $sql_image_board = "delete from image_board where id ='$id'";
    // $sql_image_board_ripple = "delete from image_board_ripple  where id ='$id'";

    mysqli_query($con, $sql_customer);
    mysqli_query($con, $sql_board);
    mysqli_query($con, $sql_board_ripple);
    // mysqli_query($con, $sql_image_board);
    // mysqli_query($con, $sql_image_board_ripple);



    unset($_SESSION['id']);
    unset($_SESSION['name']);
    unset($_SESSION['level']);
    unset($_SESSION['point']);

    header("location: ../index.php");
    exit();
  }
?>