<?php

  include "../head.php";

  $bno = $_GET['idx'];
  $sql = mq("select * from video where idx='$bno';");
  $video = $sql->fetch_array();
?>
<!doctype html>
<head>
<meta charset="UTF-8">

<link rel="stylesheet" href="../css/write_style.css" />
</head>
<body>
    <div id="board_write">
        <h1></h1>
                <h3>꿀잼 영상 수정하기</h3>
            <div id="write_area">
                <form action="modify_ok.php/<?php echo $video['idx']; ?>" method="post">
                    <input type="hidden" name="idx" value="<?=$bno?>" />
                    <div id="in_title">
                        <textarea name="title" id="utitle" rows="1" cols="55" placeholder="제목" maxlength="100" required><?php echo $video['title']; ?></textarea>
                    </div>
                    <div class="wi_line"></div>

                    <div id="in_vcontent">
                      <textarea name="url" placeholder="유튜브 URL입력" rows="1" size="40"required ><?php echo $video['fullurl']; ?></textarea>
                    </div>
                    <div class="wi_line"></div>
                    <div id="in_content">
                        <textarea name="content" id="ucontent" placeholder="내용" required><?php echo $video['content']; ?></textarea>
                    </div>
                        <div class="bt_se">
                        <button type="submit">글 작성</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
