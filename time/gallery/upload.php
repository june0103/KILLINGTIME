<?php
  include "../head.php";
  session_start();
 if(!$_SESSION['userid'])
 { ?>
   <script type="text/javascript">alert("로그인이 필요합니다.");</script>
   <meta http-equiv="refresh" content="0; /time/member/login.php" />

 <?php
 }
$target_dir = "/var/www/html/img/";
$imgname01 = strtolower($_FILES["fileToUpload"]["name"]);
$imgname_split = explode(".",$imgname01);
$imgname_extexplode = $imgname_split[count($imgname_split)-2.3];
$imgname_type = $imgname_split[count($imgname_split)-1];

$tates = date("mdhis", time());
$newimgname = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).$tates.".".$imgname_type;

$target_file = $target_dir . basename($newimgname);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//     $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//     if($check !== false) {
//         echo "File is an image - " . $check["mime"] . ".";
//         $uploadOk = 1;
//     } else {
//         echo "File is not an image.";
//         $uploadOk = 0;
//     }
// }
// Check if file already exists
if (file_exists($target_file)) {
    $uploadOk = 0;
    ?>

  	<script type="text/javascript">alert('Sorry, file already exists.'); history.back();</script>
    <?php
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    $uploadOk = 0;
    ?>

    <script type="text/javascript">alert('이미지 파일의 용량은 5MB이하만 등록가능합니다.'); history.back();</script>
<?php
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $uploadOk = 0;
    ?>
    <script type="text/javascript">alert('이미지파일만 등록가능합니다.'); history.back();</script>
<?php
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  ?>
    <script type="text/javascript">alert('Sorry, your file was not uploaded.'); history.back();</script>
    <?php
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {


		/*database에 업로드 정보를 기록하자.
		- 파일이름(혹은 url)
		- 파일사이즈
		- 파일형식
		*/
		$filename = $newimgname;
		$imgurl = "/img/". $newimgname;
		$size = $_FILES["fileToUpload"]["size"];
    $date = date('Y-m-d H:i:s');
    $username = $_SESSION['name'];
    $userid = $_SESSION['userid'];
    $mqq = mq("alter table gallery auto_increment =1");
		//images 테이블에 이미지정보를 저장
		$sql = mq("insert into gallery(name, title, file_name, date, userid, url, content, size) values('".$username."', '".$_POST['title']."' , '".$filename."', '".$date."', '".$userid."' , '".$imgurl."',  '".$_POST['content']."' ,'".$size."')");
    // $sql = mq("insert into drip(name,title,content,date,userid) values('".$_POST['name']."','".$_POST['title']."','".$_POST['content']."','".$date."','".$userid."')");
    ?>
    <script type="text/javascript">alert('게시물이 등록되었습니다.');</script>

    <meta http-equiv="refresh" content="0; /time/gallery/galleryList.php" />
    <?php
    } else {
        echo "<p> error uploading  file.</p>";
		echo "<br><button type='button' onclick='history.back()'>돌아가기</button>";
    }
}


?>
