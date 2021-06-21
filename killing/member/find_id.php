<?php
  include "../db.php";
  $username = $_POST['name'];
  $email = $_POST['email'].'@'.$_POST['emadress'];


  $sql = mq("select * from member where name = '{$username}' && email = '{$email}'");
  $result = $sql->fetch_array();

  if($result["name"] == $username){
  	echo "회원님의 ID는 ".$result['id']."입니다.";
  ?>
  <p><a href="../main1.php"><input type="button" value="로그인"</a></p>
  <?php
  }else{
  echo "없는 계정입니다.";
  ?>
    <p><a href="member_find.php"><input type="button" value="로그인"</a></p>
    <?php
  }
  ?>
