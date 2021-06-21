<?php
  include "../db.php";

$bno = $_POST['idx'];
$url = $_POST['url'];
preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
$id = $matches[1];
$sql = mq("update video set title='".$_POST['title']."',content='".$_POST['content']."',url='".$id."',fullurl='".$url."' where idx='".$bno."'");
?>
<script type="text/javascript">alert("수정되었습니다.");</script>
<meta http-equiv="refresh" content="0 url=../read.php?idx=<?php echo $bno; ?>">
