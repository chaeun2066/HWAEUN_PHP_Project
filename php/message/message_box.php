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
  #message{
    width: 750px;
    height: 300px;
  }
  .message_title, .message_list{
    display: flex; 
  }
  .message_title{
    border-bottom: 2px solid #2b3729;
    font-size: 18px;
    padding-bottom: 5px;
    font-weight: 600;
  }
  .num{
    width: 100px;
    text-align: center;
  }
  .subject{
    width: 300px;
  }
  .role{
    width: 150px;
    text-align: center;
  }
  .date{
    width: 200px;
    text-align: center;
  }
  .message_list{
    margin: 5px 5px 10px 5px;
  }
  .subject a{
    color: var(--normal_font);
  }
  .subject a:hover{
    text-decoration-line: underline;
    text-underline-position : under;
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
          <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/message/message_box.php">메세지</a></li>
        </ul>
      </div>
      <div class="center">
        <div>
          <ul class="somenu">
            <li><a href="./message_box.php" id="title_somenu">MESSAGE</a></li>
            <li><a href="./message_form.php" id="li_somenu_msg">쪽지보내기</a></li>
            <li><a href="./message_box.php?mode=rv" id="li_somenu_rv">수신쪽지함</a></li>
            <li><a href="./message_box.php?mode=send" id="li_somenu_send">송신쪽지함</a></li>
          </ul>
        </div>
        <div>
          <h2>
<?php
            $page = $mode ="";

            if(isset($_GET['page']) || !empty($_GET['page'])){
              $page = $_GET['page'];
            }else{
              $page = 1;
            }

            $scale = 10;
            $start = ($page - 1) * $scale;

            if(isset($_GET["mode"]) || !empty($_GET["mode"])){
              $mode = $_GET["mode"];
  
              if($mode == "send"){
                echo "송신 쪽지함";
              }else{
                echo "수신 쪽지함 ";
              }
            }
?>
          </h2>
          <div id="message">
            <div class="message_title">
              <div class="num">번호</div>
              <div class="subject">제목</div>
              <div class="role">
<?php
                if ($mode=="send"){
                  echo "수신자";
                }else{
                  echo "송신자";
                }  
?>
              </div>
              <div class="date">날짜</div>
            </div>
<?php
            include('../../db/db_connect.php');

            if($mode == "send"){
              $sql = "select count(*) from message where send_id='$id' order by num desc";
            }else{
              $sql = "select count(*) from message where rv_id='$id' order by num desc";
            }

            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($result);
            $total_record = intval($row[0]);
            $total_page = ceil($total_record / $scale);

            if($mode == "send"){
              $sql = "select * from message where send_id='$id' order by num desc limit $start, $scale";
            }else{
              $sql = "select * from message where rv_id='$id' order by num desc limit $start, $scale";
            }

            $result = mysqli_query($con, $sql);

            $number = $total_record - $start;

            while($row =  mysqli_fetch_array($result)){
              $num = $row['num'];
              $subject = $row['subject'];
              $regist_day = $row['regist_day'];

              if($mode == "send"){
                $msg_id = $row['rv_id'];
              }else{
                $msg_id = $row['send_id'];
              }

              $result2 = mysqli_query($con, "select name from customer where id='$msg_id'");
              $record = mysqli_fetch_array($result2);
              $msg_name = $record['name'];
?>

              <div class="message_list">
                <div class="num"><?=$number?></div>
                <div class="subject"><a href="message_view.php?mode=<?=$mode?>&num=<?=$num?>"><?=$subject?></a></div>
                <div class="role"><?=$msg_name?>(<?=$msg_id?>)</div>
                <div class="date"><?=$regist_day?></div>
              </div>
<?php
              $number--;
            }
            mysqli_close($con);
?>
          </div>

          <ul id="page_num">
<?php
            $url = "message_box.php?mode=".$mode."&page=1";
            echo get_paging_first(5, $page, $total_page, $url);
?>
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
<?php
  if($mode == 'rv'){
    echo "
      <style>
        #li_somenu_msg{
          color: rgb(200, 200, 200);
          font-family: 'S-CoreDream-3Light';
          font-size: 16px;
        }
        #li_somenu_send{
          color: rgb(200, 200, 200);
          font-family: 'S-CoreDream-3Light';
          font-size: 16px;
        }
        #li_somenu_rv{
          color: #2b3729;
          font-family: 'S-CoreDream-3Light';
          font-size: 18px;
        }
      </style>";
  }else{
    echo "
      <style>
        #li_somenu_msg{
          color: rgb(200, 200, 200);
          font-family: 'S-CoreDream-3Light';
          font-size: 16px;
        }
        #li_somenu_send{
          color: #2b3729;
          font-family: 'S-CoreDream-3Light';
          font-size: 18px;
        }
        #li_somenu_rv{
          color: rgb(200, 200, 200);
          font-family: 'S-CoreDream-3Light';
          font-size: 16px;
        }
      </style>";
  }
?>
</html>