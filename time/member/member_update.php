<?php

include "../db.php";

$username = $_POST['name'];

$email = $_POST['email'];
$postcode1 = $_POST['postcode1'];
$postcode2 = $_POST['postcode2'];
$zonecode = $_POST['zonecode'];
$address = $_POST['address'];
$addressinfo = $_POST['addressinfo'];

$sql = mq("update member set name='".$username."', postcode1='".$postcode1."', postcode2='".$postcode2."',
zonecode='".$zonecode."', address='".$address."', addressinfo='".$addressinfo."',email='".$email."' where id='".$_SESSION['userid']."' ");
echo "<script>alert('정보변경이 완료되었습니다 	'); location.href='mypage.php';</script>";

?>
