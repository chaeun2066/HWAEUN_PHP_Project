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
    margin-bottom: 60px;
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
  #notice{
    width: 740px;
    height: 350px;
  }
  .notice_title, .notice_list{
    display: flex; 
  }
  .notice_title{
    border-bottom: 2px solid #2b3729;
    font-size: 18px;
    padding-bottom: 5px;
    font-weight: 600;
  }
  .notice_list{
    margin: 5px 5px 10px 5px;
    /* border-bottom: 1px solid #dfdfdf; */
  }
  .num{
    width: 60px;
    text-align: center;
  }
  .subject{
    width: 300px;
  }
  .writor{
    width: 100px;
    text-align: center;
  }
  .file{
    width: 50px;
    text-align: center;
    color: #2b3729;
  }
  .file i{
    padding-top: 3px;
  }
  .date{
    width: 180px;
    text-align: center;
  }
  .hit{
    width: 50px;
    text-align: center;
  }
  .subject a{
    color: var(--normal_font);
  }
  .subject a:hover{
    text-decoration-line: underline;
    text-underline-position : under;
  }
  .buttons{
    display: flex;
    justify-content: flex-end;
    margin-top: 10px;
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
  #page_num{	
    text-align: center;
    list-style-type: none;
    display: block;
    padding-left: 0;
  }
  #page_num li{ 
    display: inline;
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
        <div>
          <h2>공지사항</h2>
          <div class="notice_top">
            <p>               </p>
          </div>
          <div>
            <div id="notice">
              <div class="notice_title">
                <div class="num">번호</div>
                <div class="subject">제목</div>
                <div class="writor">글쓴이</div>
                <div class="file">첨부</div>
                <div class="date">등록일</div>
                <div class="hit">조회</div>
              </div>
<?php 
              include('../../db/db_connect.php');

              $page ="";

              if (isset($_GET["page"]) || !empty($_GET["page"])){
                $page = $_GET["page"];
              }else{
                $page = 1;
              }

              $scale = 10;
              $start = ($page - 1) * $scale;

              $sql = "select count(*) from notice order by num desc";
              $result = mysqli_query($con, $sql);
              $row = mysqli_fetch_array($result);
              $total_record = intval($row[0]);
              $total_page = ceil($total_record / $scale);

              $sql = "select * from notice order by num desc limit $start, $scale";

              $result = mysqli_query($con, $sql);

              $number = $total_record - $start;

              while($row = mysqli_fetch_array($result)){
                $num         = $row["num"];
                $id          = $row["id"];
                $name        = $row["name"];
                $subject     = $row["subject"];
                $regist_day  = $row["regist_day"];
                $hit         = $row["hit"];
    
                if ($row["file_name"]){
                  $file_image = "<i class=\"fa-solid fa-floppy-disk\"></i>";
                }else{
                  $file_image = " ";
                }
?>
                <div class="notice_list">
                  <div class="num"><?=$number?></div>
                  <div class="subject"><a href="notice_view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></div>
                  <div class="writor"><?=$name?></div>
                  <div class="file"><?=$file_image?></div>
                  <div class="date"><?=$regist_day?></div>
                  <div class="hit"><?=$hit?></div>
                </div>
<?php
                $number--;
              } 
              mysqli_close($con);  
?>
            </div>

            <ul id="page_num">
<?php
              echo get_paging_third($total_page, $page);
?>
            </ul>
            <ul class="buttons">
              <li><button type="button" onclick="location.href='notice_list.php'" class="green_button">목록</button></li>
<?php
                $id = isset($_SESSION['id']) ? $_SESSION['id'] : "";
                if($id == 'admin'){
                  echo "<li><button onclick=\"location.href='notice_form.php'\" class=\"green_button\">글쓰기</button></li>";
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