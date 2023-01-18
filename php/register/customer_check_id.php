<?php
  include("../../db/db_connect.php");

  $message = $id = "";

  if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($con, $_GET['id']);

    if(!$id){
      $message = "<div class='id_box'></div><p class='alert'>아이디를 입력해주세요.</p>";
    }else{
      $sql_unregist = "select * from delete_customer where id = '$id'";
      $result = mysqli_query($con, $sql_unregist);

      if(mysqli_num_rows($result) == 1){
        $message = "<div class='id_box'>$id</div><p class='alert'>최근에 가입 이력이 있는 아이디입니다.</p><p class='alert'>다른 아이디를 사용해 주세요.</p>";
      }else{
        $sql_same = "select * from customer where id='$id'";
        $record_set = mysqli_query($con, $sql_same);
  
        if(mysqli_num_rows($record_set) == 1){
          $message = "<div class='id_box'>$id</div><p class='alert'>아이디는 중복됩니다.</p><p class='alert'>다른 아이디를 사용해 주세요.</p>";
        }else{
          $message =  "<div class='id_box'>$id</div><p class='alert'>아이디는 사용 가능합니다.</p>";
        }
      }
      mysqli_close($con);
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>HWAEUN</title>
  <link href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/img/leaf.png" rel="shortcut icon" type="image/x-icon">
  <style>
    @font-face {
      font-family: 'YUniverse-B';
      src: url('https://cdn.jsdelivr.net/gh/projectnoonnu/noonfonts_yuniverse@1.0/YUniverse-B.woff2') format('woff2');
      font-weight: normal;
      font-style: normal;
    } 
    @font-face {
      font-family: 'S-CoreDream-3Light';
      src: url('https://cdn.jsdelivr.net/gh/projectnoonnu/noonfonts_six@1.2/S-CoreDream-3Light.woff') format('woff');
      font-weight: normal;
      font-style: normal;
    }
    body{
      padding: 0;
      margin: 0;
    }
    p, h4{
      margin:0;
      font-family: 'S-CoreDream-3Light';
    }
    h4{
      color: white;
      font-size: 20px;
    }
    .title{
      background-color: #3a4a37;
      height: 20vh;
      padding: 0;
      padding-left: 20px;
      margin: 0;
      line-height: 20vh;
    }
    #close{
      text-align: center;
    }
    .green_button{
      background-color: #3a4a37;
      color: white;
      height: 40px;
      width: 100px;
      margin: 0;
      font-family: 'S-CoreDream-3Light';
      margin: 0 auto;
      margin-top: 20px;
      border: none;
    }
    .id_box{
      background-color: #e9e9e9;
      width: 300px;
      height: 50px;
      margin-left: 25px;
      margin-top: 20px;
      text-align: center;
      line-height: 50px;
      color: blue;
      font-family: 'S-CoreDream-3Light';
      font-size: 18px;
    }
    .alert{
      text-align: center;
      margin: 0 auto;
      margin-top: 10px;
      font-size: 15px;
    }
  </style>
</head>
<body>
  <div class="title">
    <h4>아이디 중복체크</h4>
  </div>
  <p><?php echo "{$message}"; ?></p>
  <div id="close">
    <input type="button" class="green_button" onclick="javascript:self.close()" value="확인">
  </div>
</body>
</html>