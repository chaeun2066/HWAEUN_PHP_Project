<?php
  include('../../db/db_connect.php');

  $id = $pass = $pass_confirm = $name = $email1 = $email2 = $phone = $address = "";

  if(isset($_POST['id']) && isset($_POST['pass']) && isset($_POST['pass_confirm']) && isset($_POST['name']) && isset($_POST['email1']) && isset($_POST['email2']) && isset($_POST['phone']) && isset($_POST['address'])){
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);
    $pass_confirm = mysqli_real_escape_string($con, $_POST['pass_confirm']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email1 = mysqli_real_escape_string($con, $_POST['email1']);
    $email2 = mysqli_real_escape_string($con, $_POST['email2']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $address = mysqli_real_escape_string($con, $_POST['address']);

    $email = $email1."@".$email2;
    $regist_day = date("Y-m-d [H:i]");

    $customer_info = "id={$id}&name={$name}&email1={$email1}&email2={$email2}&phone={$phone}&address={$address}";

    if(empty($id)){
      header("location: customer_form.php?error=아이디를 입력해주세요.&$customer_info");
      exit();
    }elseif(empty($pass)){
      header("location: customer_form.php?error=비밀번호를 입력해주세요.&$customer_info");
      exit();
    }elseif(empty($pass_confirm)){
      header("location: customer_form.php?error=비밀번호를 확인해주세요.&$customer_info");
      exit();
    }elseif(empty($name)){
      header("location: customer_form.php?error=이름을 입력해주세요.&$customer_info");
      exit();
    }elseif(empty($phone)){
      header("location: customer_form.php?error=연락처를 입력해주세요.&$customer_info");
      exit();
    }elseif($pass !== $pass_confirm){
      header("location: customer_form.php?error=비밀번호가 일치하지 않습니다.&$customer_info");
      exit();
    }else{
      $pass = password_hash($pass, PASSWORD_DEFAULT);

      $sql = "select * from customer where id='$id'";
      $record_set = mysqli_query($con, $sql);

      if(mysqli_num_rows($record_set) > 0){
        header("location: customer_form.php?error=아이디가 중복입니다.");
        exit();
      }else{
        $sql = "insert into customer(id, pass, name, email, regist_day, phone, address, level, point) values('$id', '$pass', '$name','$email','$regist_day', '$phone', '$address', 9, 0)";
        $result = mysqli_query($con, $sql);
        mysqli_close($con);

        if($result){
          header("location: customer_success.php?name={$name}");
          exit();
        }
      }
    }
  }else{
    header("location: customer_form.php?error=알 수 없는 오류입니다.");
    exit();
  }
?>