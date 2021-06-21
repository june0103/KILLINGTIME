<?php
	if($_POST['userpw'] != NULL){

$num = preg_match('/[0-9]/u', $_POST['userpw']);
$engs = preg_match('/[a-z]/u', $_POST['userpw']);
$engb = preg_match('/[A-Z]/u', $_POST['userpw']);
$spe = preg_match("/[\!\@\#\$\%\^\&\*]/u", $_POST['userpw']);

// $num = preg_match("/^[0-9]/i", $_POST['userpw']);
// $engs = preg_match("/^[a-z]/i", $_POST['userpw']);
// $engb = preg_match("/^[A-Z]/i", $_POST['userpw']);
// $spe = preg_match("/^[\!\@\#\$\%\^\&\*]/i", $_POST['userpw']);

 if(strlen($_POST['userpw']) <8) {
	 echo "<font color=red>비밀번호는 8자 이상의 영문 대소문자와 숫자,특수문자를 혼합하여 입력해주세요.";
 }
else if($num == 0 || $engs == 0 || $engb == 0 || $spe == 0 ){
	echo "<font color=red>비밀번호는 영문 대소문자와 숫자,특수문자를 혼합하여 입력해주세요.";

}
else {
	echo "<font color=blue>사용가능한 비밀번호입니다.";

}

}
else{
		echo "<font color=red>비밀번호를 입력해주세요.";
}?>
