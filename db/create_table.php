<?php
  function create_table($con, $table_name){
    $flag = false;
    $sql = "show tables from hwaeundb";
    $result = mysqli_query($con, $sql) or die("Fail : Show Tables");
            
    while($row = mysqli_fetch_array($result)){
      if($row[0] == "$table_name"){
        // var_dump(mysqli_fetch_array($result));
        // exit;

        $flag = true;
        break;
      }
    }

    if($flag == false){
      switch($table_name){
        case 'customer' : 
          $sql = "create table if not exists `customer` (
            `num` int(11) NOT NULL AUTO_INCREMENT,
            `id` char(15) NOT NULL,
            `pass` char(255) NOT NULL,
            `name` char(10) NOT NULL,
            `email` char(80) DEFAULT NULL,
            `regist_day` char(20) DEFAULT NULL,
            `phone` char(20) NOT NULL,
            `address` char(200) DEFAULT NULL,
            `level` int(11) DEFAULT NULL,
            `point` int(11) DEFAULT NULL,
            PRIMARY KEY (`num`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
          break;
        case 'message' : 
          $sql = "create table if not exists message ( 
            num int not null auto_increment, 
            send_id char(20) not null, 
            rv_id char(20) not null,
            subject char(200) not null, 
            content text not null,  
            regist_day char(20), 
            primary key(num)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
          break;
        case 'board' :
          $sql = "create table if not exists board (
            num int not null auto_increment,
            id char(15) not null,
            name char(10) not null,
            subject char(200) not null,
            content text not null,        
            regist_day char(20) not null,
            hit int not null,
            primary key(num)
         ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
          break;
        case 'board_ripple':
          $sql = "CREATE TABLE `board_ripple` (
            `num` int(11) NOT NULL AUTO_INCREMENT,
            `parent` int(11) NOT NULL,
            `id` char(15) NOT NULL,
            `name` char(10) NOT NULL,
            `nick` char(10) NOT NULL,
            `content` text NOT NULL,
            `regist_day` char(20) DEFAULT NULL,
            PRIMARY KEY (`num`),
            KEY `regist_day` (`regist_day`)
          ) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;";
          break;   
        case 'notice' :
          $sql = "create table if not exists notice (
            num int not null auto_increment,
            id char(15) not null,
            name char(10) not null,
            subject char(200) not null,
            content text not null,        
            regist_day char(20) not null,
            hit int not null,
            file_name char(40),
            file_type char(40),
            file_copied char(40),
            primary key(num)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
          break; 
        case 'event':
          $sql = "CREATE TABLE `event` (
            `num` int NOT NULL AUTO_INCREMENT,
            `id` char(15) NOT NULL,
            `name` char(10) NOT NULL,
            `subject` char(200) NOT NULL,
            `content` text NOT NULL,
            `regist_day` char(20) NOT NULL,
            `hit` int NOT NULL, 
            `file_name` char(40) NOT NULL,
            `file_type` char(40) NOT NULL,
            `file_copied` char(40) NOT NULL,
            PRIMARY KEY (`num`),
            KEY `id` (`id`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
          break;
        case 'shop':
          $sql = "CREATE TABLE `shop` (
            `s_num` int NOT NULL AUTO_INCREMENT,
            `s_name` char(50) NOT NULL,
            `s_type` char(30) NOT NULL,
            `s_price` char(200) NOT NULL,
            `s_content` text NOT NULL,
            `s_regist_day` char(20) NOT NULL,
            `s_hit` int NOT NULL, 
            `s_file_name` char(40) NOT NULL,
            `s_file_type` char(40) NOT NULL,
            `s_file_copied` char(40) NOT NULL,
            PRIMARY KEY (`s_num`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
          break;
        case 'shop_ripple':
          $sql = "CREATE TABLE `shop_ripple` (
            `num` int(11) NOT NULL AUTO_INCREMENT,
            `parent` int(11) NOT NULL,
            `id` char(15) NOT NULL,
            `name` char(10) NOT NULL,
            `nick` char(10) NOT NULL,
            `content` text NOT NULL,
            `regist_day` char(20) DEFAULT NULL,
            PRIMARY KEY (`num`),
            KEY `regist_day` (`regist_day`)
          ) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;";
          break;   
        case 'cart':
          $sql = "CREATE TABLE `cart` (
            `s_num` int NOT NULL AUTO_INCREMENT,
            `s_id` char(15) NOT NULL,
            `s_name` char(50) NOT NULL,
            `s_type` char(30) NOT NULL,
            `s_price` char(200) NOT NULL,
            `s_content` text NOT NULL,
            `s_count` char(20) NOT NULL,
            `s_regist_day` char(20) NOT NULL,
            `s_file_name` char(40) NOT NULL,
            `s_file_type` char(40) NOT NULL,
            `s_file_copied` char(40) NOT NULL,
            PRIMARY KEY (`s_num`)
          ) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;";
          break;    
        case 'delete_customer' : //대문자명 절대 사용 금지
          $sql = "CREATE TABLE `delete_customer` (
            `num` int(11) NOT NULL,
            `id` char(15) NOT NULL,
            `pass` char(255) NOT NULL,
            `name` char(10) NOT NULL,
            `email` char(80) DEFAULT NULL,
            `regist_day` char(20) DEFAULT NULL,
            `phone` char(20) NOT NULL,
            `address` char(200) DEFAULT NULL,
             `level` int(11) DEFAULT NULL,
            `point` int(11) DEFAULT NULL,
            `status` char(20) DEFAULT NULL,
            `date` char(20) DEFAULT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
          break;
        case 'update_customer' :  //대문자명 절대 사용 금지
          $sql = "CREATE TABLE `update_customer` (
            `num` int(11) NOT NULL,
            `id` char(15) NOT NULL,
            `pass` char(255) NOT NULL,
            `name` char(10) NOT NULL,
            `email` char(80) DEFAULT NULL,
            `regist_day` char(20) DEFAULT NULL,
            `phone` char(20) NOT NULL,
            `address` char(200) DEFAULT NULL,
             `level` int(11) DEFAULT NULL,
            `point` int(11) DEFAULT NULL,
            `status` char(20) DEFAULT NULL,
            `date` char(20) DEFAULT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
          break;    
        default :
          echo "<script>alert('Fail : Can not found the table')</script>";
          break;
      }

      $result = mysqli_query($con, $sql) or die("Fail : Create Table". mysqli_error($con));
      if($result == true){
        echo "<script>alert('Success : Create {$table_name} Table')</script>";
      }else{
        echo "<script>alert('Fail : Create {$table_name} Table')</script>";
      }
    }
  }
?>