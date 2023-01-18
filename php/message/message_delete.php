<?php
    include('../../db/db_connect.php');

    $num = $mode = "";

    if(isset($_GET["num"]) && isset($_GET["mode"])){
      $num = $_GET["num"];
      $mode = $_GET["mode"];
  
      $sql = "delete from message where num=$num";
      mysqli_query($con, $sql);
  
      mysqli_close($con);
  
      if($mode == "send"){
        $url = "message_box.php?mode=send";
      }else{
        $url = "message_box.php?mode=rv";
      }
      echo "
        <script>
          alert('삭제가 완료되었습니다.');
          location.href = '$url';
        </script>
      ";
    }

?>