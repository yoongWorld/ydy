<?php
session_start();
include "../lib/dbconn.php";
ini_set('display_errors', 0);
?>
<meta charset="utf-8">
<?php

if(isset($_POST["level"]))$level = $_POST["level"];
if(isset($_POST["u_id"]))$u_id = $_POST["u_id"];
if(isset($_POST["u_pwd"]))$u_pwd = $_POST["u_pwd"];

  if(trim($_POST['u_id']) == ""){
    ?>
    <script>
        alert("아이디를 입력해 주세요.");
        location.href = 'login.php';
    </script>
    <?php
    exit;
}
if($_POST['u_pwd'] == ""){
    ?>
    <script>
        alert("비밀번호를 입력해 주세요.");
        location.href = 'login.php';
    </script>
    <?php
    exit;
}

  $sql="select * from member where u_id='$u_id'";
  $result=mysqli_query($conn, $sql);
  $num_match=mysqli_num_rows($result);

  if(!$num_match){
?>
      <script>
        window.alert('등록되지 않는 아이디입니다.');
        location.href = 'login.php';
      </script>
<?php
  }else{
    $row=mysqli_fetch_array($result);
    $db_pass=$row['u_pwd'];
    if($u_pwd!=$db_pass){
?>
        <script>
          window.alert('비밀번호가 틀렸습니다.');
          location.href = 'login.php';
        </script>
<?php
      exit;
    }else{
      $_SESSION["u_id"]=$u_id;
    }
  }
if(isset($_SESSION["uri"])){
    $uri=$_SESSION["uri"];
}
?>
<script> 
location.replace("../..<?= $uri?>");
</script> 