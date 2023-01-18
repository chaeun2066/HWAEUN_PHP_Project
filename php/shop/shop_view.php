
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
          <?php
            include('../../db/db_connect.php');

            $num = $page = "";

            if(isset($_GET["num"]) && isset( $_GET["page"])){
              $num  = mysqli_real_escape_string($con, $_GET["num"]);
              $page  = mysqli_real_escape_string($con, $_GET["page"]);

              $sql = "select * from shop where s_num=$num";
              $result = mysqli_query($con, $sql);
              $row = mysqli_fetch_array($result);

              $s_name         = $row["s_name"];
              $s_type         = $row["s_type"];
              $s_price        = $row["s_price"];
              $s_content      = $row["s_content"];
              $s_regist_day   = $row["s_regist_day"];
              $s_hit          = $row["s_hit"];
              $s_file_name    = $row["s_file_name"];
              $s_file_type    = $row["s_file_type"];
              $s_file_copied  = $row["s_file_copied"];

              $s_content = str_replace(" ", "&nbsp;", $s_content);
              $s_content = str_replace("\n", "<br>", $s_content);

              $new_hit = $s_hit + 1;
              $sql = "update shop set s_hit=$new_hit where s_num=$num";   
              mysqli_query($con, $sql);
              
              $s_file_name   = $row['s_file_name'];
              $s_file_copied = $row['s_file_copied'];
              $s_file_type   = $row['s_file_type'];
              $s_file_size   = 0;

              if (!empty($s_file_name)) {
                  $image_info = getimagesize("../../data/" . $s_file_copied);
                  $image_width = $image_info[0];
                  $image_height = $image_info[1];
                  $image_type = $image_info[2];
                  $image_width = 400;
                  $image_height = 180;
                  if ($image_width > 400) $image_width = 400;
              }
            }else{
              echo "
              <script>
                alert('가져올 내용이 없습니다.');
                history.go(-1);
              </script>
            ";
            }  
?>  
          <div class="order">
            <div class="product">
              <div class="context">
<?php
                if (strpos($s_file_type, "image") !== false) {
                  $s_file_size = filesize("../../data/" . $s_file_copied);
                  $real_name = $s_file_copied;
                  echo "<img src='../../data/$s_file_copied' width='$image_width' class='s_img'><br>";
                } else if ($s_file_name) {
                  $real_name = $s_file_copied;
                  $s_file_path = "../../data/" . $real_name;
                  $s_file_size = filesize($s_file_path); 
                }
?>
              </div>

              <form name="cart_form" action="../cart/cart_di.php" method="POST">
                <input type="hidden" name="mode" value="insert">
                <input type="hidden" name="s_file_name" value="<?=$s_file_name?>">
                <input type="hidden" name="s_file_type" value="<?=$s_file_type?>">
                <input type="hidden" name="s_file_copied" value="<?=$s_file_copied?>">
                <input type="hidden" name="s_type" value="<?=$s_type?>">
                <input type="hidden" name="s_name" value="<?=$s_name?>">
                <input type="hidden" name="s_price" value="<?=$s_price?>">
                <input type="hidden" name="s_content" value="<?=$s_content?>">
                <ul id="view_shop">
                  <li class="s_type"><?=$s_type?></li>
                  <li class="s_name"><?=$s_name?></li>  
                  <li class="s_price"><?="&#92;".$s_price."원"?></li>	
                  <li class="s_content"><?=$s_content?></li>	
                  <li class="options">
                    수량
                    <select name="s_count" id="select_count">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                  </li>
                  <li class="s_cart"><button class="green_button">장바구니</button></li>
                </ul>
              </form>
            </div>

            <div class="ripple">
              <div id="ripple_comment">
<?php
                $sql ="select * from shop_ripple where parent='$num'";
                $result = mysqli_query($con, $sql);
                $row = mysqli_num_rows($result);
?>  
                리뷰 작성&nbsp;(<?=$row?>)
              </div>
              <div id="ripple_content">
<?php
                $sql = "select * from shop_ripple where parent='$num' ";
                $ripple_result = mysqli_query($con, $sql);

                while ($ripple_row = mysqli_fetch_array($ripple_result)) {
                  $ripple_num = $ripple_row['num'];
                  $ripple_id = $ripple_row['id'];
                  $ripple_nick = $ripple_row['nick'];
                  $ripple_date = $ripple_row['regist_day'];
                  $ripple_content = $ripple_row['content'];
                  $ripple_content = str_replace("\n", "<br>", $ripple_content);
                  $ripple_content = str_replace(" ", "&nbsp;", $ripple_content);
?>
                  <div id="ripple_title">
                    <ul class="ripple_list">
                      <li><?= $ripple_id . "&nbsp;|&nbsp;" . $ripple_date ?></li>
                      <li id="mdi_del">

<?php
                      $id = isset($_SESSION['id'])? $_SESSION['id'] : "";
                      if ($id == "admin" || $id == $ripple_id) {
                          echo '
                        <form style="display:inline" action="shop_dui.php" method="post">
                          <input type="hidden" name="page" value="'.$page.'">
                          <input type="hidden" name="hit" value="' . $s_hit . '">
                          <input type="hidden" name="mode" value="delete_ripple">
                          <input type="hidden" name="num" value="' . $ripple_num . '">
                          <input type="hidden" name="parent" value="' . $num . '">
                          <span class="ripple_content">' .$ripple_content . '</span>
                          <input type="submit" value="X" class="ripple_delete_button">
                        </form>';
                      }else{
                        echo '
                        <form style="display:inline" method="post">
                          <span class="ripple_content">' . $ripple_content . '</span>
                        </form>';
                      }
?>
                        <hr id="ripple_line">
                      </li>
                    </ul>
                  </div>
<?php
                }
                mysqli_close($con);
