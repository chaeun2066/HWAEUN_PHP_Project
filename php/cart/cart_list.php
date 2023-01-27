<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>HWAEUN</title>
  <link href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/img/leaf.png" rel="shortcut icon" type="image/x-icon">
  <link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/css/common.css">
  <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
  <script src="../../js/order_address.js"></script>
  <script src="../../js/buy.js"></script>
  <link rel="stylesheet" href="../../css/cart_list.css">
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
          <p class="deliver_fee">(1500,000원 이상 결제 시, 배송비 무료)</p>
          <div class="calculate">
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
            <div class="cal_product">
              <p class="cal_product_price">주문상품금액&nbsp;&nbsp;<?=number_format($calculate)?>원</p>
            </div>
            <div class="sign">
              <p>+</p>
            </div>
            <div class="cal_deliver">
<?php
              if($calculate >= 150000){
                $total = $calculate + 0;
?>
                <p class="cal_deliver_price">총 배송비 0원</p>
<?php
              }else{
                $total = $calculate + 3000;
?>
                <p class="cal_deliver_price">총 배송비 3,000원</p>
<?php               
              }
?>              
            </div>
            <div class="sign">
              <p>=</p>
            </div>
            <div class="cal_total">
              <p class="cal_total_price">총 주문금액&nbsp;&nbsp;<?=number_format($total)?>원</p>
            </div>
          </div>
          <div class="order">
            <form name="order_form" id="order" method="POST" action="./cart_buy_server.php">
              <div class="order_top">
                <h2>주문자정보</h2>
              </div>
              <div class="form">
                <div class="box">
                  <div class="title">받는 분<span>*</span></div>
                  <div class="input">
                    <input type='text' placeholder='성함' name='name'>
                  </div>
                </div>
              </div>
              <div class="clear"></div>

              <div class="form">
                <div class="box">
                  <div class="title">이메일</div>    
                  <div class='email'>
                    <input type='text' name='email1'>
                  </div> &nbsp;@&nbsp;
                  <div class='email'>
                    <input type='text' name='email2'>
                  </div>
                </div>  
              </div>
              <div class="clear"></div>

              <div class="form">
                <div class="box">
                  <div class="title">연락처<span>*</span></div>    
                  <div class="input">
                    <input type='text' placeholder='-기호 제외 입력' name='phone'>
                  </div>
                </div>  
              </div>
              <div class="clear"></div>

              <div class="form">
                <div class="box">
                  <div class="title">주소<span>*</span></div> 
                  <div>
                    <div class="add">
                      <div class="input_postcode">
                        <input type="text" id="postcode" placeholder="우편번호" name="postcode">
                      </div>  
                      <input type="button" onclick="DaumPostcode()" class="address_button" value="우편번호 찾기"><br>
                    </div>  
                    <div class="clear_add"></div>
                    <div class="add">
                      <div class="input_address">  
                        <input type="text" id="address" placeholder="주소" name="address">
                      </div>
                      <div class="clear_add"></div>
                      <div class="input_address">  
                      <input type="text" id="extraAddress" placeholder="참고항목" name="extraAddress">
                      </div>
                    </div>
                    <div class="clear_add"></div>
                    <div class="add">
                      <div class="input_address">   
                        <input type="text" id="detailAddress" placeholder="상세주소" name="detailAddress">
                      </div>  
                    </div>
                  </div>   
                </div>
              </div>
              <div class="clear"></div>

              <div class="form">
                <div class="box">
                  <div class="title">배송메모</div>
                  <div class="memo_box">
                    <select name="memo" id="meno">
                      <option value="memo1" selected>배송메세지를 선택해주세요</option>
                      <option value="memo2" >부재시 경비(관리)실에 맡겨주세요.</option>
                      <option value="memo3" >부재시 문앞에 놓아주세요.</option>
                      <option value="memo4" >파손의 위험이 있는 상품이 있습니다. 배송시 주의해주세요.</option>
                      <option value="memo5" >배송전에 연락주세요.</option>
                      <option value="memo6" >메세지 직접 입력</option>
                    </select>
                    <div class="input">
                      <input type="text" placeholder="직접 입력" name="memo_write">
                    </div>
                  </div>
                </div>
              </div>

              <div class="form">
                <div class="box">
                  <div class="title">결제수단<span>*</span></div>
                  <input type="radio" name="buy_way" id="radio_random" value="random_bank" checked="checked">무통장입금
                </div>
              </div>
              <hr>
              <div class="buttons">
                <input type="button" class="buy_button" onclick="check_input()" value="결제하기">
              </div>
            </form>
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