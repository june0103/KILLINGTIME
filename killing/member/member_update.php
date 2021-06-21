<?php

include "../db.php";
include "../password.php";

$userpw = password_hash($_POST['userpw'], PASSWORD_DEFAULT);
$username = $_POST['name'];
$adress = $_POST['adress'];
$email = $_POST['email'].'@'.$_POST['emadress'];

$sql = mq("update member set pw='".$userpw."', name='".$username."', adress='".$adress."',email='".$email."' where id='".$_SESSION['userid']."'");
echo "<script>alert('정보변경이 완료되었습니다 	'); location.href='../index.php';</script>";

?>
