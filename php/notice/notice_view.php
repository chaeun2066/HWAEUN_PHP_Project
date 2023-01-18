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
    margin-bottom: 50px;
  }
  .somenu{
    font-family: 'YUniverse-B';
    display: flex;
    flex-direction: column;
    font-size: 23px;
    margin-top: 20px;
    margin-right: 150px;
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
  #title_somenu{
    color: #2b3729;
    font-family: 'YUniverse-B';
  }
  #li_somenu_notice{
    color: #2b3729;
    font-family: 'S-CoreDream-3Light';
    font-size: 18px;
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
  .notice{
    width: 740px;
  }
  .title_line{
    height: 1px;
    background-color: #2b3729;
    margin : 0;
  } 
  .box{
    display: flex;
    align-items: center;
    padding: 5px;
    justify-content: space-between;
    margin-top: 5px;
    margin-bottom: 5px;
  }
  #view_notice{
    display: flex;
    flex-direction: column;
    width: 730px;
    padding-left: 0;
  }
  .title{
    width: 350px;
  }
  .title span{
    margin-left: 15px;
  }
  .file_download{
    font-size: 15px;
    padding: 5px;
  }
  .content_line{
    background-color: #dfdfdf;
    margin : 0;
  }
  .red_button{
    border:none;
    background-color: #782f2f;
    color: white;
    height: 40px;
    width: 100px;
    font-family: 'S-CoreDream-3Light';
    margin-right: 20px;
    float: right;
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
  .content{
    padding: 5px;
    margin-top: 5px;
  }
  .buttons{
    display: flex;
    justify-content: flex-end;
    margin-top: 10px;
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
            <li><a href="./notice_list.php" id="li_somenu_notice">공지사항</a></li>
            <li><a href="../event/event_list.php" id="li_somenu">이벤트</a></li>
          </ul>
        </div>
        <div class="notice">
          <h2>공지사항</h2>
          <hr class="title_line">  
<?php
            include('../../db/db_connect.php');

            $num = $page = "";

            if(isset($_GET["num"]) && isset( $_GET["page"])){
              $num  = mysqli_real_escape_string($con, $_GET["num"]);
              $page  = mysqli_real_escape_string($con, $_GET["page"]);


              $sql = "select * from notice where num=$num";
              $result = mysqli_query($con, $sql);
              $row = mysqli_fetch_array($result);

              $id           = $row["id"];
              $name         = $row["name"];
              $regist_day   = $row["regist_day"];
              $subject      = $row["subject"];
              $content      = $row["content"];
              $file_name    = $row["file_name"];
              $file_type    = $row["file_type"];
              $file_copied  = $row["file_copied"];
              $hit          = $row["hit"];

              $content = str_replace(" ", "&nbsp;", $content);
              $content = str_replace("\n", "<br>", $content);

              $new_hit = $hit + 1;
              $sql = "update notice set hit=$new_hit where num=$num";   
              mysqli_query($con, $sql);
            }else{
              echo "
              <script>
                alert('가져올 내용이 없습니다.');
                history.go(-1);
              </script>
            ";
            }  
?>
          
          <div>
            <ul id="view_notice">
              <li class="box">
                <div class="title"><b>제목</b><span><?=$subject?></span></div>
                <div class="etc"><?=$name?> | <?=$regist_day?></div>
              </li>	
              <hr class="content_line">
              <li class="context">     
<?php
                if(isset($file_name) && !empty($file_name)) {
                  $real_name = $file_copied;
                  $file_path = "../../data/".$real_name;
                  $file_size = filesize($file_path);
      
                  echo "<div  class=\"file_download\">▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
                       <a href='notice_download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a></div>";
                  // echo "<div class=\"thumb\"><img src='$file_path'></div><br>";    
                }
?>
                <div class="content">
                 <?=$content?>
                </div>
              </li>	
            </ul>
            <ul class="buttons">
              <li><button type="button" onclick="location.href='notice_list.php'" class="green_button">목록</button></li>
<?php
                 $id = isset($_SESSION['id']) ? $_SESSION['id'] : "";
                if($id == 'admin'){
                  echo "
                  <li class=\"inline\">
                    <form class=\"inline\" action=\"notice_modify_form.php\" method=\"POST\">
                      <button class=\"green_button\">수정</button>
                      <input type=\"hidden\" name=\"num\" value={$num}>
                      <input type=\"hidden\" name=\"page\" value={$page}>
                      <input type=\"hidden\" name=\"mode\" value=\"modify\">
                    </form>
                  </li>
                  <li class=\"inline\">
                    <form class=\"inline\" action=\"notice_dui.php\" method=\"POST\">
                      <button class=\"red_button\">삭제</button>
                      <input type=\"hidden\" name=\"num\" value={$num}>
                      <input type=\"hidden\" name=\"page\" value={$page}>
                      <input type=\"hidden\" name=\"mode\" value=\"delete\">
                    </form>
                  </li>
                  ";
                }
?>
            </ul>
          </div>	    	
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