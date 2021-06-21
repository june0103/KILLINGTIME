<?php
  include "../db.php";

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
  // if (file_exists($target_file)) {
  //     echo "Sorry, file already exists.";
  //     $uploadOk = 0;
  // }
  // // Check file size
  // if ($_FILES["fileToUpload"]["size"] > 5000000) {
  //     echo "Sorry, your file is too large.";
  //     $uploadOk = 0;
  // }
  // // Allow certain file formats
  // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  // && $imageFileType != "gif" ) {
  //     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  //     $uploadOk = 0;
  // }
  // // Check if $uploadOk is set to 0 by an error
  // if ($uploadOk == 0) {
  //     echo "Sorry, your file was not uploaded.";
  // // if everything is ok, try to upload file
  // } else
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {


  		/*database에 업로드 정보를 기록하자.
  		- 파일이름(혹은 url)
  		- 파일사이즈
  		- 파일형식
  		*/
  		$filename = $newimgname;
  		$imgurl = "/img/". $_FILES["fileToUpload"]["name"];
  		$size = $_FILES["fileToUpload"]["size"];
      $date = date('Y-m-d H:i:s');
      $username = $_SESSION['name'];
      $userid = $_SESSION['userid'];
      $bno = $_POST['idx'];
      $sql = mq("update gallery set name='".$username."',title='".$_POST['title']."',content='".$_POST['content']."',file_name='".$filename."',url='".$imgurl."',size='".$size."' where idx='".$bno."'");
  		//images 테이블에 이미지정보를 저장
      ?>

      <script type="text/javascript">alert("수정되었습니다.");</script>
      <meta http-equiv="refresh" content="0 url=/time/gallery/read.php?idx=<?php echo $bno; ?>">
      <?php
      // $sql = mq("insert into drip(name,title,content,date,userid) values('".$_POST['name']."','".$_POST['title']."','".$_POST['content']."','".$date."','".$userid."')");
    }

?>
