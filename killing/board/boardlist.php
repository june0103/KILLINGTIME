<?php
  include "../db.php";
?>
<!doctype html>
<head>
<meta charset="UTF-8">
<title>KILLING TIME - 유머글모음</title>
<link rel="stylesheet" type="text/css" href="/killing/css/board_style.css" />
</head>
<body>
  <div id="wrap">
  <div id="header">
      <div class="container">
          <div class="header">

            <!-- 헤더메뉴  -->
              <div class="header-menu">
                  <!-- <a href="/killing/main1.php">Login / SignUp</a> -->
                  <?php
                    if($_SESSION['userid']){
                      echo "{$_SESSION['name']} 님 환영합니다.";
                    ?>
                    <a href="/killing/member/logout.php"><input type="button" value="로그아웃" /></a>

                    <a href="/killing/member/mypage.php"><input type="button" value="정보수정" /></a>
                    <?php
                  }else{
                      // echo "<script>alert('잘못된 접근입니다.'); </script>";
                    ?>
                      <a href="/killing/main1.php">Login / SignUp</a>
                    <?php } ?>
              </div>
              <!--웹 제목  -->
              <div class="header-tit">
                <h1>
                  <a href="../index.php">
                    KILLING TIME</a>
                  </h1>
              </div>
          </div>
      </div>
</div>
</div>
<div id="board_area">

  <h2>유머글모음</h2>
  <h4>읽다보면 시간삭제 되는 꿀잼 썰모음</h4>
  <!-- 검색시작 -->
<div id="search_box">
  <form action="search_result.php" method="GET">
    <select name="catagory">
      <option value="title">제목</option>
      <option value="name">글쓴이</option>
      <option value="content">내용</option>
    </select>
    <input type="text" name="search" size="40" required="required" /> <button>검색</button>
  </form>
  </div>
  <!-- 검색끝 -->
    <table class="list-table">
      <thead>
          <tr>
              <th width="70">번호</th>
                <th width="500">제목</th>
                <th width="120">작성자</th>
                <th width="100">작성일</th>
                <th width="100">조회수</th>
            </tr>
        </thead>
        <?php
        if(isset($_GET['page'])){
             $page = $_GET['page'];
               }else{
                 $page = 1;
               }
                 $sql = mq("select * from board");
                 $row_num = mysqli_num_rows($sql); //게시판 총 레코드 수
                 $list = 10; //한 페이지에 보여줄 개수
                 $block_ct = 5; //블록당 보여줄 페이지 개수

                 $block_num = ceil($page/$block_ct); // 현재 페이지 블록 구하기
                 $block_start = (($block_num - 1) * $block_ct) + 1; // 블록의 시작번호
                 $block_end = $block_start + $block_ct - 1; //블록 마지막 번호

                 $total_page = ceil($row_num / $list); // 페이징한 페이지 수 구하기
                 if($block_end > $total_page) $block_end = $total_page; //만약 블록의 마지박 번호가 페이지수보다 많다면 마지박번호는 페이지 수
                 $total_block = ceil($total_page/$block_ct); //블럭 총 개수
                 $start_num = ($page-1) * $list; //시작번호 (page-1)에서 $list를 곱한다.




          $sql = mq("select * from board order by idx desc limit  $start_num, $list"); // board테이블에있는 idx를 기준으로 내림차순해서 %%개까지 표시
            while($board = $sql->fetch_array())
            {
              $title=$board["title"];
              if(strlen($title)>30)
              {
                $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]); //title이 30을 넘어서면 ...표시
              }
              $sql2 = mq("select * from reply where con_num='".$board['idx']."'"); //reply테이블에서 con_num이 board의 idx와 같은 것을 선택
              $rep_count = mysqli_num_rows($sql2); //num_rows로 정수형태로 출력
        ?>
      <tbody>
        <tr>
          <td width="70"><?php echo $board['idx']; ?></td>
          <td width="500"><a href="read.php?idx=<?php echo $board["idx"];?>"><b><?php echo $title;?><span class="re_ct">[<?php echo $rep_count; ?>]</b></a></td>
          <td width="120"><?php echo $board['name'];?></td>
          <td width="100"><?php echo $board['date'];?></td>
          <td width="100"><?php echo $board['hit']; ?></td>
        </tr>
      </tbody>
      <?php } ?>
    </table>
    <div id="page_num">
      <ul>
        <?php
          if($page <= 1)
          { //만약 page가 1보다 크거나 같다면
            echo "<li class='fo_re'>처음</li>"; //처음이라는 글자에 빨간색 표시
          }else{
            echo "<li><a href='?page=1'>처음</a></li>"; //알니라면 처음글자에 1번페이지로 갈 수있게 링크
          }
          if($page <= 1)
          { //만약 page가 1보다 크거나 같다면 빈값

          }else{
          $pre = $page-1; //pre변수에 page-1을 해준다 만약 현재 페이지가 3인데 이전버튼을 누르면 2번페이지로 갈 수 있게 함
            echo "<li><a href='?page=$pre'>이전</a></li>"; //이전글자에 pre변수를 링크한다. 이러면 이전버튼을 누를때마다 현재 페이지에서 -1하게 된다.
          }
          for($i=$block_start; $i<=$block_end; $i++){
            //for문 반복문을 사용하여, 초기값을 블록의 시작번호를 조건으로 블록시작번호가 마지박블록보다 작거나 같을 때까지 $i를 반복시킨다
            if($page == $i){ //만약 page가 $i와 같다면
              echo "<li class='fo_re'>[$i]</li>"; //현재 페이지에 해당하는 번호에 굵은 빨간색을 적용한다
            }else{
              echo "<li><a href='?page=$i'>[$i]</a></li>"; //아니라면 $i
            }
          }
          if($block_num >= $total_block){ //만약 현재 블록이 블록 총개수보다 크거나 같다면 빈 값
          }else{
            $next = $page + 1; //next변수에 page + 1을 해준다.
            echo "<li><a href='?page=$next'>다음</a></li>"; //다음글자에 next변수를 링크한다. 현재 4페이지에 있다면 +1하여 5페이지로 이동하게 된다.
          }
          if($page >= $total_page){ //만약 page가 페이지수보다 크거나 같다면
            echo "<li class='fo_re'>마지막</li>"; //마지막 글자에 긁은 빨간색을 적용한다.
          }else{
            echo "<li><a href='?page=$total_page'>마지막</a></li>"; //아니라면 마지막글자에 total_page를 링크한다.
          }
        ?>
      </ul>
    </div>

    <div id="write_btn">
      <a href="write.php"><button>글쓰기</button></a>
    </div>

  </div>
</body>
</html>
