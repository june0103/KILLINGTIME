<?php
	include "../signupdb.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>KILLING TIME - 회원가입</title>
	<link rel="stylesheet" type="text/css" href="/killing/css/signup_style.css" />
	<script type="text/javascript" src="jquery-3.4.1.js"></script>
	<script type="text/JavaScript" src="http://code.jquery.com/jquery-1.7.min.js"></script>

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
<script>
$(document).ready(function(e) {
	$(".check").on("keyup", function(){ //check라는 클래스에 입력을 감지
		var self = $(this);
		var userid;

		if(self.attr("id") === "userid"){
			userid = self.val();
		}

		$.post( //post방식으로 id_check.php에 입력한 userid값을 넘깁니다
			"id_check.php",
			{ userid : userid },
			function(data){
				if(data){ //만약 data값이 전송되면
					self.parent().parent().find("div").html(data); //div태그를 찾아 html방식으로 data를 뿌려줍니다.
					self.parent().parent().find("div"); //div 태그를 찾아 css효과로 빨간색을 설정합니다
				}
			}
		);
	});
});
</script>
</head>
<body>
	<form method="post" action="/killing/member/member_ok.php">
		<div id="signup_area">
		<h1>회원가입</h1>
			<fieldset>
				<legend>입력사항</legend>
				<table class="list-table">

						<tr>
							<td>아이디</td>
							<td><input type="text" size="35" name="userid" id="userid" class="check" placeholder="아이디" required></td>
							<td><div id="id_check"> 아이디 중복검사</div></td>
						</tr>
						<tr>
							<td>비밀번호</td>
							<td><input type="password" size="35" name="userpw" placeholder="비밀번호" required ></td>
						</tr>
						<tr>
							<td>비밀번호 확인</td>
							<td><input type="password" size="35" name="userpw_re" placeholder="비밀번호 확인" required ></td>
						</tr>
						<tr>
							<td>이름</td>
							<td><input type="text" size="35" name="name" placeholder="이름" required></td>
						</tr>
						<tr>
							<td>주소</td>
							<td>
								<input id="postcode1" name="postcode1" type="text,button" onclick="openDaumZipAddress()"value="" placeholder="" size="5" readonly/>

								&nbsp;-&nbsp;

								<input id="postcode2" name="postcode2" type="text,button" value="" size="5" readonly/>

								&nbsp;

								<input id="zonecode" name="zonecode" type="text,button" value="" size="15" readonly/>

								<br/>

								<input type="text" id="address" name="address" value=""size="35" style="margin-bottom: 5px; margin-top:5px;" readonly/>

								<input type="text" id="address_etc" name="addressinfo"  value="" placeholder="상세주소 입력" size="35"/>
								<!-- <input type="text,button" onclick="openDaumZipAddress();" size="35" name="adress" placeholder="주소" required></td> -->
						</tr>

						<tr>
							<td>이메일</td>
							<td><input type="text" name="email" required>@<select name="emadress"><option value="naver.com">naver.com</option><option value="nate.com">nate.com</option>
							<option value="hanmail.com">hanmail.com</option></select></td>
						</tr>

				</table>
				<div class = "button";>
				<input type="submit" value="가입하기" />      <input type="reset" value="다시쓰기" />
			</div>
		</fieldset>
	</div>
	</form>
</body>
</html>
