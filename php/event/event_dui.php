<?php
  include('../../db/db_connect.php');

  session_start();
	if (isset($_SESSION["id"])) $id = $_SESSION["id"];
	  else $id = "";
	if (isset($_SESSION["name"])) $name = $_SESSION["name"];
	  else $name = "";

  if ($_SESSION['id'] !== "admin"){
    echo("
      <script>
        alert('관리자 접근제한');
        history.go(-1)
      </script>
    ");
    exit;
	}

  $mode = $_POST['mode'];

  switch($mode){
    case "insert":
      $subject = $_POST["subject"];
      $content = $_POST["content"];
      $subject = htmlspecialchars($subject, ENT_QUOTES);
	    $content = htmlspecialchars($content, ENT_QUOTES);
      $regist_day = date("Y-m-d [H:i]");  
      $upload_dir = "../../data/";

      $upfile_name     = $_FILES["upfile"]["name"];
      $upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
      $upfile_type     = $_FILES["upfile"]["type"];
      $upfile_size     = $_FILES["upfile"]["size"]; 
      $upfile_error    = $_FILES["upfile"]["error"];

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

      $sql = "insert into event (id, name, subject, content, regist_day, hit,  file_name, file_type, file_copied) ";
      $sql .= "values('$id', '$name', '$subject', '$content', '$regist_day', 0, ";
      $sql .= "'$upfile_name', '$upfile_type', '$copied_file_name')";
      mysqli_query($con, $sql);  

      // $point_up = 100;

      // $sql = "select point from customer where id='$id'";
      // $result = mysqli_query($con, $sql);
      // $row = mysqli_fetch_array($result);
      // $new_point = $row["point"] + $point_up;

      // $sql = "update customer set point={$new_point} where id='$id'";
      // mysqli_query($con, $sql);
      mysqli_close($con);           

      echo "
        <script>
          location.href = 'board_list.php';
        </script>
     	";
      break;
    case "delete":
      $num = $_POST["num"];
      $page = $_POST["page"];
      $sql = "select * from event where num = $num";
      $result = mysqli_query($con, $sql);
      $row = mysqli_fetch_array($result);
      $writer = $row["id"];

      if (!isset($id) || ($id !== $writer && $level !== '1')) {
        alert_back('수정권한이 없습니다.');
        exit;
      }
      $copied_name = $row["file_copied"];

      if ($copied_name) {
        $file_path = "../../data/" . $copied_name;
        unlink($file_path);
      }

      $sql = "delete from event where num = $num";
      mysqli_query($con, $sql);

      mysqli_close($con);
      echo "
      <script>
        location.href = 'event_list.php?page=$page';
      </script>
      ";
      break;
    case "modify":
      $num = $_POST["num"];
      $page = $_POST["page"];
      $subject = $_POST["subject"];
      $content = $_POST["content"];

      $file_delete = (isset($_POST["file_delete"])) ? $_POST["file_delete"] : 'no';

      $sql = "select * from event where num = $num";
      $result = mysqli_query($con, $sql);
      $row = mysqli_fetch_array($result);

      $copied_name = $row["file_copied"];
      $upfile_name = $row["file_name"];
      $upfile_type = $row["file_type"];
      $copied_file_name = $row["file_copied"];

      if(($file_delete !== "yes") && empty($_FILES["upfile"]["name"])){
        $sql = "update event set subject='$subject', content='$content' where num=$num ";
        mysqli_query($con, $sql);
      }else if(($file_delete === "yes") && empty($_FILES["upfile"]["name"])){
        if ($copied_name) {
          $file_path = "../../data/" . $copied_name;
          unlink($file_path);
        }
        $upfile_name = "";
        $upfile_type = "";
        $copied_file_name = "";
        $sql = "update event set subject='$subject', content='$content',  file_name='$upfile_name', file_type='$upfile_type', file_copied= '$copied_file_name'";
        $sql .= " where num=$num";
        mysqli_query($con, $sql); 
      }else{
        if ($copied_name) {
          $file_path = "../../data/" . $copied_name;
          unlink($file_path);
        }
        $upfile_name = "";
        $upfile_type = "";
        $copied_file_name = "";

        if(isset($_FILES["upfile"])){
          $upload_dir = "../../data/";
          $upfile_name = $_FILES["upfile"]["name"];
          $upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
          $upfile_type = $_FILES["upfile"]["type"];
          $upfile_size = $_FILES["upfile"]["size"];  
          $upfile_error = $_FILES["upfile"]["error"];
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
          $sql = "update event set subject='$subject', content='$content',  file_name='$upfile_name', file_type='$upfile_type', file_copied= '$copied_file_name'";
          $sql .= " where num=$num";
          mysqli_query($con, $sql); 
        }
      }
      echo "
        <script>
            location.href = 'event_list.php?page=$page';
        </script>
      ";
      break;
  }
?>