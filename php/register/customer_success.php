<style>
  @font-face {
    font-family: 'YUniverse-B';
    src: url('https://cdn.jsdelivr.net/gh/projectnoonnu/noonfonts_yuniverse@1.0/YUniverse-B.woff2') format('woff2');
    font-weight: normal;
    font-style: normal;
  } 
  @font-face {
    font-family: 'S-CoreDream-3Light';
    src: url('https://cdn.jsdelivr.net/gh/projectnoonnu/noonfonts_six@1.2/S-CoreDream-3Light.woff') format('woff');
    font-weight: normal;
    font-style: normal;
  }
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
  .join_top{
    border-bottom: 2px solid #3a4a37;
  }
  #login_somenu{
  color: rgb(200, 200, 200);
  }
  #join_somenu{
    color: #2b3729;
  }
  .somenu{
    font-family: 'YUniverse-B';
    display: flex;
    flex-direction: column;
    color: #2b3729;
    font-size: 23px;
    margin-top: 20px;
    margin-right: 150px;
  }
  .somenu li{
    margin-top: 5px;
  }
  #login_somenu{
    color: rgb(200, 200, 200);
  }
  #login_somenu:hover{
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
    width: 200px;
    font-family: 'S-CoreDream-3Light';
    margin-left: 300px;
  }
  .success_cong{
    background-color: #e9e9e9;
    width: 800px;
    height: 150px;
    margin-bottom: 30px;
    text-align: center;
  }
  .join_cong1{
    padding-top:30px;
    font-size: 20px;
  }
  .join_cong2{
    font-size: 25px;
  }
  /** 폭죽 - 라이브러리 사용 */
  .char, .word {
	 display: inline-block;
  }
  .splitting .char {
    animation: slide-in 1s cubic-bezier(0.17, 0.84, 0.4, 1.49) both;
    animation-delay: calc(30ms * var(--char-index));
  }
  [data-word="♬"] .char {
    display: inline;
  }

  @keyframes slide-in {
    0% {
      transform: scale(2) rotate(60deg);
      opacity: 0;
    }
  }
  @keyframes bump-in {
    0% {
      transform: scale(0);
      opacity: 0;
    }
  }
  particule {
    position: absolute;
    top: 0;
    left: 0;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    box-shadow: 1px 1px 4px #eb6383;
  }
  
</style>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>HWAEUN</title>
  <link href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/img/leaf.png" rel="shortcut icon" type="image/x-icon">
  <script src="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/js/header.js"></script>
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
          <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/register/customer_form.php">회원가입</a></li>
        </ul>
      </div>
      <div class="center">
        <div>
          <ul class="somenu">
            <li><a href="../login/login_form.php" id="login_somenu">LOGIN</a></li>
            <li><a href="./customer_form.php" id="join_somenu">JOIN</a></li>
          </ul>
        </div>
        <div class="success_box">
          <h2>회원가입</h2>
          <div class="join_top">
            <p>회원가입 완료</p>
          </div>
          <div class="success_cong">
            <p class="join_cong1"><?=$_GET['name']?>님,</p>
            <span class="join_cong2">가입을 축하드립니다! <img src="../../img/leaf.png" width="23px" height="23px" alt="leaf"></span> 
          </div>
          <input type="button" class="green_button" value="홈으로" onclick="location.href='../index.php'">
        </div>
      </div>
    </div>
  </section>
  <footer>
    <?php include "../footer.php"; ?>
  </footer>
</body>
</html>
<script>
  console.clear();

  let particles = [];
  const colors = ["#7ac968","#4c703c","#ffe9c5","#d5ec72"];
  function pop () {
    for (let i = 0; i < 150; i++) {
      const p = document.createElement('particule');
      p.x = window.innerWidth * 0.5;
      p.y = window.innerHeight + (Math.random() * window.innerHeight * 0.3);
      p.vel = {
        x: (Math.random() - 0.5) * 10,
        y: Math.random() * -20 - 15
      };
      p.mass = Math.random() * 0.2 + 0.8;
      particles.push(p);
      p.style.transform = `translate(${p.x}px, ${p.y}px)`;
      const size = Math.random() * 15 + 5;
      p.style.width = size + 'px';
      p.style.height = size + 'px';
      p.style.background = colors[Math.floor(Math.random()*colors.length)];
      document.body.appendChild(p);
    }
  }

  function render () {
    for (let i = particles.length - 1; i--; i > -1) {
      const p = particles[i];
      p.style.transform = `translate3d(${p.x}px, ${p.y}px, 1px)`;
      
      p.x += p.vel.x;
      p.y += p.vel.y;
      
      p.vel.y += (0.5 * p.mass);
      if (p.y > (window.innerHeight * 2)) {
        p.remove();
        particles.splice(i, 1);
      }
    }
    requestAnimationFrame(render);
  }
  pop();
  window.setTimeout(render, 700);
  window.addEventListener('onload', pop);
</script>