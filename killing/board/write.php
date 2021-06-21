<?php
include "../test.php"; ?>
<?php
 session_start();
if(!$_SESSION['userid'])
{ ?>
  <script type="text/javascript">alert("로그인이 필요합니다.");</script>
  <meta http-equiv="refresh" content="0; /killing/main1.php" />

<?php
}
 ?>
<!doctype html>
<head>
<meta charset="UTF-8">
<title>KILLING TIME - 유머글작성</title>
<link rel="stylesheet" type="text/css" href="/killing/css/write_style.css" />
</head>
<body>

    <div id="board_write">
        <h1>킬링타임 - 유머글작성</h1>

            <div id="write_area">
              <fieldset>
                <form action="write_ok.php" method="post">
                    <div id="in_title">
                        <textarea name="title" id="utitle" rows="1" cols="55" placeholder="제목" maxlength="100" required></textarea>
                    </div>
                    <div class="wi_line"></div>
                    <div id="in_name">
                        <input type="hidden" name="name" id="uname" value="<?=$_SESSION['name']?>" rows="1" cols="55" placeholder="글쓴이" maxlength="100" required><?=$_SESSION['name']?></textarea>
                    </div>
                    <div class="wi_line"></div>
                    <div id="in_content">
                        <textarea name="content" id="ucontent" placeholder="내용" required></textarea>
                    </div>
                    <!-- <div id="in_pw">
                        <input type="password" name="pw" id="upw"  placeholder="비밀번호" required />
                    </div> -->
                    </fieldset>
                    <div class="bt_se">
                        <button type="submit">글 작성</button>
                        <a href="boardlist.php"><input type="button" value="취소"></button>
                    </div>
                </form>
            </div>

        </div>

    </body>
</html>
