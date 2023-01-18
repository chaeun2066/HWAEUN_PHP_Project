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
    margin-right: 170px;
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
  .board_top{
    border-bottom: 2px solid #3a4a37;
  }
  .board_top p{
    margin-bottom: 5px;
    font-weight: 600;
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
  #view_board{
    display: flex;
    flex-direction: column;
    width: 730px;
    height: 350px;
    padding-left: 0;
  }
  .title{
    width: 300px;
  }
  .title span{
    margin-left: 15px;
  }
  .content_line{
    background-color: #dfdfdf;
    margin : 0;
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
    height: 350px;
  }
  .content{
    padding: 5px;
    margin-top: 5px;
  }
  .buttons{
    display: flex;
    justify-content: flex-end;
    margin-top: 10px;
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
          <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/hwaeun/php/board/board_list.php">커뮤니티</a></li>
        </ul>
      </div>
      <div class="center">
        <div>
          <ul class="somenu">
            <li><a href="./board_list.php" id="title_somenu">Community</a></li>
            <li><a href="./board_list.php" id="li_somenu_first">자유게시판</a></li>
            <li><a href="https://www.instagram.com/hwaeun_shop/" id="li_somenu" target='_blank'>인스타 보러가기</a></li>
          </ul>
        </div>
        <div>
          <h2>커뮤니티</h2>
          <div class="board_top">
            <p>자유게시판 작성</p>
          </div>  
<?php
            include('../../db/db_connect.php');

            $num = $page = "";

            if(isset($_GET["num"]) && isset( $_GET["page"])){
              $num  = mysqli_real_escape_string($con, $_GET["num"]);
              $page  = mysqli_real_escape_string($con, $_GET["page"]);


              $sql = "select * from board where num=$num";
              $result = mysqli_query($con, $sql);
              $row = mysqli_fetch_array($result);

              $id           = $row["id"];
              $name         = $row["name"];
              $regist_day   = $row["regist_day"];
              $subject      = $row["subject"];
              $content      = $row["content"];
              $hit          = $row["hit"];

              $content = str_replace(" ", "&nbsp;", $content);
              $content = str_replace("\n", "<br>", $content);

              $new_hit = $hit + 1;
              $sql = "update board set hit=$new_hit where num=$num";   
              mysqli_query($con, $sql);
            }else{
              echo "
              <script>
                alert('가져올 내용이 없습니다.');
                history.go(-1);
              </script>
            ";
            }  
?>
          
          <div>
            <ul id="view_board">
              <li class="box">
                <div class="title"><b>제목</b><span><?=$subject?></span></div>
                <div class="etc"><?=$name?> | <?=$regist_day?></div>
              </li>	
              <hr class="content_line">
              <li class="content">     
                 <?=$content?>
              </li>	
            </ul>

            <div class="ripple">
              <div id="ripple_comment">
<?php
                $sql ="select * from board_ripple where parent='$num'";
                $result = mysqli_query($con, $sql);
                $row = mysqli_num_rows($result);
?>  
                댓글&nbsp;(<?=$row?>)
              </div>
              <div id="ripple_content">
<?php
                $sql = "select * from board_ripple where parent='$num' ";
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
                        <form style="display:inline" action="board_dui.php" method="post">
                          <input type="hidden" name="page" value="'.$page.'">
                          <input type="hidden" name="hit" value="' . $hit . '">
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
                  <form name=\"ripple_form\" action=\"board_dui.php\" method=\"post\">
                    <input type=\"hidden\" name=\"mode\" value=\"insert_ripple\">
                    <input type=\"hidden\" name=\"id\" value=\"$id\">
                    <input type=\"hidden\" name=\"parent\" value=\"$num\">
                    <input type=\"hidden\" name=\"hit\" value=\"$hit\">
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
                <!-- <form name="ripple_form" action="board_dui.php" method="post">
                  <input type="hidden" name="mode" value="insert_ripple">
                  <input type="hidden" name="id" value="< ?= $id ?>">
                  <input type="hidden" name="parent" value="< ?= $num ?>">
                  <input type="hidden" name="hit" value="< ?= $hit ?>">
                  <input type="hidden" name="page" value="< ?= $page ?>">
                  <div id="ripple_insert">
                    <div id="ripple_textarea">
                      <textarea name="ripple_content" rows="3" cols="80"></textarea>
                    </div>
                    <div id="ripple_button"><button class="ripple_button">댓글입력</button></div>
                  </div>
                </form> -->

              </div>
            </div>

            <ul class="buttons">
              <li><button type="button" onclick="location.href='board_list.php'" class="green_button">목록</button></li>
              <li class="inline">
                <form class="inline" action="board_modify_form.php" method="POST">
                  <button class="green_button">수정</button>
                  <input type="hidden" name="num" value=<?=$num?>>
                  <input type="hidden" name="page" value=<?=$page?>>
                  <input type="hidden" name="mode" value="modify">
                </form>
              </li>
              <li class="inline">
                <form class="inline" action="board_dui.php" method="POST">
                  <button class="red_button">삭제</button>
                  <input type="hidden" name="num" value=<?=$num?>>
                  <input type="hidden" name="page" value=<?=$page?>>
                  <input type="hidden" name="mode" value="delete">
                </form>
              </li>
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