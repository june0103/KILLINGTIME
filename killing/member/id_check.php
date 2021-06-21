<?php
include "../db.php";
	if($_POST['userid'] != NULL){
	$id_check = mq("select * from member where id='{$_POST['userid']}'");
	$id_check = $id_check->fetch_array();

	if($id_check >= 1){
		echo "<font color=red>존재하는 아이디입니다.";
	} else {
		echo "<font color=blue>사용가능한 아이디입니다.";
	}
} ?>
