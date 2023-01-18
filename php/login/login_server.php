<?php
  include('../../db/db_connect.php');

  session_start();

  $id = $pass = "";

  if(isset($_POST['id']) && isset($_POST['pass'])){
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);

    $customer_info = "id={$id}";

    if(empty($id)){
      header("location: login_form.php?error=아이디를 작성해주세요."&$customer_info);
      exit();
    }elseif(empty($pass)){
      header("location: login_form.php?error=아이디를 작성해주세요."&$customer_info);
      exit();
    }else {
      $sql = "select * from customer where id='$id'";

      $record_set = mysqli_query($con, $sql);

      if(mysqli_num_rows($record_set) == 1){
        $row = mysqli_fetch_assoc($record_set);
        $hash_value = $row["pass"];
        //mysqli_close();

        if(password_verify($pass, $hash_value)){
          $_SESSION['id']=$row['id'];
          $_SESSION['name']=$row['name'];
          $_SESSION['level']=$row['level'];
          $_SESSION['point']=$row['point'];

          header("location: ../index.php");
          exit();
        }else{
          header("location: login_form.php?error=패스워드 실패입니다.");
          exit();
        }
      }else{
        header("location: login_form.php?error=아이디를 잘못 입력하셨습니다.");
        exit();
      }
    }
  }else{
    header("location: login_form.php?error=알 수 없는 오류입니다.");
    exit();
  }
?>
