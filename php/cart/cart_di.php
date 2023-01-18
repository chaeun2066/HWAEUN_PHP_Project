<?php
  session_start();
    if (isset($_SESSION["id"])) $id = $_SESSION["id"];
  else $id = "";
    if (isset($_SESSION["name"])) $name = $_SESSION["name"];
  else $name = "";

  include('../../db/db_connect.php');

  if (!$id){
    echo("
      <script>
        alert('로그인 후 이용이 가능합니다.');
        history.go(-1)
      </script>
    ");
    exit;
	}

  $mode = $_POST['mode'];

  switch($mode){
    case "insert":
      $s_name = $_POST['s_name'];
      $s_type = $_POST['s_type'];
      $s_price = $_POST['s_price'];
      $s_content = $_POST['s_content'];
      $s_count = $_POST['s_count'];
      $s_file_name = $_POST['s_file_name'];
      $s_file_type = $_POST['s_file_type'];
      $s_file_copied = $_POST['s_file_copied'];

      $s_content = htmlspecialchars($s_content, ENT_QUOTES);
      $s_regist_day = date("Y-m-d [H:i]");

      $sql = "insert into cart (s_id, s_name, s_type, s_price, s_content, s_count, s_regist_day, s_file_name, s_file_type, s_file_copied) ";
      $sql .= "values('$id', '$s_name', '$s_type', '$s_price', '$s_content', '$s_count', '$s_regist_day','$s_file_name', '$s_file_type', '$s_file_copied')";
      mysqli_query($con, $sql);

      mysqli_close($con);           

      echo "
        <script>
          if(!confirm('장바구니로 이동하시겠습니까?')){
            history.go(-1)
          }else{
            location.href = 'cart_list.php';
          }
        </script>
     	";
      break;
      case "delete": 
        $num_item = 0;

        if (isset($_POST["item"])){
          $num_item = count($_POST["item"]); 
        }else{
          echo("
            <script>
              alert('삭제할 게시글을 선택해주세요!');
              history.go(-1)
            </script>
          ");
        }
      
        for($i = 0; $i<$num_item; $i++){
          $s_num = $_POST['item'][$i];

          $sql = "select * from cart where s_num = $s_num";
          $result = mysqli_query($con, $sql);
          $row = mysqli_fetch_array($result);
      
          $sql = "delete from cart where s_num = $s_num";
          mysqli_query($con, $sql);
        }
        mysqli_close($con); 

        header("location:cart_list.php");
        exit();

        break;
      case "calculate":
        $num_item = $calculate = 0;

        if (isset($_GET["item"])){
          $num_item = count($_GET["item"]);   
        }else{
          echo("
            <script>
              alert('계산할 상품을 선택해주세요!');
              history.go(-1)
            </script>
          ");
        }
      
        for($i = 0; $i<$num_item; $i++){
          $s_num = $_GET['item'][$i];

          $sql = "select * from cart where s_num = $s_num";
          $result = mysqli_query($con, $sql);
          $row = mysqli_fetch_array($result);
      
          $per_price = (int)str_replace(',','',$row['s_price']);
          
          $per_count = (int)$row['s_count'];
          
          $calculate += $per_price * $per_count;
        }
       
        mysqli_close($con); 
            
        // header("location:cart_list.php?cal=$calculate");
        // exit();
        break;
  }
?>
 

