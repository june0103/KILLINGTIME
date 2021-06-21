<?php
  include "../db.php";
$rno = $_POST['rno'];
$sql = mq("select * from videorep where idx='".$rno."'");
$reply = $sql->fetch_array();

$bno = $_POST['b_no'];
$sql2 = mq("select * from drip where idx='".$bno."'");
$board = $sql2->fetch_array();

$sql3 = mq("update videorep set content='".$_POST['content']."' where idx = '".$rno."'"); ?>
<script type="text/javascript">alert('수정되었습니다.'); location.replace("read.php?idx=<?php echo $bno; ?>");</script>
