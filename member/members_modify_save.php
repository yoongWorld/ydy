<?php
  session_start();
include "../lib/dbconn.php";
if(isset($_GET['u_id']))$u_id=$_GET['u_id'];
if(!$_SESSION["u_id"]){
	echo "
		<script>
				alert('로그인을 먼저해주세요');
				location.href = '../login/login.php';
		</script>
	";
}
?>
<meta charset="utf-8">
<?php
$u_id=$_SESSION['u_id'];

$u_pwd = $_POST["u_pwd"];
$u_pwd_chk = $_POST["u_pwd_chk"];
$u_birthdate = $_POST["u_birthdate"];
$u_tel = $_POST["u_tel1"]."-".$_POST["u_tel2"]."-".$_POST["u_tel3"];
$u_tel2 = $_POST["u_tel2"];
$u_tel3 = $_POST["u_tel3"];
$u_gender = $_POST["u_gender"];

if ($u_pwd != $u_pwd_chk){
    echo("<script>
      window.alert('비밀번호가 일치하지 않습니다.');
      history.go(-1);
    </script>");
    exit;
} elseif (strlen($u_pwd) < 6 || strlen($u_pwd) > 20) {
    echo("<script>
      window.alert('비밀번호의 길이는 6글자 이상, 20글자 이하로 입력해주십시오.');
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
} elseif($u_birthdate > date("Y-m-d H:i")){
	echo '
	<script>
		alert("생년월일은 현재 시간 이전으로 가능합니다.");
		history.go(-1);
	</script>
	';
	exit;
} else {
    $sql="update member set ";
    $sql.="u_pwd='$u_pwd', u_gender='$u_gender',  u_birthdate='$u_birthdate', u_tel='$u_tel' where u_id='$u_id' ";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
}
?>
<script>
  alert("수정 되었습니다.");
  location.href="members_info.php";
</script>