<?php
	include "../signupdb.php";
	include "/password.php";


if ($db) {
  // code...

	$userid = $_POST['userid'];
	$userpw = password_hash($_POST['userpw'], PASSWORD_DEFAULT);
	$username = $_POST['name'];
	$postcode1 = $_POST['postcode1'];
	$postcode2 = $_POST['postcode2'];
	$zonecode = $_POST['zonecode'];
	$address = $_POST['address'];
	$addressinfo = $_POST['addressinfo'];

	$email = $_POST['email'].'@'.$_POST['emadress'];
$sql = mq("insert into member (id,pw,name,postcode1,postcode2,zonecode,address,addressinfo,email) values('$userid','$userpw','$username','$postcode1','$postcode2','$zonecode','$address','$addressinfo','$email')");
}
?>
<meta charset="utf-8" />
<script type="text/javascript">alert('회원가입이 완료되었습니다.');</script>
<meta http-equiv="refresh" content="0; /killing/main1.php">
