<?php
  function create_trigger($con, $trigger_name){
    $flag = false;
    $sql = "SHOW TRIGGERS WHERE `trigger` = '$trigger_name';";
    $result = mysqli_query($con, $sql) or die("Can not show triggers".mysqli_error($con));

    if(mysqli_num_rows($result) > 0){
      $flag = true;
    }

    if($flag == false){
      switch($trigger_name) {
        case 'trg_delete_customer':
          $sql = "
          create trigger trg_delete_customer
            after delete
            on customer
            for each row
          begin
            INSERT INTO `delete_customer` VALUES(
              old.num, 
              old.id, 
              old.pass, 
              old.name, 
              old.email, 
              old.regist_day, 
              old.phone, 
              old.address,
              old.level,
              old.point,
              '삭제됨',
              now());
          end";
          break;  
        case 'trg_update_customer':
          $sql = "
          create trigger trg_update_customer
            after update
            on customer
            for each row
          begin
            INSERT INTO `update_customer` VALUES(
              old.num,
              old.id, 
              old.pass, 
              old.name, 
              old.email, 
              old.regist_day, 
              old.phone, 
              old.address,
              old.level,
              old.point,
              '수정됨',
              now());
          end ";
          break;  
      }

      $result = mysqli_query($con, $sql) or die("Fail : Create Trigger". mysqli_error($con));
      if($result == true){
        echo "<script>alert('Success : Create {$trigger_name} Trigger')</script>";
      }else{
        echo "<script>alert('Fail : Create {$trigger_name} Trigger')</script>";
      }
    }
  }
?>