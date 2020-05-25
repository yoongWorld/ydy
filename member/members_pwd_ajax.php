<?php
include ("../lib/dbconn.php");

$u_pwd = $_REQUEST["u_pwd"];

if (strlen($u_pwd) < 6 || strlen($u_pwd) > 20){
    echo "비밀번호의 길이는 6글자 이상, 20글자 이하로 입력해주십시오.";
}
?>