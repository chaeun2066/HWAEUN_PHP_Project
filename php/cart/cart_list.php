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
    margin-right: 100px;
    width: 130px;
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
  #li_somenu_board{
    color: #2b3729;
    font-family: 'S-CoreDream-3Light';
    font-size: 18px;
    width: 150px;
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
  .cart_top{
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
    padding-right: 5px;
  }
  .cart_top h2{
    margin: 0;
  }
  .cart_title{
    display: flex; 
    border-top:2px solid #2b3729;
    border-bottom:1px solid #b0bbac;
    font-size: 16px;
    padding: 5px;
    font-weight: 600;
    background-color: #d7e3d3;
  }
  #cart_list{
    display: flex; 
    flex-direction: column;
    margin: 5px 5px 5px 5px;
    padding-bottom: 3px;
    padding-left: 0;
    min-height: 400px;
  }
  .check{
    width: 60px;
    text-align: center;
  }
  .pic{
    width: 110px;
    text-align: center;
  }
  .type{
    width: 80px;
    text-align: center;
  }
  .name{
    width: 300px;
    text-align: center;
  }
  .price{
    width: 120px;
    text-align: center;
  }
  .count{
    width: 100px;
    text-align: center;
  }
  .red_button{
    margin-top: 20px;
    border:none;
    background-color: #782f2f;
    color: white;
    height: 30px;
    width: 150px;
    font-family: 'S-CoreDream-3Light';
  }
  .green_button{
    margin-top: 20px;
    border:none;
    background-color: #3a4a37;
    color: white;
    height: 30px;
    width: 150px;
    font-family: 'S-CoreDream-3Light';
  }
  .subject{
    padding-top: 10px;
    padding-bottom: 15px;
    display: flex;
    align-items: center;
    border-bottom: 1px solid #dfdfdf;
  }
  .subject a, #page_num a{
    color: var(--normal_font);
  }
  .subject a:hover{
    text-decoration-line: underline;
    text-underline-position : under;
  }
  .calculate{
    font-size: 25px;
    font-weight: 600;
    float:right;
    display: flex;
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
    if(!$id){
      echo("
        <script>
          alert('로그인 후에 장바구니 이용이 가능합니다.');
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
          <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/cart/cart_list.php">장바구니</a></li>
        </ul>
      </div>
      <div class="center">
        <div>
          <ul class="somenu">
            <li><a href="./cart_list.php" id="title_somenu">Cart</a></li>
          </ul>
        </div>
        <div>
          <div class="cart_top">
            <h2>장바구니</h2>
          </div>

          <ul id="cart_list">
            <li class="cart_title">
              <div class="check">선택</div>
              <div class="pic">상품</div>
              <div class="type">종류</div>
              <div class="name">상품명</div>
              <div class="price">가격</div>
              <div class="count">수량</div>
            </li>
<?php
            include("../../db/db_connect.php");

            $sql = "select * from cart where s_id='$id' order by s_num desc";
            $result = mysqli_query($con, $sql);
            $total_record = mysqli_num_rows($result);

            $number = $total_record;

            while($row = mysqli_fetch_array($result)){
              $s_num = $row["s_num"];
              $s_name = $row["s_name"];
              $s_type = $row["s_type"];
              $s_price = $row["s_price"];
              $s_count = $row["s_count"];
              $s_file_name = $row["s_file_name"];
              $s_file_type = $row["s_file_type"];
              $s_file_copied = $row["s_file_copied"];
            
              $image_width = 100;
              $image_height = 100;

              if (!empty($s_file_name)) {
                $image_info = getimagesize("../../data/".$s_file_copied);
                $image_width = $image_info[0];
                $image_height = $image_info[1];
                $image_type = $image_info[2];
                if ($image_width > 100 ) $image_width = 100;
                if ($image_height > 100 ) $image_height = 100;
                $file_copied_0 = $s_file_copied;
              }
?>
              <form method="POST" class="item" action="cart_di.php">
                <input type="hidden" name="mode" value="delete">
                <span class="subject">
                  <div  class="check"><input type="checkbox" name="item[]" value="<?=$s_num?>"></div>
<?php
                  if (strpos($s_file_type,"image") !== false) 
                    echo "<img src='../../data/$file_copied_0' width='$image_width' height='$image_height' class='pic'><br>";
                  else 
                    echo "<img src='../../img/no_photo.png' width='$image_width' height='$image_height' class='pic'><br>";
?>                
                  <div class="type"><?= $s_type ?></div>
                  <div class="name"><?= $s_name ?></div>
                  <div class="price"><?= "&#92;". $s_price ?></div>
                  <div class="count"><?= $s_count."개" ?></div>
                </span>
<?php
              $number--;
            }
            // mysqli_close($con);
?>
              <button type="submit" class="red_button">선택된 상품 삭제</button>
            </form>
          </ul>
          <div class="calculate">
            <p class="cal_title">총 결제 금액 &nbsp;&nbsp; : &nbsp;&nbsp;</p>
<?php
              $calculate = 0;

              $sql = "select * from cart where s_id='$id' order by s_num desc";
              $result = mysqli_query($con, $sql);
              $total_record = mysqli_num_rows($result);

              $number = $total_record;

              while($row = mysqli_fetch_array($result)){
                $s_price = (int)str_replace(',','',$row["s_price"]);
                $s_count = (int)$row['s_count'];            
                
                $calculate += $s_price * $s_count;
                
              }
                mysqli_close($con);
?>
              <p><?=number_format($calculate)?>&nbsp;원</p>
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