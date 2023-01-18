<?php
  include_once $_SERVER['DOCUMENT_ROOT']."/hwaeun/db/db_connect.php";
  include_once $_SERVER['DOCUMENT_ROOT']."/hwaeun/db/create_table.php";
  include_once $_SERVER['DOCUMENT_ROOT']."/hwaeun/db/create_trigger.php";

  //TABLE
  create_table($con, "customer");
  create_table($con, "delete_customer");
  create_table($con, "update_customer");
  create_table($con, "message");  
  create_table($con, "board");
  create_table($con, "board_ripple");
  create_table($con, "notice");
  create_table($con, "event");
  create_table($con, "shop");
  create_table($con, "shop_ripple");
  create_table($con, "cart");

  //TRIGGER
  create_trigger($con, "trg_delete_customer");
  create_trigger($con, "trg_update_customer");

  //PROCEDURE
?>