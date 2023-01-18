<link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/css/header.css">
<?php
  session_start();

  $id = $name = $level = $point = "";

  if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
  }else{
    $id = "";
  }

  if(isset($_SESSION['name'])){
    $name = $_SESSION['name'];
  }else{
    $name = "";
  }

  if(isset($_SESSION['level'])){
    $level = $_SESSION['level'];
  }else{
    $level = "";
  }

  if(isset($_SESSION['point'])){
    $point = $_SESSION['point'];
  }else{
    $point = "";
  }
?>
<div class="top">
  <div class="logo">
    <h1>
      <a href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/index.php">H W A E U N</a>
    </h1>
  </div>
  <div class="header_menu">
    <div class="user_menu">
      <ul>
      <?php
        if(!$id){
      ?>
          <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/login/login_form.php" id="login">LOGIN</a></li>
          <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/register/customer_form.php" id="join">JOIN</a></li>
        
<?php
        }else{
          $logged = $name."님 어서오세요!"
?>
          <li><?=$logged?></li>
          <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/login/logout_server.php" id="logout">LOGOUT</a></li>
          <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/modify/customer_modify_form.php" id="mypage">MY PAGE</a></li>  <!--  -->
          <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/message/message_form.php" id="message">MESSAGE</a></li>
<?php
        }
?>        
<?php
        if($level == 1){
?>
          <li>|</li>
          <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/admin/admin_customer.php" id="admin">ADMIN</a></li>
<?php
        }
?>
        </ul>
    </div>  
    
    <div class="menu_bar">
      <ul>
        <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/brand.php" id="brand">Brand</a></li>
        <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/shop/shop_list.php" id="shop">Shop</a></li>
        <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/board/board_list.php" id="community">Community</a></li>
        <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/notice/notice_list.php" id="notice">Notice</a></li>
        <li><a href="#"><img src= "http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/img/search.png" alt="검색" id="search"></a></li>
        <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/cart/cart_list.php"><img src="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/img/cart.png" alt="장바구니" id="cart"></a></li>
      </ul>
    </div>
  </div>
</div>

