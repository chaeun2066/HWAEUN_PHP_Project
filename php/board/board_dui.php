<?php
  session_start();
  $id = (isset($_SESSION['id']))? $_SESSION['id'] : "";
  $name = (isset($_SESSION['name']))? $_SESSION['name'] : "";

  if(!$id){
    header("location: ../index.php");
    exit();
  }

  include("../../db/db_connect.php");

  $mode = $_POST['mode'];

  switch($mode){
    case "delete":
      if(isset($_POST["num"]) && isset($_POST["page"])){
        $num =  mysqli_real_escape_string($con, $_POST["num"]);
        $page =  mysqli_real_escape_string($con, $_POST["page"]);
    
        $sql = "select * from board where num = $num";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
    
        $sql = "delete from board where num = $num";
        mysqli_query($con, $sql);
        mysqli_close($con);
    
        echo "
            <script>
            location.href = 'board_list.php?page=$page';
            </script>
          ";
      }
      break;
    case "insert":
      if(!isset($id) || empty($id)){
        echo("
          <script>
            alert('자유게시판은 로그인 후 이용해 주세요!');
            history.go(-1)
          </script>
        ");
        exit;
      }

      $subject = $content = "";

      if(isset($_POST["subject"]) && isset($_POST["content"])){
        $subject = $_POST["subject"];
        $content = $_POST["content"];

        $subject = htmlspecialchars($subject, ENT_QUOTES);
        $content = htmlspecialchars($content, ENT_QUOTES);  
    
        $regist_day = date("Y-m-d [H:i]");

        $sql = "insert into board (id, name, subject, content, regist_day, hit)";
        $sql .= "values('$id', '$name', '$subject', '$content', '$regist_day', 0)";
        mysqli_query($con, $sql);

        $sql = "select * from board where id='$id'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_num_rows($result);
      
        if(mysqli_num_rows($result) > 0){
          $point_up = 100;
      
          $sql = "select point from customer where id='$id'";
          $result = mysqli_query($con, $sql);
          $row = mysqli_fetch_array($result);
          
          $new_point = $row["point"] + $point_up;
      
          $sql = "update customer set point=$new_point where id='$id'";
          mysqli_query($con, $sql);
      
          mysqli_close($con);
      
          echo "
            <script>
              location.href = 'board_list.php';
            </script>
          ";
        }else{
          echo "
            <script>
              alert('정상적인 삽입이 아닙니다');
              history.go(-1);
            </script>
          ";
        }
      }
      break;
    case "modify":
      $num = $_POST["num"];
      $page = $_POST["page"];
      $subject = $_POST["subject"];
      $content = $_POST["content"];

      $sql = "select * from board where num = $num";
      $result = mysqli_query($con, $sql);
    
      if(mysqli_num_rows($result) > 0){
        $sql = "update board set subject='$subject', content='$content' where num='$num' ";
        mysqli_query($con, $sql); 
      }

      echo "
        <script>
            location.href = 'board_list.php?page=$page';
        </script>
      ";
      break;
    case "insert_ripple":
      if (empty($_POST["ripple_content"])) {
        echo "<script>
          alert('내용입력요망!');
          history.go(-1);
        </script>";
        exit;
      }
      $q_userid = mysqli_real_escape_string($con, $id);
      $sql = "select * from customer where id = '$q_userid'";
      $result = mysqli_query($con, $sql);
      if (!$result) {
          die('Error: ' . mysqli_error($con));
      }
      $rowcount = mysqli_num_rows($result);
  
      if (!$rowcount) {
          echo "<script>
            alert('없는 아이디!!');
            history.go(-1);
          </script>";
          exit;
      } else {
          $content = input_set($_POST["ripple_content"]);
          $page = input_set($_POST["page"]);
          $parent = input_set($_POST["parent"]);
          $hit = input_set($_POST["hit"]);
          $q_usernick = isset($_SESSION['nick']) ? mysqli_real_escape_string($con, $_SESSION['nick']) : null;
          $q_username = mysqli_real_escape_string($con, $_SESSION['name']);
          $q_content = mysqli_real_escape_string($con, $content);
          $q_parent = mysqli_real_escape_string($con, $parent);
          $regist_day = date("Y-m-d [H:i]");
  
          $sql = "INSERT INTO `board_ripple` VALUES (null,'$q_parent','$q_userid','$q_username', '$q_usernick','$q_content','$regist_day')";
          $result = mysqli_query($con, $sql);
          if (!$result) {
              die('Error: ' . mysqli_error($con));
          }
          mysqli_close($con);
          echo "
          <script>
            location.href='./board_view.php?num=$parent&page=$page&hit=$hit';
          </script>
          ";
      }
      break;
    case "delete_ripple":
      $page = input_set($_POST["page"]);
      $hit = input_set($_POST["hit"]);
      $num = input_set($_POST["num"]);
      $parent = input_set($_POST["parent"]);
      $q_num = mysqli_real_escape_string($con, $num);

      $sql = "DELETE FROM `board_ripple` WHERE num=$q_num";
      $result = mysqli_query($con, $sql);
      if (!$result) {
          die('Error: ' . mysqli_error($con));
      }
      mysqli_close($con);
      echo "
      <script>
        location.href='./board_view.php?num=$parent&page=$page&hit=$hit';</script>";
      break;
  }
?>