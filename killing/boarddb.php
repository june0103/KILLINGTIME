<?php
 session_start();
 header('Content-Type: text/html; charset=utf8');

  $db =mysqli_connect('localhost', 'aaa','aaa','boardDB');
  $db -> set_charset("utf8");

function mq($sql){
  global $db;
  return $db -> query($sql);
}
?>
