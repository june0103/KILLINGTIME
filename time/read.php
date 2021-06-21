<?php
  include "../head.php";
  include "../server.php"
	?>

<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"
integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ=" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
 integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="/time/css/read.css" />
<link rel="stylesheet" type="text/css" href="/time/css/relpe_style.css"/>
<script type="text/javascript" src="/time/member/jquery-3.4.1.js"></script>
<script type="text/javascript" src="common.js"></script>
<script type="text/javascript" src="jquery-ui.js"></script>

</head>
<body>


  </script>
	<?php
		$bno = $_GET['idx']; /* bno함수에 idx값을 받아와 넣음*/


    if($_COOKIE['drip'.$bno.$_SESSION['name']] == false)
    {
      $hit = mysqli_fetch_array(mq("select * from drip where idx ='".$bno."'"));
      $hit = $hit['hit'] + 1;
      $fet = mq("update drip set hit = '".$hit."' where idx = '".$bno."'");
      $sql = mq("select * from drip where idx='".$bno."'"); /* 받아온 idx값을 선택 */
      $board = $sql->fetch_array();
      setcookie('drip'.$bno.$_SESSION['name'] , TRUE , time()+60*60*24, "/");

    }
    else{

      $sql = mq("select * from drip where idx='".$bno."'"); /* 받아온 idx값을 선택 */
      $board = $sql->fetch_array();
    }
	?>

<!-- 글 불러오기 -->

<div id="board_read">
  <h3 style="color:#509ee7;
    margin-top: 10px;
    margin-bottom: 20px;">꿀잼 드립</h3>
  <h4>읽다보면 시간삭제 되는 꿀잼 드립모음</h4>


	<h3><?php echo $board['title']; ?></h3>
	<div id="bo_line"></div>
		<div id="user_info">
			 작성자 : <?php echo $board['name']; ?> 작성일 : <?php echo $board['date']; ?> 조회:<?php echo $board['hit']; ?>
				<div id="bo_line"></div>
			</div>
			<div id="bo_content">
				<?php echo nl2br("$board[content]"); ?>

			</div>
      <div class="post-info">
        <?php
        $sql2 = mq("select * from like_unlike where userid='".$_SESSION['userid']."' and postid='".$board['idx']."' ");
        if(mysqli_num_rows($sql2) == 1) { ?>
                  <span><a href="" class="unlike" id="<?php echo $board['idx']; ?>">좋아요취소</a></span>
       <?php  }
       else { ?>
         <span><a href="" class="like" id="<?php echo $board['idx']; ?>">좋아요</a></span>

       <?php }
         ?>



        <i class="fa fa-thumbs-up like1-btn" data-id="<?php echo $board['idx'] ?>"></i><?php echo $board['idx'] ?>
        <!-- if user likes post, style button differently -->
              <span style="color:#509ee7"><i
                <?php if (userLiked($board['idx'])){ ?>
              		  class="fas fa-thumbs-up fa-2x like-btn"
                  <?php }
                 else{ ?>
              		  class="fa fa-thumbs-up like-btn"
                <?php   } ?>

              	  data-id="<?php echo $board['idx'] ?>"></i></span>
              	<span class="likes"><?php echo getLikes($board['idx']); ?></span>

              	&nbsp;&nbsp;&nbsp;&nbsp;

        	    <!-- if user dislikes post, style button differently -->
              	<span style="color:#509ee7"><i
              	  <?php if (userDisliked($board['idx'])): ?>
              		  class="fas fa-thumbs-down fa-2x dislike-btn"
              	  <?php else: ?>
              		  class="far fa-thumbs-down fa-2x dislike-btn"
              	  <?php endif ?>
              	  data-id="<?php echo $board['idx'] ?>"></i></span>
              	<span class="dislikes"><?php echo getDislikes($board['idx']); ?></span>

      <!-- <span style="color:#509ee7"><i class="far fa-thumbs-up fa-2x like-btn" data-id="<?php echo $board['idx'] ?>"></i></span>

      <span style="color:#509ee7"><i class="far fa-thumbs-down fa-2x dislike-btn" data-id="<?php echo $board['idx'] ?>"></i></span> -->

        <img src="/time/img/like32.png" >
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
			<li><a href="dripList.php"><button>목록</button></a></li>
			<li><a href="modify.php?idx=<?php echo $board['idx']; ?>"><button>수정</button></a></li>
			<li><a href="delete.php?idx=<?php echo $board['idx']; ?>"><button>삭제</button></a></li>
			<?php
		}else if($_SESSION['userid'] == "admin"){
				?>
					<li><a href="dripList.php"><button>목록</button></a></li>
					<li><a href="delete.php?idx=<?php echo $board['idx']; ?>"><button>삭제</button></a></li>
				<?php
			}else{
				?>
					<li><a href="dripList.php"><button>목록</button></a></li>
				<?php } ?>
		</ul>
	</div>
	<!--- 댓글 불러오기 -->
<div class="reply_view">
<h3>댓글목록</h3>
	<div id="bo_line"></div>
	<?php
		$sql4 = mq("select * from driprep where con_num='".$bno."' order by idx desc");

		while($reply = $sql4->fetch_array()){

				$userid = $reply['userid'];
	?>
	<div class="dap_lo">
		<div><b><?php echo $reply['name'];?></b></div>
		<div class="dap_to comt_edit"><?php echo nl2br("$reply[content]"); ?></div>
		<div class="rep_me dap_to">
      <?php

      $current = strtotime(date("Y-m-d H:i:s"));

      $diff =$current - strtotime($reply['date']);

      $s = 60;
      $h = $s *60;
      $d = $h *24;

      if($diff < $s) {
        $result = '방금전';
      }
      else if($h > $diff && $diff >= $s){
        $result = round($diff/$s) . '분전';
      }
      else if($d > $diff && $diff >=$h){
        $result = round($diff/$h) . '시간전';
      }
      else{

        $result =  date('Y-m-d',strtotime($reply['date']));
      }
      echo $result;

      ?>
      <!-- <?php echo $reply['date']; ?> -->
    </div>
		<div class="rep_me rep_menu">
			<!-- <a class="dat_edit_bt" href="#">수정</a> -->
			 <?php
			if($userid == $_SESSION['userid'] || $_SESSION['name'] == "admin"){
			?>

			<div class="del">
			<form name="reple_delete" action="reply_delete.php" method="post">
			<input type="hidden" name="rno" value="<?php echo $reply['idx']; ?>" /><input type="hidden" name="b_no" value="<?php echo $bno; ?>">
      <a class="dat_edit_bt" href="#" >수정</a>
      <a class="dat_delete_bt" href="javascript:document.reple_delete.submit()" >X</a>
			<!-- <input type="submit" value="삭제"></p> -->
 			</form>
			</div>
			<?php		} ?>
			<!-- <a class="dat_delete_bt" href="#">삭제</a> -->
		</div>
    <div class="dat_edit">
    				<form method="post" action="reply_modify_ok.php">
    					<input type="hidden" name="rno" value="<?php echo $reply['idx']; ?>" /><input type="hidden" name="b_no" value="<?php echo $bno; ?>">
    					<textarea name="content" class="dap_edit_t"><?php echo $reply['content']; ?></textarea>
    					<input type="submit" value="수정하기" class="re_mo_bt">
    				</form>
    			</div>
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

<script type="text/javascript">

  $(document).ready(function()){
    $('.like').click(function(){
      var postid = $(this).attr('id');
      alert('you clicked on' + postid);
    });
  });

</script>
  <!-- <script src="script.js"></script> -->
</body>
</html>
