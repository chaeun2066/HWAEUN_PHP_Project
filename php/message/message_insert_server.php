<?php
  include('../../db/db_connect.php');

  $send_id = $rv_id = $subject = $content = "";

  if(isset($_POST['send_id']) && isset($_POST['rv_id']) && isset($_POST['subject']) && isset($_POST['content'])){
    $send_id = mysqli_real_escape_string($con, $_POST['send_id']);
    $rv_id = mysqli_real_escape_string($con, $_POST['rv_id']);
    $subject = mysqli_real_escape_string($con, $_POST['subject']);
    $content = mysqli_real_escape_string($con, $_POST['content']);

    $subject = htmlspecialchars($subject, ENT_QUOTES);
    $content = htmlspecialchars($content, ENT_QUOTES);
    $regist_day = date("Y-m-d [H:i]");

    if(!$send_id) {
      echo("
        <script>
        alert('로그인 후 이용해 주세요! ');
        history.go(-1)
        </script>
        ");
      exit;
    }

    $sql = "select * from customer where id='$rv_id'";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) == 1){
      $sql = "insert into message(send_id, rv_id, subject, content, regist_day)";
      $sql .= "values('$send_id', '$rv_id', '$subject', '$content', '$regist_day')";
      mysqli_query($con, $sql);
    }else{
      eader("location: message_form.php?error=수신 아이디가 잘못되었습니다.");
      exit;
    }
    mysqli_close($con);    

    header("location: message_box.php?mode=send");
  }
?>