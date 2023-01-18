<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>HWAEUN</title>
  <link href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/img/leaf.png" rel="shortcut icon" type="image/x-icon">
  <link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/css/common.css">
  <link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/css/customer.css">
  <script src="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/js/join.js"></script>
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
          <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/register/customer_form.php">회원가입</a></li>
        </ul>
      </div>
      <div class="center">
        <div>
          <ul class="somenu">
            <li><a href="../login/login_form.php" id="login_somenu">LOGIN</a></li>
            <li><a href="./customer_form.php" id="join_somenu">JOIN</a></li>
          </ul>
        </div>
        <div>
          <form name="customer_form" id="join" method="POST" action="./customer_insert_server.php">
            <h2>회원가입</h2>
            <div class="join_top">
              <p>회원정보 입력</p>
              <?php
                if(isset($_GET['error'])){
                  echo "<p class='error'>{$_GET['error']}</p>";
                }
              ?>
            </div>

            <div class="form">
              <div class="box">
                <div class="title">아이디<span>*</span></div>
                <div class="input">
                  <?php
                    if(isset($_GET['id'])){
                      $id = $_GET['id'];
                      echo "<input type='text' placeholder='6~15자리의 영문 및 숫자 혼용 사용 가능' name='id' value={$id}>";
                    }else{
                      echo "<input type='text' placeholder='6~15자리의 영문 및 숫자 혼용 사용 가능' name='id'>";
                    }
                  ?>
                </div>
                <input type="button" class="green_button" onclick="check_id()" value="중복확인">
              </div>
            </div>
            <div class="clear"></div>

            <div class="form">
              <div class="box">
                <div class="title">비밀번호<span>*</span></div>    
                <div class="input">
                  <?php
                    if(isset($_GET['pass'])){
                      $pass = $_GET['pass'];
                      echo "<input type='password' placeholder='10~15자리의 영문 및 숫자 혼용 사용 가능, 대소문자 구분' name='pass' value={$pass}>";
                    }else{
                      echo "<input type='password' placeholder='10~15자리의 영문 및 숫자 혼용 사용 가능, 대소문자 구분' name='pass'>";
                    }
                  ?>
                </div>
              </div>
            </div>
            <div class="clear"></div>

            <div class="form">
              <div class="box">
                <div class="title">비밀번호 확인<span>*</span></div>    
                <div class="input">
                  <?php
                    if(isset($_GET['pass_confirm'])){
                      $pass_confirm = $_GET['pass_confirm'];
                      echo "<input type='password' placeholder='비밀번호 확인' name='pass_confirm' value={$pass_confirm}>";
                    }else{
                      echo "<input type='password' placeholder='비밀번호 확인' name='pass_confirm'>";
                    }
                  ?>
                </div>
              </div>
            </div>
            <div class="clear"></div>

            <div class="form">
              <div class="box">
                <div class="title">이름<span>*</span></div>    
                <div class="input">
                  <?php
                    if(isset($_GET['name'])){
                      $name = $_GET['name'];
                      echo "<input type='text' name='name' value={$name}>";
                    }else{
                      echo "<input type='text' name='name'>";
                    }
                  ?>
                </div>
              </div>  
            </div>
            <div class="clear"></div>

            <div class="form">
              <div class="box">
                <div class="title">이메일</div>    
                  <?php
                    if(isset($_GET['email1']) && isset($_GET['email2'])){
                      $email1 = $_GET['email1'];
                      $email2 = $_GET['email2'];
                      echo "<div class='email'><input type='text' name='email1' value={$email1}></div> 
                      &nbsp;@&nbsp;<div class='email'><input type='text' name='email2' value={$email2}></div>";
                    }else{
                      echo "<div class='email'><input type='text' name='email1'></div> 
                      &nbsp;@&nbsp;<div class='email'><input type='text' name='email2'></div>";
                    }
                  ?>
              </div>  
            </div>
            <div class="clear"></div>

            <div class="form">
              <div class="box">
                <div class="title">연락처<span>*</span></div>    
                <div class="input">
                  <?php
                    if(isset($_GET['phone'])){
                      $phone = $_GET['phone'];
                      echo "<input type='text' placeholder='-기호 제외 입력' name='phone' value={$phone}>";
                    }else{
                      echo "<input type='text' placeholder='-기호 제외 입력' name='phone'>";
                    }
                  ?>
                </div>
              </div>  
            </div>
            <div class="clear"></div>

            <div class="form">
              <div class="box">
                <div class="title">주소</div>    
                <div class="input">
                  <?php
                    if(isset($_GET['address'])){
                      $address = $_GET['address'];
                      echo "<input type='text' name='address' value={$address}>";
                    }else{
                      echo "<input type='text' name='address'>";
                    }
                  ?>
                </div>
              </div>
            </div>
            <div class="clear"></div>

            <hr>

            <div class="buttons">
              <input class="gray_button" type="button" onclick="reset_form()" value="초기화">
              <input type="submit" class="green_button" value="가입하기">
            </div>
          </form>
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