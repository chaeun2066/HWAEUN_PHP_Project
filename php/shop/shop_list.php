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
    margin-right: 160px;
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
  .shop_top{
    border-bottom: 2px solid #3a4a37;
  }
  .shop_top p{
    margin-bottom: 5px;
    font-weight: 600;
  }
  #shop_list{
    display: flex;
    padding-left: 0;
    width: 810px;
  }
  .buttons{
    display: flex;
    justify-content: flex-end;
  }
  .subject a, #page_num a{
    color: var(--normal_font);
  }
  .subject a:hover{
    text-decoration-line: underline;
    text-underline-position : under;
  }
  .item{
    margin:10px;
  }
  #page_num{	
    margin-top: 20px;
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
          <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/shop/shop_list.php">상품</a></li>
        </ul>
      </div>
      <div class="center">
        <div>
          <ul class="somenu">
            <li><a href="./shop_list.php" id="title_somenu">Shop</a></li>
            <li><a href="./shop_list.php" id="li_somenu_first">상품보기</a></li>
          </ul>
        </div>
        <div>
          <h2>상품</h2>
          <div class="shop_top">
            <p>             </p>
          </div>

          <ul id="shop_list">
<?php
            include("../../db/db_connect.php");

            if (isset($_GET["page"])){
		          $page = $_GET["page"];
            }else{
		          $page = 1;
            }

            $sql = "select count(*) from shop order by s_num desc";
            $result = mysqli_query($con, $sql);
            $row    = mysqli_fetch_array($result);
            $total_record = intval($row[0]);
            
            $scale = 3;
            $total_page = ceil($total_record / $scale);
            
            $start = ($page - 1) * $scale;      
            $number = $total_record - $start;

            $list = array(); 

            $sql = "select * from shop order by s_num desc LIMIT $start, $scale";
            $result = mysqli_query($con, $sql);
            $i = 0;

            while($row = mysqli_fetch_array($result)){
              $list[$i]["s_num"] = $row["s_num"];
              $list[$i] = $row; 
              $list_num = $total_record - ($page - 1) * $scale; 
              $list[$i]['no'] = $list_num -$i;
              $i++;
            }

            $image_width = 300;
            $image_height = 250;

            for($i=0; $i< count($list); $i++){
              $file_image = (!empty($list[$i]['s_file_name']))?"<i class=\"fa-solid fa-floppy-disk\"></i>" :" ";
              $date = substr($list[$i]['s_regist_day'], 0, 10);
          
              if (!empty($list[$i]['s_file_name'])) {
                $image_info = getimagesize("../../data/".$list[$i]['s_file_copied']);
                $image_width = $image_info[0];
                $image_height = $image_info[1];
                $image_type = $image_info[2];
                if ($image_width > 250 ) $image_width = 250;
                if ($image_height > 300 ) $image_height = 300;
                $file_copied_0 = $list[$i]['s_file_copied'];
              }
?>
              <li class="item">
                <span class="subject">
                  <a href="shop_view.php?num=<?= $list[$i]['s_num'] ?>&page=<?= $page ?>">
<?php
                  if (strpos($list[$i]['s_file_type'],"image") !== false) 
                    echo "<img src='../../data/$file_copied_0' width='$image_width' height='$image_height'><br>";
                  else 
                    echo "<img src='../../img/no_photo.png' width='$image_height' height='$image_width'><br>";
?>                
                  <?= $list[$i]['s_type'] ?><br>
                  <?= $list[$i]['s_name'] ?></a><br>
                  <?= "&#92;".$list[$i]['s_price']."원" ?><br>
                  <!-- < ?= $list[$i]['s_content'] ?></a><br> -->
                  <!-- < ?= $date ?> -->
                </span>
              </li>
<?php
            }
            mysqli_close($con);
?>
          </ul>

          <ul id="page_num">
<?php
            $url = "shop_list.php?page=1";
            echo get_paging(3, $page, $total_page, $url);
?>
          </ul>
          <ul class="buttons">
            <li><button onclick="location.href='shop_list.php'" class="green_button">목록</button></li>
            <li>
<?php 
            $id = isset($_SESSION['id']) ? $_SESSION['id'] : "";
            if($id == 'admin'){
              echo "<li><button onclick=\"location.href='shop_form.php'\" class=\"green_button\">상품등록</button></li>";
            }
?>
            </li>
          </ul>  
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