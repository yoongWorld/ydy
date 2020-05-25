<?php
include ("../lib/include.php"); 

if(isset($_POST["u_id"]))$u_id = $_POST["u_id"];
if(isset($_POST["u_name"]))$u_name = $_POST["u_name"];
if(isset($_POST["u_birthdate"]))$u_birthdate = $_POST["u_birthdate"];
$u_tel = $_POST["u_tel1"]."-".$_POST["u_tel2"]."-".$_POST["u_tel3"];
$u_tel2 = $_POST["u_tel2"];
$u_tel3 = $_POST["u_tel3"];
//$chk_id = [$u_name,$u_birthdate,$u_tel];
//echo $chk_id;

preg_match_all('/[0-9]/', $u_tel2, $user_tel2);
$user_tel = implode('', $user_tel2[0]);

$sql = "select * from member where u_id='$u_id'";
$result=mysqli_query($conn, $sql);
$row=mysqli_fetch_array($result);
if($u_birthdate > date("Y-m-d H:i")){
	echo '
	<script>
		alert("생년월일은 현재 시간 이전으로 가능합니다.");
		history.go(-1);
	</script>
	';
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
}
if($u_id != $row['u_id']){
    echo("<script>
      window.alert('등록된 정보가 없습니다. 회원 정보를 다시 입력해주세요.');
      history.go(-1);
      </script>");
}elseif($u_name != $row['u_name']){
    echo("<script>
      window.alert('등록된 정보가 없습니다. 회원 정보를 다시 입력해주세요.');
      history.go(-1);
      </script>");
}elseif($u_birthdate != $row['u_birthdate']){
    echo("<script>
      window.alert('등록된 정보가 없습니다. 회원 정보를 다시 입력해주세요.');
      history.go(-1);
      </script>");
}elseif($u_tel != $row['u_tel']){
    echo("<script>
      window.alert('등록된 정보가 없습니다. 회원 정보를 다시 입력해주세요.');
      history.go(-1);
      </script>");
}else {
?>
<div class="col-sm-12 bgc_wrap">
    <img src="../img/temple12-2.jpg" class="img-fluid bgc_img" alt="Image">
    <div class="bgc_con_wrap1">
     <div class="hidden-xs bgc_con_wrap2">
      <p class="bgc_title">회원 찾기</p>
     </div>
      <p class="bgc_con">모든이에게 마음의 안정과 평화를 찾아주는<br>
        <mark class="mark">템플스테이</mark> 휴식 공간입니다.</p>
     </div>
</div>
<div class="clearfix"></div>
          <main>
           <div class="container content_wrap">
            <h1 class="sec_title">비밀번호 찾기 결과</h1>
<div class="col-sm-2 col-md-3"></div>
       <div class="col-sm-8 col-md-6">
                <div class="find_wrap">
    <div class="mem_form_wrap">
        <p class="find_text"><span class="find_id"><?= $row["u_pwd"]?></span>&nbsp;&nbsp;(<?= $row["u_regdate"]?> 가입)</p><br>
            <p>비밀번호 찾기 결과는 위와 같습니다.</p><br>
        <div class="row"><div class="col-md-2"></div>
            <div class="col-md-8">
        <a class="btn-default" href="login.php">로그인</a></div>
            </div><br>
        </div>
    </div> </div></div>
<div class="col-sm-2 col-md-3"></div><div class="clearfix"></div><br>

<?php
}

?>
</main>
<?php
include '../lib/include_footer.php';
?>