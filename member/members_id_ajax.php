<?php
include ("../lib/dbconn.php");

$u_id = $_REQUEST["u_id"];

$sql = "select * from member where u_id='$u_id'";
$result=mysqli_query($conn, $sql);
$exist_id=mysqli_num_rows($result);

preg_match_all('/[a-z]|[0-9]/', $u_id, $u_id2); 
$user_id = implode('', $u_id2[0]);

if (strlen($u_id) < 6 || strlen($u_id) > 20){
    echo "아이디의 길이는 6글자 이상, 20글자 이하로 입력해주십시오.";
} elseif ($exist_id){
    echo "해당 아이디가 존재합니다.";
} elseif ($u_id <> $user_id){
    echo "아이디는 영문 소문자, 숫자만 사용할 수 있습니다.";
} elseif ($exist_id){
    echo "해당 아이디가 존재합니다.";
} else {
    echo "사용가능한 아이디입니다.";
}
?>