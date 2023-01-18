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
    width: 150px;
  }
  .somenu li{
    margin-top: 5px;
  }
  #mypage_somenu{
    border-bottom: 2px solid #3a4a37;
    color: #2b3729;
  }
  #modify_somenu{
    font-family: 'S-CoreDream-3Light';
    font-size: 16px;
    color: rgb(200, 200, 200);
    margin-top: 10px;
  }
  #modify_somenu:hover{
    color: #5d7759;
    font-size: 18px;
  }
  #unregist_somenu{
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
  .minimap ul{
    display: flex;
    padding-left: 160px;
  }
  .minimap ul li{
    padding: 2px 5px;
  }
  .minimap a{
    color: var(--normal_font);
  }
  .gray{
    color: rgb(204, 204, 204);
  }
  .unregist_top{
    border-bottom: 2px solid #3a4a37;
  }
  .unregist_top p{
    margin-bottom: 5px;
    font-weight: 600;
  }
  .box{
    display: flex;
    padding: 15px;
    align-items: center;
  }
  .title{
    width: 170px;
  }
  .red_button{
    background-color: #782f2f;
    color: white;
    height: 40px;
    width: 100px;
    margin: 0;
    font-family: 'S-CoreDream-3Light';
    margin-left: 20px;
    border:none;
  }
  .buttons{
    margin-top: 20px;
    margin-bottom: 80px;
    text-align: center;
  }
  .buttons input{
    width: 200px;
  }
  .unregist_box{
    background-color : #e9e9e9;
    width: 710px;
    height: 200px;
    margin-top: 10px;
    text-align: center;
  }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>HWAEUN</title>
  <link href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/img/leaf.png" rel="shortcut icon" type="image/x-icon">
  <link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/css/common.css">
  <script src="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/js/header.js"></script>
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
          <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/register/customer_form.php">MY PAGE</a></li>
          <li class="gray">></li>
          <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/modify/customer_unregist.php">회원탈퇴</a></li>
        </ul>
      </div>
      <div class="center">
        <div style="width: 300px">
          <ul class="somenu">
            <li><a href="./customer_modify_form.php" id="mypage_somenu">MY PAGE</a></li>
            <li><a href="./customer_modify_form.php" id="modify_somenu">회원정보 수정</a></li>
            <li><a href="./customer_unregist.php" id="unregist_somenu">회원 탈퇴</a></li>
          </ul>
        </div>
        <div>
          <form name="customer_form" id="unregist" method="POST" action="customer_unregist_server.php">
            <h2>MY PAGE</h2>
            <div class="unregist_top">
              <p>회원탈퇴</p>
            </div>
            <div class="unregist_box">
              <p style="padding-top: 25px">회원탈퇴 시 개인정보 및 HWAEUN에서 만들어진 모든 데이터는 삭제됩니다.</p> 
              <p>회원탈퇴 처리 후에는 회원님의 개인정보를 복원할 수 없습니다.</p> 
              <p>회원탈퇴 후에는 작성한 게시글 및 쪽지, 댓글은 모두 삭제됩니다.</p> 
              <p style="font-size: 20px">그래도 탈퇴하시겠습니까?</p> 
            </div>
            <div class="buttons">
              <input type="submit" class="red_button" onclick="unregist()" value="탈퇴하기">
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