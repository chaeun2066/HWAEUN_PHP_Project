<?php
  $con = mysqli_connect("localhost", "root", "123456", "hwaeundb");

  $database_flag = false;
  $sql = "show databases";
  $result = mysqli_query($con, $sql) or die("Fail : Show Databases");
  
  while($row = mysqli_fetch_array($result)){
    if($row[0] == "hwaeundb"){
      $database_flag = true;
      break;
    }
  }

  if($database_flag == false){
    $sql = "create database hwaeundb";
    $result = mysqli_query($con, $sql) or die("Fail : Create Database hwaeundb");
    if($result == true){
      echo "<script>alert('Success : Create Database hwaeundb')</script>";
    }
  }

  $dbcon = mysqli_select_db($con, "hwaeundb") or die("Fail : Select Database hwaeundb");
  if($dbcon == false){
    echo "<script>alert('Fail : Select Database hwaeundb')</script>";
  }

  function get_paging($write_pages, $current_page, $total_page, $url) { 

    // URL = 'message_box.php?mode=send&page=123' → 'message_box.php?mode=send&page='
    // $url = preg_replace('/&page=[0-9]*/', '', $url) . '&amp;page=';
    $url = preg_replace('/page=[0-9]*/', '', $url) . 'page=';
  
    //0. 페이징 시작
    $str = '';
  
    //1. 2페이지부터 '처음(<<<)' 가기 표시
    // 'PHP_EOL' = \n
    ($current_page > 1) ? ($str .= '<a href="' . $url . '1" > [처음]&nbsp;&nbsp; </a>' . PHP_EOL) : ''; 
  
    //2. 시작 페이지와 끝 페이지를 정한다.(= 정하기만 한다.)
    $start_page = (((int)(($current_page - 1) / $write_pages)) * $write_pages) + 1;
    $end_page = $start_page + $write_pages - 1;
    if ($end_page >= $total_page) $end_page = $total_page;
  
    //3. 11페이지부터 '이전(<)' 가기 표시
    if ($start_page > 1) $str .= '<a href="' . $url . ($start_page - 1) . '" > < </a>' . PHP_EOL;
  
    //4. (총 페이지가 2페이지 이상일 경우부터) 시작 페이지와 끝 페이지를 등록한다.
    if ($total_page > 1) {
        for ($k = $start_page; $k <= $end_page; $k++) {
            if ($current_page != $k)
                $str .= '<a href="' . $url . $k . '">' . $k . '</a>' . PHP_EOL;
            else
                $str .= '<span style="color:white; background-color: #2b3729; padding: 0 5px;">' . $k . '</span>' . PHP_EOL;
        }
    }
    // 5. 총 페이지가 마지막 페이지보다 클 경우, '다음(>>)' 가기 표시
    // 예) 20페이지에서 다음을 누르면 21페이지로 이동
    if ($total_page > $end_page) $str .= '<a href="' . $url . ($end_page + 1) . '"> > </a>'.PHP_EOL;
  
    // 6. 현재 페이지가 총 페이지보다 작을 경우, '마지막(>>)' 가기 표시
    if ($current_page < $total_page) {
        $str .= '<a href="' . $url . $total_page . '" > &nbsp;&nbsp;[끝] </a>' . PHP_EOL;
    }
  
    // 7. 페이지 등록
    if ($str)
        return "<li><span >{$str}</span></li>";
    else
        return "";
  }


  function get_paging_first($write_pages, $current_page, $total_page, $url) { 
    $url = preg_replace('/&page=[0-9]*/', '', $url) . 'page='; // board_list.php?page=1 게시판에서는 &없어야한다.

    $str = '';

    ($current_page > 1) ? ($str .= '<a href="' . $url . '1"> [처음]&nbsp;&nbsp; </a>' . PHP_EOL) : ''; // 'PHP_EOL' = \n

    $start_page = (((int)(($current_page - 1) / $write_pages)) * $write_pages) + 1;
    $end_page = $start_page + $write_pages - 1;
    if ($end_page >= $total_page) $end_page = $total_page;

    if ($start_page > 1) $str .= '<a href="' . $url . ($current_page - 1) . '"> << </a>' . PHP_EOL;

    if ($current_page > 1) $str .= '<a href="' . $url . ($current_page - 1) . '"> [<] </a>' . PHP_EOL;

    if ($total_page > 1) {
        for ($k = $start_page; $k <= $end_page; $k++) {
            if ($current_page != $k)
                $str .= '<a href="' . $url . $k . '">' . $k . '</a>' . PHP_EOL;
            else
                $str .= '<style="color:white; background-color: #2b3729; padding: 0 5px;">' . $k . '</style=>' . PHP_EOL;
        }
    }

    if ($current_page < $total_page) $str .= '<a href="' . $url . ($current_page + 1) . '"> [>] </a>' . PHP_EOL;
    
    if ($end_page < $total_page) $str .= '<a href="' . $url . ($end_page + 1) . '"> >> </a>' . PHP_EOL;

    if ($current_page < $total_page) {
        $str .= '<a href="' . $url . $total_page . '"> &nbsp;&nbsp;[끝] </a>' . PHP_EOL;
    }

    if ($str)
        return "<li><span>{$str}</span></li>";
    else
        return "";
}

function get_paging_third($total_page, $page){
  if ($total_page>=2 && $page >= 2)	{
    $new_page = $page-1;
    echo "<li><a href='board_list.php?page=$new_page'>◀ 이전</a> </li>";
  }		
  else {
    echo "<li>&nbsp;</li>";
  }
     // 게시판 목록 하단에 페이지 링크 번호 출력
     for ($i=1; $i<=$total_page; $i++){
    if ($page == $i){  // 현재 페이지 번호 링크 안함
      echo "<li><b> $i </b></li>";
    }else{
      echo "<li><a href='board_list.php?page=$i'> $i </a><li>";
    }
  }
    
  if ($total_page>=2 && $page != $total_page){
    $new_page = $page+1;	
    echo "<li> <a href='board_list.php?page=$new_page'>다음 ▶</a> </li>";
  }else {
    echo "<li>&nbsp;</li>";
  }
}

function input_set($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function alert_back($message){
  echo("
    <script>
      alert('$message');
      history.go(-1)
    </script>
  ");
}
?>