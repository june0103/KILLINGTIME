<?php
include "../db.php";
	if($_POST['userid'] != NULL){
	$id_check = mq("select * from member where id='{$_POST['userid']}'");
	$id_check = $id_check->fetch_array();

 if(!preg_match("/^[a-z]/i", $_POST['userid'])) {
	 echo "<font color=red>아이디의 첫글자는 영문이여야합니다.";
 }
 else {
	 if($id_check >= 1){
		 echo "<font color=red>존재하는 아이디입니다.";
	 } else {
		 echo "<font color=blue>사용가능한 아이디입니다.";
	 }
 }


}
else{
	echo "<font color=red>아이디를 입력해주세요.";
} ?>
