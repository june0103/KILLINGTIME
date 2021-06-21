<!DOCTYPE html>
<?php

  include "../head.php";
?>
<html lang="ko">
  <head>
        <link rel="stylesheet" type="text/css" href="/time/css/board_style.css" />
    <style >
    #board_area {
      width: 900px;
    }
    </style>
    <meta charset="utf-8">
    <meta name="generator" content="EditPlus">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title></title>
  </head>
  <body>
 <div id="board_area">
   <h3>사진 공간</h3>
   <h4>보다보면 시간삭제 되는 꿀잼 사진 모음</h4>
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

     <table class="list-table">
       <thead>
           <tr>
               <th width="70">번호</th>
                 <th width="400">제목</th>
                 <th width="100">사진</th>
                 <th width="120">작성자</th>
                 <th width="80">작성일</th>
                  <th width="60">추천</th>
                 <th width="60">조회수</th>
             </tr>
         </thead>
         <?php

         if(isset($_GET['page'])){
              $page = $_GET['page'];
                }else{
                  $page = 1;
                }
                  $sql = mq("select * from gallery");
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




           $sql = mq("select * from gallery order by idx desc limit  $start_num, $list"); // board테이블에있는 idx를 기준으로 내림차순해서 %%개까지 표시
             while($board = $sql->fetch_array())
             {
               $title=$board["title"];
               if(mb_strlen($title,'utf-8')>35)
               {
                 $title=str_replace($board["title"],mb_substr($board["title"],0,35,"utf-8")."...",$board["title"]); //title이 30을 넘어서면 ...표시
               }
               $sql2 = mq("select * from galleryrep where con_num='".$board['idx']."'"); //reply테이블에서 con_num이 board의 idx와 같은 것을 선택
               $rep_count = mysqli_num_rows($sql2); //num_rows로 정수형태로 출력
         ?>
       <tbody>
         <tr height="70">
           <td width="70" ><?php echo $board['idx']; ?></td>
           <td width="400"><a href="read.php?idx=<?php echo $board["idx"];?>"><b><?php echo $title; ?>  <span class="re_ct">
             <?php if($rep_count ==0)
             {
             }
             else{
               ?>
                 [<?php echo $rep_count; ?>]
               <?php
             }?>
                </b></a></td>
           <!-- <span class="re_ct">[<?php echo $rep_count; ?>] -->
          <td width="100">  <a href="read.php?idx=<?php echo $board["idx"];?>"> <img src=<?php echo $board['url']; ?> width=70 height=70> </a> </td>
           <td width="120"><?php echo $board['name'];?></td>
           <td width="80"><?php

           $current = strtotime(date("Y-m-d H:i:s"));

           $diff =$current - strtotime($board['date']);

           $s = 60;
           $h = $s *60;
           $d = $h *24;

           if($diff < $s) {
             $result = '방금전';
           }
           else if($h > $diff && $diff >= $s){
             $result = round($diff/$s) . '분전';
           }
           else if($d > $diff && $diff >=$h){
             $result = round($diff/$h) . '시간전';
           }
           else{

             $result =  date('Y-m-d',strtotime($board['date']));
           }
           echo $result;

           ?></td>
           <td width="60"><?php echo $board['likes']; ?></td>
           <td width="60"><?php echo $board['hit']; ?></td>
         </tr>
       </tbody>
       <?php } ?>


     </table>

     <div id="write_btn">
       <a href="write.php"><button>글쓰기</button></a>
     </div>

     <div id="page_num">
       <ul>
         <?php
           if($page <= 1)
           { //만약 page가 1보다 크거나 같다면
             echo "<li class='fo_re'>처음</li>"; //처음이라는 글자에 색 표시
           }else{
             echo "<li><a href='?page=1'>처음</a></li>"; //알니라면 처음글자에 1번페이지로 갈 수있게 링크
           }
           if($page <= 1)
           { //만약 page가 1보다 크거나 같다면 빈값

           }else{
           $pre = $page-1; //pre변수에 page-1을 해준다 만약 현재 페이지가 3인데 이전버튼을 누르면 2번페이지로 갈 수 있게 함
             echo "<li><a href='?page=$pre'>이전페이지</a></li>"; //이전글자에 pre변수를 링크한다. 이러면 이전버튼을 누를때마다 현재 페이지에서 -1하게 된다.
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
	<!-- database에서 이미지 목록을 가져 온다. -->
	<!-- <ul>
<?php
  $sql = mq("select * from gallery order by idx desc limit  0, 10"); // gallery테이블에있는 idx를 기준으로 내림차순해서 %%개까지 표시
  while($gallery = $sql->fetch_array()){


		echo '<li style=\'float:left; margin: 2px; list-style:none;\'>';
		echo '<a href="read.php?idx='.$gallery["idx"].' "> <img src='.$gallery['url'].' width=280 height=280> </a><br>';
    echo '<b>'.$gallery['title'].'</b><br>';
    echo ($gallery['userid'].'<br>');
		echo ($gallery['file_name']);
		echo '</li>';
	}

?>

	</ul> -->

 </div>

  </body>
</html>
