<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>HWAEUN</title>
  <link href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/img/leaf.png" rel="shortcut icon" type="image/x-icon">
  <link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/css/common.css">
  <link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/css/brand.css">
</head>
<body>
  <header>
    <?php include "./header.php" ?>
  </header>
  <section>
    <div class="main_content">
      <div class="blank"></div>
      <div class="minimap">
        <ul>
          <li><a class="gray" href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/index.php">HOME</a></li>
          <li class="gray">></li>
          <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/brand.php">브랜드 소개</a></li>
        </ul>
      </div>
      <h2>BRAND</h2>
      <hr>
      <div class="center">
        <div>
          <div class="left_img">
            <img class="brand_img" src="../img/brand_intro.png" alt="brand">
          </div>
        </div>
        <div class="brand_box">
          <div class="form">
            <h2>NATURAL & HWAEUN</h2>
            <h3>천연재료로 피부를 안정적이게</h3>
            <h3>적은재료로 피부에 가볍게</h3>
            <h4>필요한 성분들로만 꽉 채워 만들었기에 가벼움과 편안함을 동시에 효과를 느낄 수 있는 화장품을 만드는 곳 화은(HWAEUN)입니다.</h4>
          </div>
        </div>
      </div>
    </div>
  </section>
  <footer>
    <?php include "./footer.php"; ?>
  </footer>
</body>
<script src="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/js/header.js"></script>
</html>