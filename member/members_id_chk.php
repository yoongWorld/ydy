<?php
include "../lib/dbconn.php";

if(isset($_GET['u_id']))$id = $_GET['u_id'];
$u_id = $_GET["u_id"];
preg_match_all('/[a-z]|[0-9]/', $u_id, $u_id2);   
$user_id = implode('', $u_id2[0]);

if(!$id) {
    echo("아이디를 입력하세요.");
} else {
    $sql="select * from member where u_id='$id'";
    $result = mysqli_query($conn, $sql);
    $num_record=mysqli_num_rows($result);
    if($num_record){
    echo "아이디가 중복됩니다.<br>다른 아이디를 사용하세요.<br>";
    } elseif (strlen($id) < 6 || strlen($u_id) > 20) {
    echo"아이디의 길이는 6글자 이상,<br>20글자 이하로 입력해주십시오.";
} elseif ($u_id <> $user_id) {
    echo"아이디는 영문 소문자, 숫자만 사용할 수 있습니다.";
} else {
      echo "사용가능한 아이디입니다.";
            mysqli_close($conn);
    }
  }
?>
<br><a href="#" onclick="window.close()">창 닫기</a>