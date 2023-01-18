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
  .notice_top{
    border-bottom: 2px solid #3a4a37;
  }
  .notice_top p{
    margin-bottom: 5px;
    font-weight: 600;
  }
  #notice_form{
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
  .buttons{
    display: flex;
    justify-content: flex-end;
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
  <script>
    function check_input(){
      if (!document.notice_form.subject.value){
          header("location: notice_form.php?error=제목을 입력하세요.");
          document.notice_form.subject.focus();
          return;
      }
      if (!document.notice_form.content.value){
        header("location: notice_form.php?error=내용을 입력하세요.");
          document.notice_form.content.focus();
          return;
      }
      document.notice_form.submit();
    }
  </script>
</head>
<body>
  <header>
    <?php include "../header.php"; ?>
  </header>
  <?php
    if($id !== 'admin'){
      echo("<script>
				alert('관리자만 접근이 가능합니다.');
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
          <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/notice/notice_list.php">공지사항</a></li>
        </ul>
      </div>
      <div class="center">
        <div>
          <ul class="somenu">
            <li><a href="./notice_list.php" id="title_somenu">Notice</a></li>
            <li><a href="./notice_list.php" id="li_somenu_first">공지사항</a></li>
            <li><a href="../event/event_list.php" id="li_somenu">이벤트</a></li>
          </ul>
        </div>
        <div>
          <h2>공지사항</h2>
          <div class="notice_top">
            <p>               </p>
            <?php
              if(isset($_GET['error'])){
                echo "<p class='error'>{$_GET['error']}</p>";
              }
            ?>
          </div>
          <form  name="notice_form" method="post" action="notice_dui.php" enctype="multipart/form-data">
          <input type="hidden" name="mode" value="insert">
          <div>
            <ul id="notice_form">
              <li class="box">
                <div class="title">작성자</div>
                <div class="input_id"><?=$id?></div>
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
              <li class="box">
                <div class="title">첨부 파일</div>
                <div class="input"><input name="upfile" type="file"></div>
              </li>	    	
            </ul>
            <ul class="buttons">
              <li><button type="button" onclick="check_input()" class="green_button">완료</button></li>
              <li><button type="button" onclick="location.href='notice_list.php'" class="green_button">목록</button></li>
            </ul>
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