<?php
	include "../db.php";
?>
<?php
  include "../logo.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>KILLING TIME - 회원가입</title>
	<link rel="stylesheet" type="text/css" href="/time/css/signup_style.css" />
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

<!-- id -->
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

<!-- pw -->
<script>
$(document).ready(function(e) {
	$(".checkpw").on("keyup", function(){ //check라는 클래스에 입력을 감지
		var self = $(this);
		var userpw;

		if(self.attr("id") === "userpw"){
			userpw = self.val();
		}

		$.post( //post방식으로 id_check.php에 입력한 userid값을 넘깁니다
			"pw_check.php",
			{ userpw : userpw },
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


<script>
$(document).ready(function(e) {
	$(".checkpw_re").on("keyup", function(){ //check_re라는 클래스 입력 감지
		var self = $(this);
		var userpw_re;

		if(self.attr("id") === "userpw_re"){
			userpw_re = self.val();
		}

		$.post( //post방식으로 id_check.php에 입력한 userid값을 넘깁니다
			"pw_re_check.php",
			{ userpw_re : userpw_re },
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


<script>
$(document).ready(function(e) {
	$(".check_email").on("keyup", function(){ //check라는 클래스에 입력을 감지
		var self = $(this);
		var email;

		if(self.attr("id") === "email"){
			email = self.val();
		}

		$.post( //post방식으로 id_check.php에 입력한 userid값을 넘깁니다
			"email_check.php",
			{ email : email },
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
	<form method="post" action="/time/member/signup_ok.php">
		<div id="signup_area">
		<h1>회원가입</h1>
			<fieldset>
				<!-- <legend>입력사항</legend> -->
				<table class="list-table">
					<tbody>


						<tr>
							<td class = "name" colspan="1">아이디</td>
							<td><input type="text" size="35" name="userid" id="userid" class="check" placeholder="아이디" required>
								<br/>
							<div id="id_check"  style="color:red"> 아이디를 입력해주세요.</div></td>

						</tr>
						<tr>
							<td class = "name">비밀번호</td>
							<td><input type="password" size="35" name="userpw" id="userpw" class="checkpw" placeholder="비밀번호" required >
								<br/>
							<div id="pw_check" style="color:red"> 비밀번호를 입력해주세요.</div></td>
						</tr>
						<tr>
							<td class = "name">비밀번호 확인</td>
							<td><input type="password" size="35" name="userpw_re" id="userpw_re" class="checkpw_re" placeholder="비밀번호 확인" required >
								<br/>
							<div id="pwre_check" style="color:red"> 비밀번호 확인을 입력해주세요.</div></td>
						</tr>
						<tr>
							<td class = "name">이름</td>
							<td><input type="text" size="35" name="name" id="name" placeholder="이름" required></td>
						</tr>
						<tr>
							<td class = "name">주소</td>
							<td>
								<input id="postcode1" name="postcode1" type="text,button" onclick="openDaumZipAddress()"value="" placeholder="" size="2" readonly required/>

							-

								<input id="postcode2" name="postcode2" type="text,button" onclick="openDaumZipAddress()" value="" size="2" readonly required/>

								&nbsp;

								<input id="zonecode" name="zonecode" type="text,button" onclick="openDaumZipAddress()" placeholder="우편번호"  value="" size="4" readonly required/>

								<br/>

								<input id="address"type="text, button"  onclick="openDaumZipAddress()"name="address" value="" placeholder="기본주소" size="35" style="margin-bottom: 5px; margin-top:5px;" readonly required/>

								<input type="text" id="address_etc" name="addressinfo"  value="" placeholder="상세주소 입력" size="35" required/>
								<!-- <input type="text,button" onclick="openDaumZipAddress();" size="35" name="adress" placeholder="주소" required></td> -->
						</tr>

						<tr>
							<td class = "name">이메일</td>
							<td><input type="email" size="35" placeholder="이메일" id="email" name="email" class="check_email" required>
								<br/>
							<div id="email_check" style="color:red"> 이메일을 입력해주세요.</div>
								<!-- @<select name="emadress"><option value="naver.com">naver.com</option><option value="nate.com">nate.com</option>
							<option value="hanmail.com">hanmail.com</option></select></td> -->
						</tr>
</tbody>
				</table>
				<div class = "button";>
				<input type="submit" value="가입하기" />
				<!-- <input type="reset" value="다시쓰기" /> -->
			</div>
		</fieldset>
	</div>
	</form>
</body>
</html>
