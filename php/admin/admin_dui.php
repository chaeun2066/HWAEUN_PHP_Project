<?php
  session_start();

  $level = isset($_SESSION['level']) ? $_SESSION['level'] : "";

  if($level != 1){
    echo("
        <script>
          alert('관리자 접근이 아닙니다.');
          history.go(-1)
        </script>
    ");
    exit;
  }

  include('../../db/db_connect.php');

  $mode = $_GET['mode'];

  switch($mode){
    case "update":
      $num   = $_POST["num"];
      $level = $_POST["level"];
      $point = $_POST["point"]; 
      $sql = "update customer set level=$level, point=$point where num=$num";
      mysqli_query($con, $sql);
      mysqli_close($con);
      break;
    case "delete":
      $num   = $_GET["num"];
      $sql = "delete from customer where num = $num";
      mysqli_query($con, $sql);
      mysqli_close($con);
      break;
    case "board_delete":
      $num_item = 0;
      if (isset($_POST["item"])){
        $num_item = count($_POST["item"]); 
      }else{
        echo("
          <script>
          alert('삭제할 게시글을 선택해주세요!');
          history.go(-1)
          </script>
        ");
      }
    
      for($i = 0; $i<$num_item; $i++){
        $num = $_POST['item'][$i];
    
        $sql = "select * from board where num = $num";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
    
        // $copied_name = $row['rile_copied']; 

        // if($copied_name){
        //   $file_path = "../../data/".$copied_name;
        //   unlink($file_path);
        // }
    
        $sql = "delete from board where num =  $num";
        mysqli_query($con, $sql);
      }
      mysqli_close($con); 
      break;
  }
  header("location:admin_customer.php");
  exit();
?>