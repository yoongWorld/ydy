<?php
include ("../lib/dbconn.php");

$u_id = $_POST["u_id"];
$u_pwd = $_POST["u_pwd"];
$u_pwd_chk = $_POST["u_pwd_chk"];
$u_name = $_POST["u_name"];
$u_gender = $_POST["u_gender"];
$u_birthdate = $_POST["u_birthdate"];
$u_tel = $_POST["u_tel1"]."-".$_POST["u_tel2"]."-".$_POST["u_tel3"];
$u_tel2 = $_POST["u_tel2"];
$u_tel3 = $_POST["u_tel3"];

// 소문자와 숫자를 $u_id[0][0]부터 한글자씩 저장
preg_match_all('/[a-z]|[0-9]/', $u_id, $u_id2);
preg_match_all('/[0-9]/', $u_tel2, $user_tel2);
// 정규식에 걸려든 변수를 합쳐서 $user_id에 저장 
$user_id = implode('', $u_id2[0]);
$user_tel = implode('', $user_tel2[0]);

$sql = "select * from member where u_id='$u_id'";
$result=mysqli_query($conn, $sql);
$exist_id=mysqli_num_rows($result);

if ($exist_id){
    echo("<script>
      window.alert('해당 아이디가 존재합니다.');
      history.go(-1);
    </script>");
    exit;
} elseif (strlen($u_id) < 6 || strlen($u_id) > 20) {
    echo("<script>
      window.alert('아이디의 길이는 6글자 이상, 20글자 이하로 입력해주십시오.');
      history.go(-1);
    </script>");
    exit;
} elseif ($u_id <> $user_id) {
    echo("<script>
      window.alert('아이디는 영문 소문자, 숫자만 사용할 수 있습니다.');
      history.go(-1);
    </script>");
    exit;
} elseif (strlen($u_pwd) < 6 || strlen($u_pwd) > 20) {
    echo("<script>
      window.alert('비밀번호의 길이는 6글자 이상, 20글자 이하로 입력해주십시오.');
      history.go(-1);
    </script>");
    exit;
} elseif ($u_pwd != $u_pwd_chk) {
      echo("<script>
      window.alert('비밀번호가 일치하지 않습니다.');
      history.go(-1);
    </script>");
    exit;
} elseif ( preg_match('/[^\d]/',$u_tel2) ) {
    echo("<script>
      window.alert('전화번호는 숫자만 사용할 수 있습니다.');
      history.go(-1);
    </script>");
    exit;
} elseif ( preg_match('/[^\d]/',$u_tel3) ) {
    echo("<script>
      window.alert('전화번호는 숫자만 사용할 수 있습니다.');
      history.go(-1);
    </script>");
    exit;
} elseif (strlen($u_tel2) != 4) {
    echo("<script>
      window.alert('전화번호는 4자리로 입력해주세요.');
      history.go(-1);
    </script>");
    exit;
} elseif (strlen($u_tel3) != 4) {
    echo("<script>
      window.alert('전화번호는 4자리로 입력해주세요.');
      history.go(-1);
    </script>");
    exit;
} elseif($u_birthdate > date("Y-m-d H:i")){
	echo '
	<script>
		alert("생년월일은 현재 시간 이전으로 가능합니다.");
		history.go(-1);
	</script>
	';
	exit;
} else {
    $sql="insert into member(u_id, u_pwd, u_name, u_gender, u_birthdate, u_tel)";
    $sql.="values('$u_id', '$u_pwd', '$u_name', '$u_gender', '$u_birthdate', '$u_tel')";
    echo $sql;
    mysqli_query($conn, $sql);
  }
  mysqli_close($conn);
?>
<script>
    location.href = 'members_list.php';
</script>