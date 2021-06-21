<?php
include "signupdb.php";
  ?>
<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta name="author" content="june">
    <meta name="description" content="killing time">
    <title>KILLING TIME</title>

    <!--  CSS style -->
    <link rel="stylesheet" href="/killing/css/reset.css">
    <link rel="stylesheet" href="/killing/css/index_style.css">
  </head>
  <body>
    <!--  스킵 네비게이션 -->
    <!-- <div id="skip">
        <a rel="bookmark" href="#cont_nav">전체 메뉴 바로가기</a>
        <a rel="bookmark" href="#cont_ban">배너 영역 바로가기</a>
        <a rel="bookmark" href="#cont_cont">컨텐츠 영역 바로가기</a>
    </div> -->

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
        									  <a href="/killing/main1.php">Login</a>
                               /
                            <a href="/killing/member/member.php">SignUp</a>
        									<?php } ?>
                    </div>
                    <!--웹 제목  -->
                    <div class="header-tit">
                      <h1>
                        <a href="index.php">
                          KILLING TIME</a>
                        </h1>
                    </div>
                </div>
            </div>
      </div>
      <!-- header -->

      <div id="contents">
        <!-- cont_nav -->
            <div id="cont_nav">
                <div class="container">
                    <h2 class = "ir_su">전체메뉴</h2>
                    <div class="nav">
                        <div >
                            <a href="board/boardlist.php"><h3>글모음</h3>
                            <!-- <ol>
                                <li><a href="#">글 메뉴1</a></li>
                                <li><a href="#">글 메뉴2</a></li>
                                <li><a href="#">글 메뉴3</a></li>
                                <li><a href="#">글 메뉴4</a></li>
                            </ol> -->
                        </div>
                        <div >
                            <a href="#"><h3>짤모음</h3>
                            <!-- <ol>
                                <li><a href="#">짤 메뉴1</a></li>
                                <li><a href="#">짤 메뉴2</a></li>
                                <li><a href="#">짤 메뉴3</a></li>
                                <li><a href="#">짤 메뉴4</a></li>
                            </ol> -->
                        </div>
                        <div>
                            <a href="#"><h3>자유게시판</h3></a>
                        </div>
                    </div>
                    <div></div>
                    <div></div>
                </div>
            </div>
            <!-- cont_tit -->
            <div id="cont_tit">
                <div class="container">    </div>
            </div>
            <!-- cont_ban -->
            <div id="cont_ban">
                <div class="container">    </div>
            </div>
            <!-- cont_cont -->
            <div id="cont_cont">
                <div class="container">    </div>
            </div>
      </div>
      <div id="footer">
        <div class="container"></div>
      </div>
    </div>

  </body>
</html>
