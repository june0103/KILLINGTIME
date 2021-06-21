<?php
  include "../db.php";
  if(isset($_SESSION['userid'])){
    echo "<script>alert('잘못된 접근입니다.'); history.back();</script>";
  }else{ ?>
<!DOCTYPE html>
<head>
<meta charset="utf-8" />
<title>KILLING TIME - 계정찾기</title>
<style>
* {margin: 0 auto;}
a {color:#333; text-decoration: none;}
.find {text-align:center; width:500px; margin-top:30px; }
.button {margin-top: 20px;}
h1 {margin-bottom: 20px;}
td {text-align: left;}
</style>
</head>
<body>
  <div class="find">
    <form method="post" action="find_id.php">
      <h1>회원계정 찾기</h1>

        <fieldset>
          <legend>아이디 찾기</legend>
            <table>
              <tr>
                <td>이름</td>
                <td><input type="text" size="35" name="name" placeholder="이름" required></td>
              </tr>
              <tr>
                <td>이메일</td>
                <td><input type="text" name="email" required>@<select name="emadress"><option value="naver.com">naver.com</option><option value="nate.com">nate.com</option>
                <option value="hanmail.com">hanmail.com</option><option value="gmail.com">gmail.com</option></select></td>
              </tr>
            </table>
          <input type="submit" value="아이디 찾기" />
      </fieldset>
      <div class="button">
        <p><a href="../main1.php"><input type="button" value="취소"</a></p>
      </div>
    </form>
  </div>
  
</body>
</html>
<?php } ?>
