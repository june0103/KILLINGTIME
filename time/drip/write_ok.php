<?php
  include "../db.php";

$username =  $_SESSION['name'];
$userid = $_SESSION['userid'];
$date = date('Y-m-d H:i:s');
$mqq = mq("alter table drip auto_increment =1");
$sql = mq("insert into drip(name,title,content,date,userid) values('".$username."','".$_POST['title']."','".$_POST['content']."','".$date."','".$userid."')");

echo "<script>alert('글쓰기 완료되었습니다.');</script>";
 ?>

<!-- <script type="text/javascript">alert("글쓰기 완료되었습니다.");</script> -->
<meta http-equiv="refresh" content="0; /time/drip/dripList.php" />
