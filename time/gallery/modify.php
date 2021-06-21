<?php

  include "../head.php";

  $bno = $_GET['idx'];
  $sql = mq("select * from gallery where idx='$bno';");
  $gallery = $sql->fetch_array();
?>
<!doctype html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/JavaScript" src="http://code.jquery.com/jquery-1.7.min.js"></script>
<script type="text/javascript" src="jquery-3.4.1.js"></script>

<link rel="stylesheet" href="../css/write_style.css" />
<style type="text/css">
  .img_wrap{
    width: 300px;
  }
  .img_wrap img{
    max-width: 50%;
  }
</style>


<script type="text/javascript">
  var sel_file;

  $(document).ready(function(){
    $("#fileToUpload").on("change", handleImgFileSelect);
  });

  function handleImgFileSelect(e) {
    var files = e.target.files;
    var filesArr = Array.prototype.slice.call(files);

    filesArr.forEach(function(f) {
      sel_file = f;

      var reader = new FileReader();
      reader.onload = function(e) {
        $("#img").attr("src",e.target.result);
      }
      reader.readAsDataURL(f);
    });
  }
</script>
</head>
<body>

  <div id="board_write">
      <h3>꿀잼 사진 등록하기</h3>

          <div id="write_area">
            <fieldset>
              <form action="modify_ok.php/<?php echo $gallery['idx']; ?>" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="idx" value="<?=$bno?>" />
                  <div id="in_title">
                    <textarea name="title" id="utitle" rows="1" cols="55" placeholder="제목" maxlength="100" required><?php echo $gallery['title']; ?></textarea>
                  </div>
                  <div class="wi_line"></div>


                  <div id="in_gcontent">
                      <textarea name="content" id="ucontent" placeholder="내용" required><?php echo $gallery['content']; ?></textarea>
                  </div>


                    <div>

                      <input type="file" name="fileToUpload" id="fileToUpload" value="사진첨부">
                    </div>
                    <div>
                      <div class="img_wrap">
                        <img id="img" <?php echo '<img src='.$gallery['url'].' width=280 height=280>'; ?>  


                      </div>
                    </div>




                  <!-- <div id="in_pw">
                      <input type="password" name="pw" id="upw"  placeholder="비밀번호" required />
                  </div> -->
                  </fieldset>
                  <div class="bt_se">
                      <button type="submit">글 작성</button>
                      <a href="galleryList.php"><input type="button" value="취소"></button>
                  </div>
              </form>
          </div>

      </div>

    </body>
</html>
