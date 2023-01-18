<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>HWAEUN</title>
  <link href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/img/leaf.png" rel="shortcut icon" type="image/x-icon">
  <link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/css/common.css">
  <link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/css/login.css">
</head>
<body>
  <header>
    <?php include "../header.php"; ?>
  </header>
  <section>
    <div class="main_content">
      <div class="blank"></div>
      <div class="minimap">
        <ul>
          <li><a class="gray" href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/index.php">HOME</a></li>
          <li class="gray">></li>
          <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/login/login_form.php">로그인</a></li>
        </ul>
      </div>
      <div class="center">
        <div>
          <ul class="somenu">
            <li><a href="../login/login_form.php" id="login_somenu">LOGIN</a></li>
            <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/register/customer_form.php" id="join_somenu">JOIN</a></li>
          </ul>
        </div>
        <div class="login_box">
          <h2>로그인</h2>
            <div class="join_top">
              <p>회원 로그인</p>
            </div>
            <div class="form">
              <form name="login_form" method="POST" action="./login_server.php">
                <div class="forminput">
                  <div class="input">
                    <input type="text" name="id" placeholder="아이디 입력">
                  </div>
                  <?php
                    if(isset($_GET['id_error'])){
                      echo "<p class='id_error'>{$_GET['id_error']}</p>";
                    }
                  ?>
                </div>
                <div class="forminput">
                  <div class="input">
                    <input type="password" name="pass" placeholder="비밀번호 입력">
                  </div>
                  <?php
                    if(isset($_GET['pass_error'])){
                      echo "<p class='pass_error'>{$_GET['pass_error']}</p>";
                    }
                  ?>
                </div>
                <div class="login_menu">
                  <div class="check">
                    <p>  </p>
                    <!-- <input type='checkbox' name='id_save' value='id_save' /> 
                    <lable>아이디저장</lable> -->
                  </div>
                  <span class="login_menu_gray">아직 계정이 없으세요?&nbsp;&nbsp;<a  class="login_menu_gray" href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/register/customer_form.php">회원가입</a></span>
                </div>
                <input type="submit" class="green_button" value="로그인">
              </form>
            </div>
        </div>
        <div class="ad">
          <img class="ad_img" src="../../img/login_ad.jpg" alt="login ad">
        </div>
      </div>
    </div>
  </section>
  <footer>
    <?php include "../footer.php"; ?>
  </footer>
</body>
<script src="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/js/header.js"></script>
</html>