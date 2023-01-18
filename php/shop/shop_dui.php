<?php
  include('../../db/db_connect.php');

  $mode = $_POST['mode'];

  switch($mode){
    case "insert":
      $id = $_POST["id"];
      $s_name = $_POST["s_name"];
      $s_type = $_POST["s_type"];
      $s_price = $_POST["s_price"];
      $s_content = $_POST["s_content"];
	    $s_content = htmlspecialchars($s_content, ENT_QUOTES);
      $s_regist_day = date("Y-m-d [H:i]");  
      $upload_dir = "../../data/";

      $upfile_name     = $_FILES["s_upfile"]["name"];
      $upfile_tmp_name = $_FILES["s_upfile"]["tmp_name"];
      $upfile_type     = $_FILES["s_upfile"]["type"];
      $upfile_size     = $_FILES["s_upfile"]["size"]; 
      $upfile_error    = $_FILES["s_upfile"]["error"];

      if ($upfile_name && !$upfile_error) { 
        $file = explode(".", $upfile_name); 
        $file_name = $file[0]; 
        $file_ext = $file[1]; 

        $new_file_name = date("Y_m_d_H_i_s");
        $new_file_name = $new_file_name . "_" . $file_name;
        $copied_file_name = $new_file_name . "." . $file_ext;
        $uploaded_file = $upload_dir . $copied_file_name;
        if ($upfile_size > 1000000) {
          echo("
            <script>
              alert('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
              history.go(-1)
            </script>
				  ");
          exit;
        }

        if (!move_uploaded_file($upfile_tmp_name, $uploaded_file)) {
          echo("
            <script>
              alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
              history.go(-1)
            </script>
  				");
          exit;
        }
      } else {
        $upfile_name = "";
        $upfile_type = "";
        $copied_file_name = "";
      }

      $sql = "insert into shop (s_name, s_type, s_price, s_content, s_regist_day, s_hit, s_file_name, s_file_type, s_file_copied) ";
      $sql .= "values('$s_name', '$s_type', '$s_price', '$s_content', '$s_regist_day', 0, ";
      $sql .= "'$upfile_name', '$upfile_type', '$copied_file_name')";
      mysqli_query($con, $sql); 
      mysqli_close($con);           

      echo "
        <script>
          location.href = 'shop_list.php';
        </script>
     	";
      break;
    case "delete":
      $id = $_POST["id"];
      $num = $_POST["num"];
      $page = $_POST["page"];
      $s_name = $_POST["s_name"];
      $sql = "select * from shop where s_num = $num";
      $result = mysqli_query($con, $sql);
      $row = mysqli_fetch_array($result);

      if ($id !== "admin") {
        alert_back('수정권한이 없습니다.');
        exit;
      }

      $s_copied_name = $row["s_file_copied"];

      if ($s_copied_name) {
        $s_file_path = "../../data/" . $s_copied_name;
        unlink($s_file_path);
      }
      
      $sql1 = "delete from cart where s_name ='$s_name'";
      mysqli_query($con, $sql1);

      $sql2 = "delete from shop where s_num = $num";
      mysqli_query($con, $sql2);

      mysqli_close($con);
      echo "
        <script>
          location.href = 'shop_list.php?page=$page';
        </script>
      ";
      break;
    case "modify":
      $num = $_POST["num"];
      $page = $_POST["page"];
      $s_name = $_POST["s_name"];
      $s_type = $_POST["s_type"];
      $s_price = $_POST["s_price"];
      $s_content = $_POST["s_content"];

      $file_delete = (isset($_POST["file_delete"])) ? $_POST["file_delete"] : 'no';

      $sql = "select * from shop where s_num = $num";
      $result = mysqli_query($con, $sql);
      $row = mysqli_fetch_array($result);

      $copied_name = $row["s_file_copied"];
      $upfile_name = $row["s_file_name"];
      $upfile_type = $row["s_file_type"];
      $copied_file_name = $row["s_file_copied"];

      if(($file_delete !== "yes") && empty($_FILES["s_upfile"]["name"])){
        $sql = "update shop set s_name='$s_name', s_type='$s_type', s_price='$s_price', s_content='$s_content' where s_num=$num ";
        mysqli_query($con, $sql);
      }else if(($file_delete === "yes") && empty($_FILES["upfile"]["name"])){
        if ($copied_name) {
          $file_path = "../../data/" . $copied_name;
          unlink($file_path);
        }
        $upfile_name = "";
        $upfile_type = "";
        $copied_file_name = "";
        $sql = "update shop set s_name='$s_name', s_type='$s_type', s_price='$s_price', s_content='$s_content', s_file_name='$upfile_name', s_file_type='$upfile_type', s_file_copied= '$copied_file_name'";
        $sql .= " where s_num=$num";
        mysqli_query($con, $sql); 
      }else{
        if ($copied_name) {
          $file_path = "../../data/" . $copied_name;
          unlink($file_path);
        }
        $upfile_name = "";
        $upfile_type = "";
        $copied_file_name = "";

        if(isset($_FILES["s_upfile"])){
          $upload_dir = "../../data/";
          $upfile_name = $_FILES["s_upfile"]["name"];
          $upfile_tmp_name = $_FILES["s_upfile"]["tmp_name"];
          $upfile_type = $_FILES["s_upfile"]["type"];
          $upfile_size = $_FILES["s_upfile"]["size"];  
          $upfile_error = $_FILES["s_upfile"]["error"];
          if ($upfile_name && !$upfile_error) { 
              $file = explode(".", $upfile_name); 
              $file_name = $file[0]; 
              $file_ext = $file[1]; 
              $new_file_name = date("Y_m_d_H_i_s");
              $new_file_name = $new_file_name . "_" . $file_name;
              $copied_file_name = $new_file_name . "." . $file_ext; 
              $uploaded_file = $upload_dir . $copied_file_name; 
              if ($upfile_size > 1000000) {
                  echo("
                  <script>
                    alert('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
                    history.go(-1)
                  </script>
                  ");
                  exit;
              }
              if (!move_uploaded_file($upfile_tmp_name, $uploaded_file)) {
                  echo("
                  <script>
                    alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
                    history.go(-1)
                  </script>
                ");
                  exit;
              }
          }
          $sql = "update shop set s_name='$s_name', s_type='$s_type', s_price='$s_price', s_content='$s_content',  s_file_name='$upfile_name', s_file_type='$upfile_type', s_file_copied= '$copied_file_name'";
          $sql .= " where s_num=$num";
          mysqli_query($con, $sql); 
        }
      }
      echo "
        <script>
          location.href = 'shop_list.php?page=$page';
        </script>
      ";
      break;
    case "insert_ripple" :
      $id = $_POST['id'];

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
          alert('로그인하고 사용해주세요.');
          history.go(-1);
        </script>";
        exit;
      } else {
        $content = input_set($_POST["ripple_content"]);
        $page = input_set($_POST["page"]);
        $parent = input_set($_POST["parent"]);
        // $hit = input_set($_POST["hit"]);
        $q_usernick = isset($_SESSION['nick']) ? mysqli_real_escape_string($con, $_SESSION['nick']) : null;
        $q_username = mysqli_real_escape_string($con, $_POST['name']);
        $q_content = mysqli_real_escape_string($con, $content);
        $q_parent = mysqli_real_escape_string($con, $parent);
        $regist_day = date("Y-m-d [H:i]");

        $sql = "INSERT INTO `shop_ripple` VALUES (null,'$q_parent','$q_userid','$q_username', '$q_usernick','$q_content','$regist_day')";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            die('Error: ' . mysqli_error($con));
        }
        mysqli_close($con);
        echo "
        <script>
          location.href='./shop_view.php?num=$parent&page=$page';
        </script>
        ";
      }
      break;
    case "delete_ripple" : 
      $page = input_set($_POST["page"]);
      $hit = input_set($_POST["hit"]);
      $num = input_set($_POST["num"]);
      $parent = input_set($_POST["parent"]);
      $q_num = mysqli_real_escape_string($con, $num);

      $sql = "DELETE FROM `shop_ripple` WHERE num=$q_num";
      $result = mysqli_query($con, $sql);
      if (!$result) {
          die('Error: ' . mysqli_error($con));
      }
      mysqli_close($con);
      echo "
      <script>
        location.href='./shop_view.php?num=$parent&page=$page&hit=$hit';</script>";
      break;
  }
?>