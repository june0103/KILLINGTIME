<?php

  include "head.php";

  if($_COOKIE[autologin] == 2)
  {
    echo  $_COOKIE[cook_userid];

    $sql = mq("select * from member where id='".$_COOKIE[cook_userid]."'");
   	$member = $sql->fetch_array();
   	$hash_pw = $member['pw']; //$hash_pw에 POSt로 받아온 아이디열의 비밀번호를 저장합니다.
   	$nick = $member['name'];

    if(password_verify($_COOKIE[cook_userpw], $hash_pw)) //만약 password변수와 hash_pw변수가 같다면 세션값을 저장하고 알림창을 띄운후 main.php파일로 넘어갑니다.
  	{
  		$_SESSION['userid'] = $member["id"];
  		$_SESSION['userpw'] = $member["pw"];
  		$_SESSION['name'] = $member["name"];


  		// if(isset($_POST['auto_login']))
  		// $master_key = "admin";
  		// $userid

  	}
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/index_style.css">
    <title></title>
  </head>
  <body>
    <div id="cont_cont">
      <div class="container">
        <div class="cont">
          <div class="column col1">
            <h3>
              <span class="ico_tit">드립</spn>
            </h3>
            <p class="ico_desc">읽다보면 시간가는줄 몰라</p>

            <div class="ssul">
              <h4>최근에 올라온 드립 모음</h4>
              <ul>

             <?php
                $sql = mq("select * from drip order by idx desc limit  0, 10"); // board테이블에있는 idx를 기준으로 내림차순해서 %%개까지 표시

                  while($board = $sql->fetch_array())
                  {
                    $title=$board["title"];
                    if(strlen($title)>30)
                    {
                      $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]); //title이 30을 넘어서면 ...표시
                    }
              ?>
                <li><a href="/time/drip/read.php?idx=<?php echo $board["idx"];?>"><?php echo $title;?>      </a></li>
            <?php } ?>



              </ul>
              <a href="/time/drip/dripList.php" class="more">+더보기</a>
            </div>

          </div>
          <div class="column col2">
            <h3>
              <span class="ico_tit">사진</spn>
            </h3>
            <p class="ico_desc">보다보면 시간가는줄 몰라</p>
            <div class="ssul">
              <h4>최근에 올라온 사진 모음</h4>
              <ul>

                             <?php
                                $sql = mq("select * from gallery order by idx desc limit  0, 10"); // board테이블에있는 idx를 기준으로 내림차순해서 %%개까지 표시

                                  while($gallery = $sql->fetch_array())
                                  {
                                    $title=$gallery["title"];
                                    if(strlen($title)>30)
                                    {
                                      $title=str_replace($gallery["title"],mb_substr($gallery["title"],0,30,"utf-8")."...",$board["title"]); //title이 30을 넘어서면 ...표시
                                    }
                              ?>
                                <li><a href="/time/gallery/read.php?idx=<?php echo $gallery["idx"];?>"><?php echo $title;?>      </a></li>
                            <?php } ?>

              </ul>
              <a href="/time/gallery/galleryList.php" class="more">+더보기</a>
            </div>
          </div>

          <div class="column col2">
            <h3>
              <!-- <span class="ico_img">icon</spn> -->
              <span class="ico_tit">영상</spn>
            </h3>
            <p class="ico_desc">보다보면 시간가는줄 몰라</p>
            <div class="ssul">
              <h4>최근에 올라온 영상 모음</h4>
              <ul>

                             <?php
                                $sql = mq("select * from video order by idx desc limit  0, 10"); // board테이블에있는 idx를 기준으로 내림차순해서 %%개까지 표시

                                  while($video = $sql->fetch_array())
                                  {
                                    $title=$video["title"];
                                    if(strlen($title)>30)
                                    {
                                      $title=str_replace($video["title"],mb_substr($video["title"],0,30,"utf-8")."...",$video["title"]); //title이 30을 넘어서면 ...표시
                                    }
                              ?>
                                <li><a href="/time/video/read.php?idx=<?php echo $video["idx"];?>"><?php echo $title;?>      </a></li>
                            <?php } ?>

              </ul>
              <a href="/time/video/videoList.php" class="more">+더보기</a>
            </div>
          </div>

          <div class="column col3">
            <h3>
              <!-- <span class="ico_img">icon</spn> -->
              <span class="ico_tit">잡담</spn>
            </h3>
            <p class="ico_desc">아무말이나 적어봐!!</p>
            <div class="ssul">
              <h4>최근에 올라온 잡담 모음</h4>
              <ul>
                <?php
                   $sql = mq("select * from talk order by idx desc limit  0, 10"); // board테이블에있는 idx를 기준으로 내림차순해서 %%개까지 표시

                     while($talk = $sql->fetch_array())
                     {
                       $title=$talk["title"];
                       if(strlen($title)>30)
                       {
                         $title=str_replace($talk["title"],mb_substr($talk["title"],0,30,"utf-8")."...",$talk["title"]); //title이 30을 넘어서면 ...표시
                       }
                 ?>
                   <li><a href="/time/drip/read.php?idx=<?php echo $talk["idx"];?>"><?php echo $title;?>      </a></li>
               <?php } ?>
              </ul>
              <a href="/time/talk/talkList.php" class="more">+더보기</a>
            </div>

          </div>
    <hr width="100%" style="margin-bottom:30px;"   />

          <div class="column col4">
            <h3>
              <span class="ico_tit">NAVER</spn>
            </h3>
            <p class="ico_desc">실시간 검색순위</p>

            <div class="ssul">
              <h4></h4>
              <?php

              include '../simplehtmldom_1_9_1/simple_html_dom.php';

              $html = file_get_html('https://www.naver.com');

              // $a = $html -> find('div.PM_CL_realtimeKeyword_list_base>ul');
              $a = $html -> find('div.PM_CL_realtimeKeyword_list_base>ul');

              $c = $html -> find('div.ah_info');

              foreach($a as $b){
                echo $b;
                echo "<br>";
              }
              foreach($c as $d){
                echo $d;
                echo "<br>";
              }

               ?>

            </div>

          </div>



          <div class="column col4">
            <h3>
              <span class="ico_tit">DAUM</spn>
            </h3>
            <p class="ico_desc">실시간 검색순위</p>

            <div class="ssul">
              <h4></h4>
              <?php

              include 'simplehtmldom_1_9_1/simple_html_dom.php';

              $html = file_get_html('https://www.daum.net/');

              $a = $html -> find('div.realtime_part>ol');

              foreach($a as $b){
                echo $b;
                echo "<br>";
              }

               ?>

            </div>

          </div>


          <div class="column col4">
            <h3>
              <span class="ico_tit">ZUM</spn>
            </h3>
            <p class="ico_desc">실시간 검색순위</p>

            <div class="ssul">
              <h4></h4>
              <?php

              include 'simplehtmldom_1_9_1/simple_html_dom.php';

              $html = file_get_html('http://www.zum.com/#!/home');

              $a = $html -> find('div.issue_keyword_total>div.list_body>ul');

              foreach($a as $b){
                echo $b;
                echo "<br>";
              }

               ?>

            </div>

          </div>

          <div class="column col5">
            <h3>
              <span class="ico_tit">NATE</spn>
            </h3>
            <p class="ico_desc">실시간 검색순위</p>

            <div class="ssul">
              <h4></h4>
              <?php

              include 'simplehtmldom_1_9_1/simple_html_dom.php';

              $html = file_get_html('https://search.daum.net/nate?w=tot&q=');

              $a = $html -> find('div.content_realtime>div.coll_cont>div.wrap_rank');

              foreach($a as $b){
                echo $b;
                echo "<br>";
              }

               ?>

            </div>

          </div>

        </div>

      </div>

    </div>


  </body>
</html>
