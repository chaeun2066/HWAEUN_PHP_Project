<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>HWAEUN</title>
  <link href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/img/leaf.png" rel="shortcut icon" type="image/x-icon">
  <link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/css/common.css">
  <script>
    function check_input(){
      if (!document.shop_form.s_name.value){
          header("location: shop_form.php?error=제품명을 입력하세요.");
          document.shop_form.s_name.focus();
          return;
      }
      if (!document.shop_form.s_type.value){
          header("location: shop_form.php?error=타입을 입력하세요.");
          document.shop_form.s_type.focus();
          return;
      }
      if (!document.shop_form.s_price.value){
          header("location: shop_form.php?error=가격을 입력하세요.");
          document.shop_form.s_price.focus();
          return;
      }
      if (!document.shop_form.s_content.value){
        header("location: shop_form.php?error=내용을 입력하세요.");
          document.shop_form.s_content.focus();
          return;
      }
      document.shop_form.submit();
    }
  </script>
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
            <p>상품등록</p>
            <?php
              if(isset($_GET['error'])){
                echo "<p class='error'>{$_GET['error']}</p>";
              }
            ?>
          </div>
          <form  name="shop_form" method="post" action="shop_dui.php" enctype="multipart/form-data">
          <input type="hidden" name="mode" value="insert">
          <input type="hidden" name="id" value="<?=$id?>">
          <div>
            <ul id="shop_form">
              <li class="box">
                <div class="title">제품명</div>
                <div class="input"><input name="s_name" type="text"></div>
              </li>	
              <li  class="box">
                <div class="title">종류</div>
                <div class="input"><input name="s_type" type="text"></div>
              </li>	
              <li  class="box">
                <div class="title">가격</div>
                <div class="input"><input name="s_price" type="text"></div>
              </li>	
              <li class="box">	
                <div class="title">제품소개</div>
                <div class="input_content">
                  <textarea name="s_content"></textarea>
                </div>
              </li>
              <li class="box">
                <div class="title">첨부 파일</div>
                <div class="input"><input name="s_upfile" type="file"></div>
              </li>	    	
            </ul>
            <ul class="buttons">
              <li><button type="button" onclick="check_input()" class="green_button">완료</button></li>
              <li><button type="button" onclick="location.href='shop_list.php'" class="green_button">목록</button></li>
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
  .shop_top{
    border-bottom: 2px solid #3a4a37;
  }
  .shop_top p{
    margin-bottom: 5px;
    font-weight: 600;
  }
  #shop_form{
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