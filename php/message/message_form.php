<style>
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
    margin-bottom: 80px;
  }
  .somenu{
    font-family: 'YUniverse-B';
    display: flex;
    flex-direction: column;
    font-size: 23px;
    margin-top: 20px;
    margin-right: 185px;
  }
  .somenu li{
    margin-top: 5px;
  }
  #li_somenu{
    color: rgb(200, 200, 200);
    font-family: 'S-CoreDream-3Light';
    font-size: 16px;
  }
  #li_somenu:hover{
    color: #5d7759;
    font-size: 18px;
  }
  #li_somenu_first{
    color: #2b3729;
    font-family: 'S-CoreDream-3Light';
    font-size: 18px;
  }
  #title_somenu{
    color: #2b3729;
    font-family: 'YUniverse-B';
  }
  #title_somenu:hover{
    color: #5d7759;
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
  .message_top{
    border-bottom: 2px solid #3a4a37;
  }
  .message_top p{
    padding-top: 10px;
    margin-bottom: 5px;
    font-weight: 600;
  }
  #write_msg{
    display: flex;
    flex-direction: column;
    padding-left: 0;
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
    margin-top: 6px;
  }
  .error{
    color: #ae3e32;
  }
  .input_id{
    height: 40px;
    width: 500px;
    padding-left: 10px;
    line-height: 40px;
  }
  .input_id input{
    font-size: 16px;
    width: 490px;
    font-family: 'S-CoreDream-3Light';
    margin-top: 6px;
  }
  .input_content{
    border: 1px solid #9d9d9d;
    height: 150px;
    width: 500px;
    padding-left: 10px;
    line-height: 40px;
  }
  textarea{
    resize: none;
    margin-top: 6px;
    width: 490px;
    height: 135px;
    border: none;
    background-color: transparent;
    outline: none;
    font-size: 16px;
    font-family: 'S-CoreDream-3Light';
    margin-top: 6px;
  }
  .green_button{
    border:none;
    background-color: #3a4a37;
    color: white;
    height: 40px;
    width: 100px;
    font-family: 'S-CoreDream-3Light';
    margin-right: 20px;
    float: right;
  }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>HWAEUN</title>
  <link href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/img/leaf.png" rel="shortcut icon" type="image/x-icon">
  <link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/css/common.css">
  <script src="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/js/message.js"></script>
</head>
<body>
  <header>
    <?php include "../header.php"; ?>
  </header>
  <?php
    if(!isset($id) || empty($id)){
      echo("<script>
				alert('로그인 후 이용해주세요!');
				history.go(-1);
				</script>
			");
      exit;
    }
  ?>
  <section>
    <div class="main_content">
      <div class="blank"></div>
      <div class="minimap">
        <ul>
          <li><a class="gray" href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/index.php">HOME</a></li>
          <li class="gray">></li>
          <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/register/customer_form.php">메세지</a></li>
        </ul>
      </div>
      <div class="center">
        <div>
          <ul class="somenu">
            <li><a href="./message_box.php" id="title_somenu">MESSAGE</a></li>
            <li><a href="./message_form.php" id="li_somenu_first">쪽지보내기</a></li>
            <li><a href="./message_box.php?mode=rv" id="li_somenu">수신쪽지함</a></li>
            <li><a href="./message_box.php?mode=send" id="li_somenu">송신쪽지함</a></li>
          </ul>
        </div>
        <div>
          <h2>쪽지 보내기</h2>
          <div class="message_top">
            <p>쪽지 작성하기</p>
            <?php
              if(isset($_GET['error'])){
                echo "<p class='error'>{$_GET['error']}</p>";
              }

              if(isset($_GET['success'])){
                echo "<p class='success'>{$_GET['success']}</p>";
              }
            ?>
          </div>
          <form  name="message_form" method="post" action="message_insert_server.php">
          <div>
            <ul id="write_msg">
              <li class="box">
                <div class="title">보내는 사람</div>
                <div class="input_id"><input name="send_id" type="text" value="<?=$id?>" readonly></div>
              </li>	
              <li  class="box">
                <div class="title">수신 아이디</div>
                <div class="input"><input name="rv_id" type="text"></div>
              </li>	
              <li  class="box">
                <div class="title">제목</div>
                <div class="input"><input name="subject" type="text"></div>
              </li>	    	
              <li class="box">	
                <div class="title">내용</div>
                <div class="input_content">
                  <textarea name="content"></textarea>
                </div>
              </li>
            </ul>
            <button type="button" class="green_button" onclick="check_input()">보내기</button>
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