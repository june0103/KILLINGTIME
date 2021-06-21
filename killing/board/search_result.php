

<html>
<head>
  <?php
    include "../db.php";
  ?>
<meta charset="UTF-8">
<title>KILLING TIME - 유머글모음</title>
<link rel="stylesheet" type="text/css" href="/killing/css/board_style.css" />
</head>
<body>
<div id="board_area">

<?php
  /* 검색 변수 */
  $catagory = $_GET['catagory'];
  $search_con = $_GET['search'];
?>
  <h2>유머글모음</h2>
  <h4>읽다보면 시간삭제 되는 꿀잼 썰모음</h4>
  <h5><?php echo $catagory; ?>에서 '<?php echo $search_con; ?>'검색결과</h1>

    <table class="list-table">
      <thead>
          <tr>
              <th width="70">번호</th>
                <th width="500">제목</th>
                <th width="120">글쓴이</th>
                <th width="100">작성일</th>
                <th width="100">조회수</th>
            </tr>
        </thead>
        <?php
          $sql2 = mq("select * from board where $catagory like '%$search_con%' order by idx desc");
          while($board = $sql2->fetch_array()){

          $title=$board["title"];
            if(strlen($title)>30)
              {
                $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
              }
            $sql3 = mq("select * from reply where con_num='".$board['idx']."'");
            $rep_count = mysqli_num_rows($sql3);
        ?>
      <tbody>
        <tr>
          <td width="70"><?php echo $board['idx']; ?></td>

        <!--- 추가부분 18.08.01 END -->
        <a href='read.php?idx=<?php echo $board["idx"]; ?>'><span style="background:yellow;"><?php echo $title; }?></span><span class="re_ct">[<?php echo $rep_count;?>]<?php echo $img; ?> </span></a></td>
          <td width="120"><?php echo $board['name']?></td>
          <td width="100"><?php echo $board['date']?></td>
          <td width="100"><?php echo $board['hit']; ?></td>

        </tr>
      </tbody>

      <?php } ?>
    </table>
    <!-- 18.10.11 검색 추가 -->
    <div id="search_box2">
      <form action="search_result.php" method="get">
      <select name="catagory">
        <option value="title">제목</option>
        <option value="name">글쓴이</option>
        <option value="content">내용</option>
      </select>
      <input type="text" name="search" size="40" required="required"/> <button>검색</button>
    </form>
  </div>
</div>
</body>
</html>
