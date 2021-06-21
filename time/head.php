<?php
include "db.php";



?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="utf-8">
  <title> 내시간.. 어디갔지?</title>
  <style type="text/css">
  /* a:link  {color: black;  text-decoration: none;  }
  a:visited  {color:black;    text-decoration: none;  }
  a:hover {color:#4aa8d4;} */
  </style>
<link rel="stylesheet" href="/time/css/head.css">

<link href="https://fonts.googleapis.com/css?family=McLaren&display=swap" rel="stylesheet">

</head>
<body>
  <div id="wrap">
    <div id="header">
      <div class="container">
        <div class="header">
          <div class="header-menu">

            <?php
              if($_SESSION['userid']){
                echo "{$_SESSION['name']} 님 환영합니다.";
              ?>

              <a href="/time/member/logout.php">로그아웃</a>

              <a href="/time/member/mypage.php">회원정보</a>

              <?php
            }else{
                // echo "<script>alert('잘못된 접근입니다.'); </script>";
              ?>
              <a href="/time/member/login.php">로그인</a>
              <a href="/time/member/signup.php">회원가입</a>
              <?php } ?>
            <!-- <a href="/time/member/login.php">로그인</a>
            <a href="/time/member/member.php">회원가입</a> -->
          </div>
          <div class="header-tit">
            <h1><a href="/time/index.php">KILLING TIME</a></h1>
          </div>
        </div>
      </div>
    </div>

    </div>

    <div id="contents">
              <div id="cont_nav">
                  <div class="container">
                      <div class="nav">
                          <div>
                              <h2><a href="/time/drip/dripList.php">드립 공간</a></h2>
                          </div>
                          <div>
                              <h2><a href="/time/gallery/galleryList.php">사진 공간</a></h2>
                          </div>
                          <div>
                              <h2><a href="/time/video/videoList.php">영상 공간</a></h2>
                          </div>
                          <div>
                              <h2><a href="/time/talk/talkList.php">잡담 공간</a></h2>
                          </div>
                          <hr width="100%"   />
                          <!-- <style scoped="scoped">
                          @-webkit-keyframes animated-width {
                            from{
                              width:50%;
                            }
                            to{
                              width: 100%;
                            }
                          }
                          hr.animated-width{
                            height: 3px;
                            border : 0;
                            text-align: right;
                            background-color: #4aa8d4;
                            -webkit-animation-name: animated-width;
                            -webkit-animation-iteration-count:infinite;
                            -webkit-animation-duration:3.0s;
                            -webkit-animation-timing-function:ease-out;
                          }
                          </style>
                          <hr class="animated-width"/> -->
                      </div>

                  </div>
              </div>
              <!-- //cont_nav -->

</body>
