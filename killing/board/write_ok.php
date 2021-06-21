<?php
  include "../db.php";

$userid = $_SESSION['userid'];
$date = date('Y-m-d H:m:s');
$mqq = mq("alter table board auto_increment =1");
$sql = mq("insert into board(name,title,content,date,userid) values('".$_POST['name']."','".$_POST['title']."','".$_POST['content']."','".$date."','".$userid."')");


echo "<script>alert('글쓰기 완료되었습니다.');</script>";
 ?>

<!-- <script type="text/javascript">alert("글쓰기 완료되었습니다.");</script> -->
<meta http-equiv="refresh" content="0; /killing/board/boardlist.php" />