?>           
<?php
                if($id){
                  echo "
                  <form name=\"ripple_form\" action=\"shop_dui.php\" method=\"post\">
                    <input type=\"hidden\" name=\"mode\" value=\"insert_ripple\">
                    <input type=\"hidden\" name=\"id\" value=\"$id\">
                    <input type=\"hidden\" name=\"name\" value=\"$s_name\">
                    <input type=\"hidden\" name=\"parent\" value=\"$num\">
                    <input type=\"hidden\" name=\"page\" value=\"$page\">
                    <div id=\"ripple_insert\">
                      <div id=\"ripple_textarea\">
                        <textarea name=\"ripple_content\" rows=\"3\" cols=\"80\"></textarea>
                      </div>
                    <div id=\"ripple_button\"><button class=\"ripple_button\">댓글입력</button></div>
                    </div>
                  </form>
                  ";
                }
?>
              </div>
            </div>

            <ul class="buttons">
              <li><button type="button" onclick="location.href='shop_list.php'" class="green_button">목록</button></li>
<?php
                $id = isset($_SESSION['id']) ? $_SESSION['id'] : "";
                if($id == 'admin'){
                  echo "
                  <li class=\"inline\">
                    <form class=\"inline\" action=\"shop_modify_form.php\" method=\"POST\">
                      <button class=\"green_button\">수정</button>
                      <input type=\"hidden\" name=\"id\" value={$id}>
                      <input type=\"hidden\" name=\"num\" value={$num}>
                      <input type=\"hidden\" name=\"hit\" value=\"$s_hit\">
                      <input type=\"hidden\" name=\"page\" value={$page}>
                      <input type=\"hidden\" name=\"mode\" value=\"modify\">
                    </form>
                  </li>
                  <li class=\"inline\">
                    <form class=\"inline\" action=\"shop_dui.php\" method=\"POST\">
                      <button class=\"red_button\">삭제</button>
                      <input type=\"hidden\" name=\"id\" value={$id}>
                      <input type=\"hidden\" name=\"num\" value={$num}>
                      <input type=\"hidden\" name=\"page\" value={$page}>
                      <input type=\"hidden\" name=\"s_name\" value={$s_name}>
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
  #li_somenu_first{
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
  #view_shop{
    display: flex;
    flex-direction: column;
    padding: 30px 5px 30px 5px;
    width: 400px;
  }
  .title{
    width: 300px;
  }
  .title span{
    margin-left: 15px;
  }
  .shop_top{
    border-bottom: 2px solid #3a4a37;
  }
  .shop_top p{
    margin-bottom: 5px;
    font-weight: 600;
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
  .context{
    padding: 10px;
    margin-bottom: 40px;
  }
  .context img{
    text-align: center;
  }
  .content{
    padding: 5px;
    margin-top: 5px;
  }
  .buttons{
    display: flex;
    justify-content: flex-end;
    margin-top: 40px;
  }
  .product{
    display: flex;
  }
  .s_type{
    color: #a2a2a2;
    font-size: 16px;
  }
  .s_name{
    font-size: 25px;
    font-weight: 600;
    margin-top: 20px;
  }
  .s_price{
    font-size: 25px;
    font-weight: 600;
    color: #2b3729;
    margin-top: 30px;
  }
  .s_content{
    margin-top: 20px;
  }
  #ripple_title ul{
    padding:0;
    margin: 5px;
  }
  #ripple_comment{
    margin-bottom: 5px;
    font-weight:600;
  }
  #ripple_insert{
    display: flex;
  }
  #ripple_textarea{
    border: 1px solid #9d9d9d;
    padding: 5px;
    margin-right: 10px;
  }
  #ripple_textarea textarea{
    resize: none;
    border: none;
    background-color: transparent;
    outline: none;
    font-size: 14px;
    font-family: 'S-CoreDream-3Light';
    width: 700px;
  }
  .ripple_button{
    border:none;
    background-color: #3a4a37;
    color: white;
    font-family: 'S-CoreDream-3Light';
    height:73px;
    width: 90px;
  }
  .ripple_delete_button{
    border:none;
    background-color: #782f2f;
    color: white;
    height: 15px;
    width: 15px;
    font-family: 'S-CoreDream-3Light';
    text-align: center;
    font-size: 5px;
    padding:0;
  }
  .ripple_list{
    display: flex;
    flex-direction: column;
  }
  .ripple_list li:nth-child(1){
    font-weight:600;
  }
  #ripple_line{
    margin: 2px auto;
    margin-top: 4px;
  }
  #select_count{
    border: 1px solid #2b3729;
    margin-top: 15px;
    font-size: 18px;
    width: 100px;
    height: 35px;
  }
  .s_count{
    margin-top: 50px;
    display: flex;
    flex-direction: column;
  }
  .s_cart{
    margin-top: 50px;
  }
  .s_cart .green_button{
    float: left;
  }
</style>