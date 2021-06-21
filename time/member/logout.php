<?php
include "../db.php";

setcookie('autologin' , "" , time()-3600, "/");
setcookie('cook_userid' , "", time()-3600, "/");
setcookie('cook_userpw' , "" , time()-3600, "/");

session_destroy();
 ?>
 <meta charset="utf-8">
 <script> alert("로그아웃 되었습니다."); location.href="/time/index.php";</script>
