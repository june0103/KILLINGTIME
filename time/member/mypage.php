
<?php
  include "../head.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="/time/css/signup_style.css" />
	    <link rel="stylesheet" href="/time/css/index_style.css">
	<script type="text/JavaScript" src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>

	<script type="text/javascript">

		function openDaumZipAddress() {

			new daum.Postcode({

				oncomplete:function(data) {

					jQuery("#postcode1").val(data.postcode1);

					jQuery("#postcode2").val(data.postcode2);

					jQuery("#zonecode").val(data.zonecode);

					jQuery("#address").val(data.address);

					jQuery("#address_etc").focus();

					console.log(data);

				}

			}).open();

		}

	</script>
<title>회원정보</title>
<!-- <style>
* {margin: 0 auto;}
a {color:#333; text-decoration: none;}
h1 {text-align: center;}
.find {text-align:left;; width:500px; margin-top:30px; }
.button {text-align: center; float:none;margin-top: 10px;}

</style> -->
</head>
<body>
	<div class="find">
		<div id="signup_area">
		<form method="post" action="member_update.php">
			<?php
				$sql = mq("select * from member where id='{$_SESSION['userid']}'");

				while($member = $sql->fetch_array()){


// $cutemail = substr($member['email'], , );

          ?>
			<h2>내 정보</h2>

<fieldset>

							<table class="list-table">
								<tbody>


									<tr>
										<td width="60" class = "name" colspan="1">아이디</td>
										<td><input type="text" size="35" name="userid" value="<?php echo $_SESSION['userid'];?>" disabled>
											<br/>

									</tr>

									<tr>
										<td class = "name">이름</td>
										<td><input type="text" size="35" name="name" placeholder="이름" value="<?php echo $member['name']; ?>"></td>

									</tr>
									<tr>
										<td class = "name">주소</td>
										<td>
											<input id="postcode1" name="postcode1" type="text,button" onclick="openDaumZipAddress()"value="<?php echo $member['postcode1']; ?>"  size="2" readonly />

										-

											<input id="postcode2" name="postcode2" type="text,button" onclick="openDaumZipAddress()" value="<?php echo $member['postcode2']; ?>" size="2" readonly />

											&nbsp;

											<input id="zonecode" name="zonecode" type="text,button" onclick="openDaumZipAddress()" placeholder="우편번호"  value="<?php echo $member['zonecode']; ?>" size="4" readonly/>

											<br/>

											<input id="address"type="text, button"  onclick="openDaumZipAddress()"name="address" value="<?php echo $member['address']; ?>" placeholder="기본주소" size="35" style="margin-bottom: 5px; margin-top:5px;" readonly required/>

											<input type="text" id="address_etc" name="addressinfo"  value="<?php echo $member['addressinfo']; ?>" placeholder="상세주소 입력" size="35" required/>
											<!-- <input type="text,button" onclick="openDaumZipAddress();" size="35" name="adress" placeholder="주소" required></td> -->
									</tr>

									<tr>
										<td class = "name">이메일</td>
										<td><input type="email" size="35" placeholder="이메일" id="email" name="email" class="check_email" value="<?php echo $member['email']; ?> " required>
											<br/>

			</tbody>
							</table>

</fieldset>

			<?php } ?>
    </div>
    <div class="button">
    <input type="submit" value="정보변경" />   <a href="../index.php"><input type="button" value="취소" /></a>
  </div>

		</form>
<hr width="100%" style=" margin-bottom:10px; " />
<h2>내가 등록한 게시물 모음</h2>
		<div id="cont_cont">

			<div class="container">

				<div class="cont">
					<div class="column col1">
						<h3>
							<span class="ico_tit">드립</spn>
						</h3>
						<p class="ico_desc"></p>

						<div class="ssul">

							<ul>

						 <?php
								$sql = mq("select * from drip where userid='{$_SESSION['userid']}'"); // board테이블에있는 idx를 기준으로 내림차순해서 %%개까지 표시

									while($board = $sql->fetch_array())
									{
										$title=$board["title"];
										if(strlen($title)>30)
										{
											$title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]); //title이 30을 넘어서면 ...표시
										}

						?>
								<li><a href="/time/drip/read.php?idx=<?php echo $board["idx"];?>"><?php echo $board['idx']; ?>&nbsp;&nbsp;<?php  echo $title;?>      </a></li>
						<?php } ?>

							</ul>

						</div>

					</div>
					<div class="column col2">
						<h3>
							<span class="ico_tit">사진</spn>
						</h3>
						<p class="ico_desc"></p>
						<div class="ssul">
							<ul>
														 <?php
																$sql = mq("select * from gallery where userid='{$_SESSION['userid']}'"); // board테이블에있는 idx를 기준으로 내림차순해서 %%개까지 표시

																	while($gallery = $sql->fetch_array())
																	{
																		$title=$gallery["title"];
																		if(strlen($title)>30)
																		{
																			$title=str_replace($gallery["title"],mb_substr($gallery["title"],0,30,"utf-8")."...",$gallery["title"]); //title이 30을 넘어서면 ...표시
																		}
															?>
																<li><a href="/time/gallery/read.php?idx=<?php echo $gallery["idx"];?>"><?php echo $gallery['idx']; ?>&nbsp;&nbsp;<?php  echo $title;?>      </a></li>
														<?php } ?>
							</ul>
						</div>
					</div>

					<div class="column col2">
						<h3>
							<span class="ico_tit">영상</spn>
						</h3>
						<p class="ico_desc"></p>
						<div class="ssul">
							<ul>
														 <?php
																$sql = mq("select * from video where userid='{$_SESSION['userid']}'"); // board테이블에있는 idx를 기준으로 내림차순해서 %%개까지 표시

																	while($video = $sql->fetch_array())
																	{
																		$title=$video["title"];
																		if(strlen($title)>30)
																		{
																			$title=str_replace($video["title"],mb_substr($video["title"],0,30,"utf-8")."...",$video["title"]); //title이 30을 넘어서면 ...표시
																		}
															?>
																<li><a href="/time/video/read.php?idx=<?php echo $video["idx"];?>"><?php echo $video['idx']; ?>&nbsp;&nbsp;<?php  echo $title;?>      </a></li>
														<?php } ?>
							</ul>
						</div>
					</div>

					<div class="column col3">
						<h3>
							<span class="ico_tit">잡담</spn>
						</h3>
						<p class="ico_desc"></p>
						<div class="ssul">
							<ul>
								<?php
									 $sql = mq("select * from talk where userid='{$_SESSION['userid']}'"); // board테이블에있는 idx를 기준으로 내림차순해서 %%개까지 표시

										 while($talk = $sql->fetch_array())
										 {
											 $title=$talk["title"];
											 if(strlen($title)>30)
											 {
												 $title=str_replace($talk["title"],mb_substr($talk["title"],0,30,"utf-8")."...",$talk["title"]); //title이 30을 넘어서면 ...표시
											 }
								 ?>
									 <li><a href="/time/drip/read.php?idx=<?php echo $talk["idx"];?>"><?php  echo $talk['idx']; ?>&nbsp;&nbsp;<?php echo $title;?>      </a></li>
							 <?php } ?>
							</ul>

						</div>
					</div>
				</div>

			</div>

		</div>


</div>
</body>
</html>
