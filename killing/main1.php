
<?php
include "/db.php"; ?>
<!DOCTYPE html>
<head>
	<meta charset="utf-8" />
	<title>KILLING TIME - 로그인</title>
<link rel="stylesheet" type="text/css" href="/killing/css/common.css" />
</head>
<body>
	<h1>KILLING TIME</h1>

	<div id="login_box">
		<h2>로그인</h2>
			<form method="post" action="/killing/member/login_ok.php">
				<table align="center" border="0" cellspacing="0" width="300">
        			<tr>
            			<td width="130" colspan="1">
                		<input type="text" name="userid" class="inph" placeholder="아이디">
            		</td>

            		<td rowspan="2" align="center" width="100" >
                		<button type="submit" id="btn" >로그인</button>
            		</td>
        		</tr>
        		<tr>
            		<td width="130" colspan="1">
               		<input type="password" name="userpw" class="inph" placeholder="비밀번호">
            	</td>
        	</tr>
					<tr>
						<td colspan="3" align="center" width="">
							<input type="checkbox" name="auto_login" value="2">자동로그인
						</td>
					</tr>
        	<tr>
           		<td colspan="3" align="center" class="mem" >
              	<a href="/killing/member/member.php">회원가입 하시겠습니까?</a>
           </td>
					   </tr>
					 <tr>
					 <td colspan="3" align="center" class="mem">
						 <a href="/killing/member/member_find.php">아이디찾기</a>
							/
							<a href="/killing/member/member_find_pw.php">비밀번호찾기</a>
							 </td>
        </tr>
    </table>
  </form>
</div>
</body>
</html>
