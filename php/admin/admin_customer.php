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
    width: 90px;
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
  #li_somenu_customer{
    color: #2b3729;
    font-family: 'S-CoreDream-3Light';
    font-size: 18px;
  }
  .admin_customer_top{
  border-bottom: 2px solid #3a4a37;
  }
  .admin_customer_top p{
    margin-bottom: 5px;
    font-weight: 600;
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
  #admin{
    width: 740px;
  }
  .admin_title, .admin_list{
    display: flex; 
  }
  .admin_title{
    border-bottom:1px solid #b0bbac;
    font-size: 16px;
    padding: 5px;
    font-weight: 600;
    background-color: #d7e3d3;
  }
  .admin_list{
    margin: 5px 5px 5px 5px;
    border-bottom: 1px solid #dfdfdf;
    padding-bottom: 3px;
  }
  .num{
    width: 80px;
    text-align: center;
  }
  .id{
    width: 80px;
    text-align: center;
  }
  .name{
    width: 100px;
    text-align: center;
  }
  .level{
    width: 50px;
    text-align: center;
  }
  .level input{
    font-family: 'S-CoreDream-3Light';
    font-size: 15px;
    width: 30px;
    text-align: center;
    margin: 0;
    border: none;
    background-color: #dfdfdf;
    outline: none;
  }
  .point{
    width: 80px;
    text-align: center;
  }
  .point input{
    font-family: 'S-CoreDream-3Light';
    font-size: 15px;
    width: 80px;
    text-align: center;
    margin: 0;
    border: none;
    background-color: #dfdfdf;
    outline: none;
  }
  .regist_day{
    width: 180px;
    text-align: center;
  }
  .modify{
    width: 100px;
    text-align: center;
  }
  .delete{
    width: 100px;
    text-align: center;
  }
  .red_button{
    border:none;
    background-color: #782f2f;
    color: white;
    height: 30px;
    width: 60px;
    font-family: 'S-CoreDream-3Light';
  }
  .green_button{
    border:none;
    background-color: #3a4a37;
    color: white;
    height: 30px;
    width: 60px;
    font-family: 'S-CoreDream-3Light';
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
          <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/admin/admin_customer.php">관리자</a></li>
        </ul>
      </div>
      <div class="center">
        <div>
          <ul class="somenu">
            <li><a href="./admin_customer.php" id="title_somenu">Admin</a></li>
            <li><a href="./admin_customer.php" id="li_somenu_customer">회원관리</a></li>
            <li><a href="./admin_board.php" id="li_somenu">게시글관리</a></li>
          </ul>
        </div>
        <div>
          <h2>관리자 페이지</h2>
          <div class="admin_customer_top">
            <p>회원관리</p>
          </div>
          <div>
            <div id="admin">
              <div class="admin_title">
                <div class="num">번호</div>
                <div class="id">아이디</div>
                <div class="name">이름</div>
                <div class="level">레벨</div>
                <div class="point">포인트</div>
                <div class="regist_day">가입일</div>
                <div class="modify">수정</div>
                <div class="delete">삭제</div>
              </div>
<?php
              include('../../db/db_connect.php');

              $sql = "select * from customer order by num desc";
              $result = mysqli_query($con, $sql);
              $total_record = mysqli_num_rows($result);

              $number = $total_record;

              while ($row = mysqli_fetch_array($result)){
                $num         = $row["num"];
                $id          = $row["id"];
                $name        = $row["name"];
                $level       = $row["level"];
                $point       = $row["point"];
                $regist_day  = $row["regist_day"];
?>
              <form method="POST" class="admin_list" action="admin_dui.php?mode=update">
                <input type="hidden" name="num" value="<?=$num?>">
                <div class="num"><?=$number?></div>
                <div class="id"><?=$id?></div>
                <div class="name"><?=$name?></div>
                <div class="level"><input type="text" name="level" value="<?=$level?>"></div>
                <div class="point"><input type="text" name="point" value="<?=$point?>"></div>
                <div class="regist_day"><?=$regist_day?></div>
                <div class="modify"><button type="submit" class="green_button">수정</button></div>
                <div class="delete"><button type="button" class="red_button" onclick="location.href='admin_dui.php?mode=delete&num=<?=$num?>'">삭제</button></div>
              </form>  
<?php
              $number--;
            }
            mysqli_close($con);
?>
            </div>
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