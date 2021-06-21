<?php
  include "../db.php";

  $bno = $_GET['idx'];
  $sql = mq("select * from board where idx='$bno';");
  $board = $sql->fetch_array();
?>
<!doctype html>
<head>
<meta charset="UTF-8">
<title>KILLING TIME - 유머글수정</title>
<link rel="stylesheet" href="../css/write_style.css" />
</head>
<body>
    <div id="board_write">
        <h1></h1>
        <h4>킬링타임 - 유머글수정</h4>
            <div id="write_area">
                <form action="modify_ok.php/<?php echo $board['idx']; ?>" method="post">
                    <input type="hidden" name="idx" value="<?=$bno?>" />
                    <div id="in_title">
                        <textarea name="title" id="utitle" rows="1" cols="55" placeholder="제목" maxlength="100" required><?php echo $board['title']; ?></textarea>
                    </div>
                    <div class="wi_line"></div>
                    <div id="in_name">
                        <textarea name="name" id="uname" rows="1" cols="55" placeholder="글쓴이" maxlength="100" required><?php echo $board['name']; ?></textarea>
                    </div>
                    <div class="wi_line"></div>
                    <div id="in_content">
                        <textarea name="content" id="ucontent" placeholder="내용" required><?php echo $board['content']; ?></textarea>
                    </div>
                        <div class="bt_se">
                        <button type="submit">글 작성</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
