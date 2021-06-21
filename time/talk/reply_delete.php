<?php
include "../db.php";
$rno = $_POST['rno'];
$sql = mq("select * from talkrep where idx='".$rno."'");
$reply = $sql->fetch_array();

$bno = $_POST['b_no'];
$sql2 = mq("select * from drip where idx='".$bno."'");
$board = $sql2->fetch_array();

$pwk = $_POST['pw'];
$bpw = $reply['pw'];

		$sql = mq("delete from talkrep where idx='".$rno."'"); ?>
	<script type="text/javascript">alert('댓글이 삭제되었습니다.'); location.replace("read.php?idx=<?php echo $board["idx"]; ?>");</script>
