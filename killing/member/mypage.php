<?php
	include "../db.php";
	if(isset($_SESSION['userid'])){
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>내 정보</title>
<style>
* {margin: 0 auto;}
a {color:#333; text-decoration: none;}
h1 {text-align: center;}
.find {text-align:left;; width:500px; margin-top:30px; }
.button {text-align: center; float:none;margin-top: 10px;}

</style>
</head>
<body>
	<div class="find">
		<form method="post" action="member_update.php">
			<?php
				$sql = mq("select * from member where id='{$_SESSION['userid']}'");

				while($member = $sql->fetch_array()){

      $aa = explode("@",$member['email']) ;

// $cutemail = substr($member['email'], , );

          ?>
			<h1>내 정보</h1>

				<fieldset>
					<legend>마이페이지</legend>
						<table>
							<tr>
								<td>아이디</td>
								<td><input type="text" size="35" name="userid" value="<?php echo $_SESSION['userid'];?>" disabled></td>
							</tr>
							<tr>
								<td>비밀번호</td>
								<td><input type="password" size="35" name="userpw" placeholder="비밀번호"></td>
							</tr>
							<tr>
								<td>이름</td>
								<td><input type="text" size="35" name="name" placeholder="이름" value="<?php echo $member['name']; ?>"></td>
							</tr>
							<tr>
								<td>주소</td>
								<td><input type="text" size="35" name="adress" placeholder="주소" value="<?php echo $member['adress']; ?>"></td>
							</tr>

							<tr>
								<td>이메일</td>
								<td><input type="text" size="10" name="email" placeholder="이메일" value="<?php echo $aa[0]; ?>">@<select name="emadress"><option value="<?php echo $aa[1]; ?>"><?php echo $aa[1]; ?><option value="naver.com">naver.com</option><option value="nate.com">nate.com</option>
                <option value="hanmail.com">hanmail.com</option><option value="gmail.com">gmail.com</option></select></td>
							</tr>
						</table>

			</fieldset>
			<?php } ?>
    </div>
    <div class="button">
    <input type="submit" value="정보변경" />   <a href="../index.php"><input type="button" value="취소"</a>
  </div>

		</form>


</body>
</html>
<?php }else{
	echo "<script>alert('잘못된 접근입니다.'); history.back();</script>";
}
?>
