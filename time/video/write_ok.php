<?php
  include "../db.php";

$username =  $_SESSION['name'];
$userid = $_SESSION['userid'];
$date = date('Y-m-d H:i:s');
$url = $_POST['url'];
preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
$id = $matches[1];
$mqq = mq("alter table video auto_increment =1");
$sql = mq("insert into video(name,title,userid,content,date,url,fullurl) values('".$username."','".$_POST['title']."','".$userid."','".$_POST['content']."','".$date."','".$id."','".$url."')");

echo "<script>alert('글쓰기 완료되었습니다.');</script>";
 ?>

<!-- <script type="text/javascript">alert("글쓰기 완료되었습니다.");</script> -->
<meta http-equiv="refresh" content="0; /time/video/videoList.php" />
