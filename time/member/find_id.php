<?php
  include "../logo.php";
?>
<?php
  include "../db.php";
  $username = $_POST['name'];
  $email = $_POST['email'];


  $sql = mq("select * from member where name = '{$username}' && email = '{$email}'");
  $result = $sql->fetch_array();

  if($result["name"] == $username){
    echo "<script>alert('회원님의 ID는 ".$result['id']."입니다.');</script>";
     ?>

    <!-- <script type="text/javascript">alert("글쓰기 완료되었습니다.");</script> -->
    <meta http-equiv="refresh" content="0; login.php" />

  <?php
  }else{
    echo "<script>alert('없는 계정입니다.');</script>";
     ?>

    <!-- <script type="text/javascript">alert("글쓰기 완료되었습니다.");</script> -->
    <meta http-equiv="refresh" content="0; login.php" />

    <?php
  }
  ?>
