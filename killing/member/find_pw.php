<?php
  include "../logo.php";
?>
<?php
	include "../db.php";

$userid = $_POST['userid'];
$sql = mq("select * from member where id='{$userid}'");
$result = $sql->fetch_array();

if($result["id"] == $userid){
	$_SESSION['uid'] = $userid;
	echo "<script>location.href='member_pw_update.php';</script>";

}else{
	echo "<script>alert('없는 계정입니다.'); history.back();</script>";
}
?>
