<?php
 session_start();

  $db =mysqli_connect('localhost', 'aaa','aaa','registration');
  $db -> set_charset("utf8");

function mq($sql){
  global $db;
  return $db -> query($sql);
}
?>
