<?php
include "../db.php";?>

<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title>KILLING TIME - 유머글</title>
<link rel="stylesheet" type="text/css" href="/killing/css/read_style.css" />
<link rel="stylesheet" type="text/css" href="/killing/css/relpe_style.css"/>
<script type="text/javascript" src="/killing/board/jquery-3.4.1.js"></script>
<script type="text/javascript" src="common.js"></script>
<script type="text/javascript" src="jquery-ui.js"></script>

</head>
<body>
	<?php
		$bno = $_GET['idx']; /* bno함수에 idx값을 받아와 넣음*/
		$hit = mysqli_fetch_array(mq("select * from board where idx ='".$bno."'"));
		$hit = $hit['hit'] + 1;
		$fet = mq("update board set hit = '".$hit."' where idx = '".$bno."'");
		$sql = mq("select * from board where idx='".$bno."'"); /* 받아온 idx값을 선택 */
		$board = $sql->fetch_array();
	?>
  <div id="wrap">
  <div id="header">
      <div class="container">
          <div class="header">

            <!-- 헤더메뉴  -->
              <div class="header-menu">
                  <!-- <a href="/killing/main1.php">Login / SignUp</a> -->
                  <?php
                    if($_SESSION['userid']){
                      echo "{$_SESSION['name']} 님 환영합니다.";
                    ?>
                    <a href="/killing/member/logout.php"><input type="button" value="로그아웃" /></a>
                    <?php
                  }else{
                      // echo "<script>alert('잘못된 접근입니다.'); </script>";
                    ?>
                      <a href="/killing/main1.php">Login / SignUp</a>
                    <?php } ?>
              </div>
              <!--웹 제목  -->
              <div class="header-tit">
                <h1>
                  <a href="../index.php">
                    KILLING TIME</a>
                  </h1>
              </div>
          </div>
      </div>
</div>
</div>
<!-- 글 불러오기 -->

<div id="board_read">
  <h2>유머글모음</h2>
  <h4>읽다보면 시간삭제 되는 꿀잼 글모음</h4>


	<h3><?php echo $board['title']; ?></h3>
	<div id="bo_line"></div>
		<div id="user_info">
			 작성자 : <?php echo $board['name']; ?> 작성일 : <?php echo $board['date']; ?> 조회:<?php echo $board['hit']; ?>
				<div id="bo_line"></div>
			</div>
			<div id="bo_content">
				<?php echo nl2br("$board[content]"); ?>

			</div>
				<div id="bo_line"></div>
	<!-- 목록, 수정, 삭제 -->
	<div id="bo_ser">
		<ul>
			<?php
			$sql = mq("select * from member where id='".$_SESSION['userid']."'");
			$member = $sql->fetch_array();
			$nick = $member['id'];
			$board_name = $board['userid'];

				if($nick == $board_name){
			?>
			<li><a href="boardlist.php"><button>목록</button></a></li>
			<li><a href="modify.php?idx=<?php echo $board['idx']; ?>"><button>수정</button></a></li>
			<li><a href="delete.php?idx=<?php echo $board['idx']; ?>"><button>삭제</button></a></li>
			<?php
		}else if($_SESSION['name'] == "admin"){
				?>
					<li><a href="boardlist.php"><button>목록</button></a></li>
					<li><a href="delete.php?idx=<?php echo $board['idx']; ?>"><button>삭제</button></a></li>
				<?php
			}else{
				?>
					<li><a href="boardlist.php"><button>목록</button></a></li>
				<?php } ?>
		</ul>
	</div>
	<!--- 댓글 불러오기 -->
<div class="reply_view">
<h3>댓글목록</h3>
	<div id="bo_line"></div>
	<?php
		$sql3 = mq("select * from reply where con_num='".$bno."' order by idx desc");

		while($reply = $sql3->fetch_array()){
				$userid = $reply['userid'];
	?>
	<div class="dap_lo">
		<div><b><?php echo $reply['name'];?></b></div>
		<div class="dap_to comt_edit"><?php echo nl2br("$reply[content]"); ?></div>
		<div class="rep_me dap_to"><?php echo $reply['date']; ?></div>
		<div class="rep_me rep_menu">
			<!-- <a class="dat_edit_bt" href="#">수정</a> -->
			 <?php
			if($userid == $_SESSION['userid'] || $_SESSION['name'] == "admin"){
			?>
			<div class="del">
			<form action="reply_delete.php" method="post">
			<input type="hidden" name="rno" value="<?php echo $reply['idx']; ?>" /><input type="hidden" name="b_no" value="<?php echo $bno; ?>">
			<input type="submit" value="삭제"></p>
 			</form>
			</div>
			<?php		} ?>
			<!-- <a class="dat_delete_bt" href="#">삭제</a> -->
		</div>
		<!-- 댓글 수정 폼 dialog -->
		<!-- <div class="dat_edit">
			<form method="post" action="rep_modify_ok.php">
				<input type="hidden" name="rno" value="<?php echo $reply['idx']; ?>" /><input type="hidden" name="b_no" value="<?php echo $bno; ?>">
				<input type="password" name="pw" class="dap_sm" placeholder="비밀번호" />
				<textarea name="content" class="dap_edit_t"><?php echo $reply['content']; ?></textarea>
				<input type="submit" value="수정하기" class="re_mo_bt">
			</form>
		</div> -->
		<!-- 댓글 삭제 비밀번호 확인 -->

	</div>
<?php } ?>

<!--- 댓글 입력 폼 -->
<div class="dap_ins">
	<form method="post" class="reply_form">
		<input type="hidden" name="bno" value="<?php echo $bno; ?>">
		<!-- <input type="text" name="dat_user" id="dat_user" size="15" placeholder="아이디" value="<?=$_SESSION['name']?>"> -->
		<div style="margin-top:10px; ">
			<textarea name="content" class="reply_content" id="re_content" placeholder="내용" ></textarea>
			<button type="submit" class="re_bt">댓글</button>
		</div>
	</form>
</div>
</div><!--- 댓글 불러오기 끝 -->
<div id="foot_box"></div>

</div>


</body>
</html>
