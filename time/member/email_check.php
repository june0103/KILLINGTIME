<?php
	if($_POST['email'] != NULL){

$check = preg_match('/[a-zA-Z0-9]+@/u', $_POST['userpw']);
$engs = preg_match('/[a-z]/u', $_POST['userpw']);
$engb = preg_match('/[A-Z]/u', $_POST['userpw']);
$spe = preg_match("/[\!\@\#\$\%\^\&\*]/u", $_POST['userpw']);

// $num = preg_match("/^[0-9]/i", $_POST['userpw']);
// $engs = preg_match("/^[a-z]/i", $_POST['userpw']);
// $engb = preg_match("/^[A-Z]/i", $_POST['userpw']);
// $spe = preg_match("/^[\!\@\#\$\%\^\&\*]/i", $_POST['userpw']);

 if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	 echo "<font color=blue>이메일 형식 확인.";
 }
else {
	echo "<font color=red>이메일 형식에 맞게 입력해주세요.";

}

}
else{
		echo "<font color=red>이메일를 입력해주세요.";
}?>
