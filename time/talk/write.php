<?php
  include "../head.php";
	?>
<?php
 session_start();
if(!$_SESSION['userid'])
{ ?>
  <script type="text/javascript">alert("로그인이 필요합니다.");</script>
  <meta http-equiv="refresh" content="0; /time/member/login.php" />

<?php
}
 ?>
<!doctype html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/time/css/write_style.css" />
<script type="text/javascript" src = "smarteditor/demo/js/service/HuskyEZCreator.js" charset="utf-8">
</script>
</head>
<body>

    <div id="board_write">
        <h3>아무말이나 적어봐!!</h3>

            <div id="write_area">
              <fieldset>
                <form action="write_ok.php" method="post">
                    <div id="in_title">
                        <textarea name="title" id="utitle" rows="1" cols="55" placeholder="제목" maxlength="100" required></textarea>
                    </div>
                    <div class="wi_line"></div>


                    <div id="in_content">
                        <textarea name="content" id="ucontent" placeholder="내용" required></textarea>
                    </div>

                    <script type="text/javascript">
                    var oEditors = [];
                      nhn.husky.EZCreator.createInIFram({
                        oAppRef : oEditors,
                        elPlaceHolder: "content",
                        sSkinURI: "smarteditor/demo/SmartEditor2.html",
                        fCreator: "createSEditor2",
                      });
                    </script>
                    <!-- <div id="in_pw">
                        <input type="password" name="pw" id="upw"  placeholder="비밀번호" required />
                    </div> -->
                    </fieldset>
                    <div class="bt_se">
                        <button type="submit">글 작성</button>
                        <a href="dripList.php"><input type="button" value="취소"></button>
                    </div>
                </form>
            </div>

        </div>

    </body>
</html>
