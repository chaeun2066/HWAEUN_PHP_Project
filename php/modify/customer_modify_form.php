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
  .main_content{
    padding-top:90px;
    width: 100%;
    min-width: 1320px;
    font-family: 'S-CoreDream-3Light';
  }
  .main_content a{
    text-decoration-line: none;
  }
  .blank{
    height: 8px;
  }
  .center{
    display: flex;
    justify-content: center;
  }
  .somenu{
    font-family: 'YUniverse-B';
    display: flex;
    flex-direction: column;
    color: #2b3729;
    font-size: 23px;
    margin-top: 20px;
    margin-right: 150px;
  }
  .somenu li{
    margin-top: 5px;
  }
  #mypage_somenu{
    border-bottom: 2px solid #3a4a37;
    color: #2b3729;
  }
  #unregist_somenu{
    font-family: 'S-CoreDream-3Light';
    font-size: 16px;
    color: rgb(200, 200, 200);
    margin-top: 10px;
  }
  #unregist_somenu:hover{
    color: #5d7759;
    font-size: 18px;
  }
  #modify_somenu{
    font-family: 'S-CoreDream-3Light';
    font-size: 18px;
    color: #2b3729;
  }
  .minimap{
    margin-top: 10px;
    font-size: 13px;
    width: 100%;
    min-width: 1320px;
  }
  .minimap a{
    color: var(--normal_font);
  }
  .minimap ul{
    display: flex;
    padding-left: 160px;
  }
  .minimap ul li{
    padding: 2px 5px;
  }
  .gray{
    color: rgb(204, 204, 204);
  }
  .join_top{
    border-bottom: 2px solid #3a4a37;
  }
  .join_top p{
    margin-bottom: 5px;
    font-weight: 600;
  }
  .form{
    font-size: 14px;
  }
  span{
    color: #ae3e32;
  }
  .box{
    display: flex;
    padding: 15px;
    align-items: center;
  }
  .title{
    width: 170px;
  }
  input{
    border: none;
    background-color: transparent;
    outline: none;
    margin-top: 8px;
  }
  .input{
    border: 1px solid #9d9d9d;
    height: 40px;
    width: 500px;
    padding-left: 10px;
    line-height: 40px;
  }
  .input input{
    font-size: 16px;
    width: 490px;
    font-family: 'S-CoreDream-3Light';
  }
  .email{
    border: 1px solid #9d9d9d;
    height: 40px;
    width: 233px;
    padding-left: 10px;
  }
  .email input{
    font-size: 16px;
    width: 222px;
    font-family: 'S-CoreDream-3Light';
  }
  .green_button{
    background-color: #3a4a37;
    color: white;
    height: 40px;
    width: 100px;
    margin: 0;
    font-family: 'S-CoreDream-3Light';
    margin-left: 10px;
  }
  .gray_button{
    background-color: #c3c3c3;
    color: white;
    height: 40px;
    width: 100px;
    margin: 0;
    font-family: 'S-CoreDream-3Light';
  }
  .buttons{
    display: flex;
    justify-content: flex-end;
    padding-right: 18px;
    margin-top: 20px;
    margin-bottom: 80px;
  }
  .buttons input{
    width: 200px;
  }
  .join_top{
    display: flex;
    justify-content: space-between;
  }
  .id_input{
    border: none;
  }
  .error, .success{
    color: #ae3e32;
  }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>HWAEUN</title>
  <link href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/img/leaf.png" rel="shortcut icon" type="image/x-icon">
  <link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/css/common.css">
</head>
<body>
  <header>
    <?php include "../header.php"; ?>
  </header>
  <?php
    include('../../db/db_connect.php');

    $sql = "select * from customer where id = '$id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $pass = $row["pass"];
    $name = $row["name"];

    $email = explode("@", $row["email"]);
    $email1 = $email[0];
    $email2 = $email[1];

    $phone = $row["phone"];
    $address = $row["address"];

    mysqli_close($con);
  ?>
  <section>
  <div class="main_content">
      <div class="blank"></div>
      <div class="minimap">
        <ul>
          <li><a class="gray" href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/index.php">HOME</a></li>
          <li class="gray">></li>
          <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/register/customer_form.php">MY PAGE</a></li>
          <li class="gray">></li>
          <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/modify/customer_modify_form.php">회원정보 수정</a></li>
        </ul>
      </div>
      <div class="center">
        <div>
          <ul class="somenu">
            <li><a href="../register/customer_form.php" id="mypage_somenu">MY PAGE</a></li>
            <li><a href="../register/customer_form.php" id="modify_somenu">회원정보 수정</a></li>
            <li><a href="./customer_unregist.php" id="unregist_somenu">회원 탈퇴</a></li>
          </ul>
        </div>
        <div>
          <form name="customer_form" id="join" method="POST" action="customer_modify_server.php">
            <h2>MY PAGE</h2>
            <div class="join_top">
              <p>회원정보 수정</p>
              <?php
                if(isset($_GET['error'])){
                  echo "<p class='error'>{$_GET['error']}</p>";
                }
                
                if(isset($_GET['success'])){
                  echo "<p class='success'>{$_GET['success']}</p>";
                }
              ?>
            </div>

            <div class="form">
              <div class="box">
                <div class="title">아이디<span>*</span></div>
                <div class="input" style="border: none">
                  <input type='text' name='id' value="<?=$id?>" readonly>
                </div>
              </div>
            </div>
            <div class="clear"></div>

            <div class="form">
              <div class="box">
                <div class="title">비밀번호<span>*</span></div>    
                <div class="input">
                  <input type='password' name='pass' value="<?=$pass?>">
                </div>
              </div>
            </div>
            <div class="clear"></div>

            <div class="form">
              <div class="box">
                <div class="title">비밀번호 확인<span>*</span></div>    
                <div class="input">
                  <input type='password' name='pass_confirm' value="<?=$pass?>">
                </div>
              </div>
            </div>
            <div class="clear"></div>

            <div class="form">
              <div class="box">
                <div class="title">이름<span>*</span></div>    
                <div class="input">
                  <input type='text' name='name' value="<?=$name?>">
                </div>
              </div>  
            </div>
            <div class="clear"></div>

            <div class="form">
              <div class="box">
                <div class="title">이메일</div>    
                  <div class='email'><input type='text' name='email1' value="<?=$email1?>"></div> 
                  &nbsp;@&nbsp;
                  <div class='email'><input type='text' name='email2' value="<?=$email2?>"></div>
              </div>  
            </div>
            <div class="clear"></div>

            <div class="form">
              <div class="box">
                <div class="title">연락처<span>*</span></div>    
                <div class="input">
                  <input type='text' name='phone' value="<?=$phone?>">
                </div>
              </div>  
            </div>
            <div class="clear"></div>

            <div class="form">
              <div class="box">
                <div class="title">주소</div>    
                <div class="input">
                  <input type='text' name='address' value="<?=$address?>">
                </div>
              </div>
            </div>
            <div class="clear"></div>

            <hr>

            <div class="buttons">
              <input class="gray_button" type="button" onclick="reset_form()" value="초기화">
              <input type="submit" class="green_button" value="수정하기">
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
<script src="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/js/member_modify.js"></script>
</html>