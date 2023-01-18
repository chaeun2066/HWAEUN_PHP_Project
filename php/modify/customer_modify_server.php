<?php
  include('../../db/db_connect.php');
  session_start();

  $id = $pass = $name = $email1 = $email2 = $phone = $address = "";

  if(isset($_POST['id']) && isset($_POST['pass']) && isset($_POST['name']) && isset($_POST['email1']) && isset($_POST['email2']) && isset($_POST['phone']) && isset($_POST['address'])){
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email1 = mysqli_real_escape_string($con, $_POST['email1']);
    $email2 = mysqli_real_escape_string($con, $_POST['email2']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $address = mysqli_real_escape_string($con, $_POST['address']);

    $email = $email1."@".$email2;

    $customer_info = "id={$id}&name={$name}";

    $sql = "select * from customer where id = '$id'";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) == 1){
      $sql = "update customer set pass='$pass', name='$name', email='$email', phone='$phone', address='$address'";
      $sql .= " where id='$id'";
      $result = mysqli_query($con, $sql);
      mysqli_close($con);

      if(!$result){
        header("location: customer_modify_form.php?error=수정에 실패했습니다.&$customer_info");
         exit;
      }

      $_SESSION['username']=$_POST['name'];
      header("location: customer_modify_form.php?success=수정이 완료되었습니다.");
      exit;
    }else{
      header("location: customer_modify_form.php?error=가입되지 않은 아이디입니다.&$customer_info");
      exit;
    }
  }else{
    header("location: customer_modify_form.php?error=알 수 없는 오류입니다.");
    exit();
  }
?>