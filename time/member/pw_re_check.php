<?php
	if($_POST['userpw_re'] != NULL){


 if($_POST['userpw_re'] == $_POST['userpw']) {
	 echo "<font color=red>비밀번호 입력해주세요.";
 }

else {
	echo "<font color=blue>사용가능한 비밀번호입니다. $_POST['userpw']";

}
}
?>
