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
    margin-right: 170px;
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
  .board_top{
    border-bottom: 2px solid #3a4a37;
  }
  .board_top p{
    margin-bottom: 5px;
    font-weight: 600;
  }
  #board{
    display: flex;
    flex-direction: column;
    padding-left: 0;
    width: 740px;
    /* height: 300px; */
  }
  .board_title, .board_list{
    display: flex; 
  }
  .board_title{
    border-bottom: 2px solid #2b3729;
    font-size: 18px;
    padding: 5px;
    font-weight: 600;
  }
  .board_list{
    margin: 5px 5px 10px 5px;
    /* border-bottom: 1px solid #dfdfdf; */
  }
  .num{
    width: 80px;
    text-align: center;
  }
  .subject{
    width: 300px;
  }
  .writor{
    width: 100px;
    text-align: center;
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
  #page_num a{
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
    margin-top : 20px;
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
          <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/board/board_list.php">커뮤니티</a></li>
        </ul>
      </div>
      <div class="center">
        <div>
          <ul class="somenu">
            <li><a href="./board_list.php" id="title_somenu">Community</a></li>
            <li><a href="./board_list.php" id="li_somenu_first">자유게시판</a></li>
            <li><a href="https://www.instagram.com/hwaeun_shop/" id="li_somenu"  target='_blank'>인스타 보러가기</a></li>
          </ul>
        </div>
        <div>
          <h2>커뮤니티</h2>
          <div class="board_top">
            <p>자유게시판</p>
          </div>
          <div>
            <div id="board">
              <div class="board_title">
                <div class="num">번호</div>
                <div class="subject">제목</div>
                <div class="writor">글쓴이</div>
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

              $sql = "select count(*) from board order by num desc";
              $result = mysqli_query($con, $sql);
              $row = mysqli_fetch_array($result);
              $total_record = intval($row[0]);
              $total_page = ceil($total_record / $scale);

              $sql = "select * from board order by num desc limit $start, $scale";

              $result = mysqli_query($con, $sql);

              $number = $total_record - $start;

              while($row = mysqli_fetch_array($result)){
                $num         = $row["num"];
                $id          = $row["id"];
                $name        = $row["name"];
                $subject     = $row["subject"];
                $regist_day  = $row["regist_day"];
                $hit         = $row["hit"];
?>
                <div class="board_list">
                  <div class="num"><?=$number?></div>
                  <div class="subject"><a href="board_view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></div>
                  <div class="writor"><?=$name?></div>
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
              $url = "board_list.php?page=1";
              echo get_paging(10, $page, $total_page, $url);
?>
            </ul>
            <ul class="buttons">
              <li><button type="button" onclick="location.href='board_list.php'" class="green_button">목록</button></li>
              <li><button onclick="location.href='board_form.php'" class="green_button">글쓰기</button></li>
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