<?php
include ("../lib/include.php");
$_SESSION["uri"] = $_SERVER["REQUEST_URI"];
if(isset($_SESSION["u_id"]))$u_id = $_SESSION["u_id"];
if(isset($_POST["u_pwd"]))$u_pwd = $_POST["u_pwd"];
if(!$_SESSION["u_id"]){
	echo "
		<script>
				alert('로그인을 먼저해주세요');
				location.href = '../login/login.php';
		</script>
	";
}
?>
<?php
$sql="select * from member where u_id='$u_id'";
$result=mysqli_query($conn, $sql);
$num_match=mysqli_num_rows($result);
if(!isset($u_pwd)){
    echo("
      <script>
        window.alert('비밀번호를 입력하지 않았습니다.');
        history.go(-1);
      </script>
    ");
    exit;
  }
    $row=mysqli_fetch_array($result);
    $db_pass=$row['u_pwd'];
    if($u_pwd!=$db_pass){
      echo("
        <script>
          window.alert('비밀번호가 틀렸습니다.');
          history.go(-1);
        </script>
      ");
      exit;
    }
?>

<?php
$sql="select * from member where u_id='$u_id'";
$result=mysqli_query($conn, $sql);
$row=mysqli_fetch_array($result);

$u_tel=explode("-",$row['u_tel']);
$u_tel1=$u_tel[0];
$u_tel2=$u_tel[1];
$u_tel3=$u_tel[2];
?>
<div class="col-sm-12 bgc_wrap">
    <img src="../img/temple12-2.jpg" class="img-fluid bgc_img" alt="Image">
    <div class="bgc_con_wrap1">
     <div class="hidden-xs bgc_con_wrap2">
      <p class="bgc_title">마이페이지</p>
     </div>
      <p class="bgc_con">모든이에게 마음의 안정과 평화를 찾아주는<br>
        <mark class="mark">템플스테이</mark> 휴식 공간입니다.</p>
     </div>
</div>
<div class="clearfix"></div>
<main>
<div class="container sub_wrap">
<div class="sub-tab">
    <br>
		<ul>
            <li><a href="members_info.php" class="a off">나의정보</a></li>
					<li><a href="members_reservation.php" class="off">예약내역</a></li>
					<li><a href="members_modify_prev.php" class="on">개인정보수정</a></li>
					<li><a href="members_delete_prev.php" class="off">회원탈퇴</a></li>
		</ul>
                <div class="sub_border"></div>
        <div class="clearfix"></div>
</div>
<div class="sub-tab-select">
<select name="jump" onchange="location.href=this.value">
<option value="members_modify_prev.php"> 개인정보수정</option>
<option value="members_info.php"> 나의정보</option>
<option value="members_reservation.php"> 예약내역</option>
<option value="members_delete_prev.php" > 회원탈퇴</option>
</select>
</div><div class="clearfix"></div>
       <div class="member_title">회원수정</div>
        <hr class="hr">
        <form name="member_form" method="post" action="members_modify_save.php" onSubmit="return post_check();" role="form">
                <div class="row input_wrap">
                    <div class="col-md-2"></div>
                    <div class="col-xs-12 col-md-2 input_title">아이디</div>
                    <div class="col-xs-12 col-md-6">
                        <input class="form-control" type="text" name="u_id" id="u_id" placeholder="아이디를 입력하세요." maxlength="20" onkeyup="showId(this.value)" value="<?= $row['u_id'] ?>" disabled><span id="idHint" class="hint help-block"></span>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row input_wrap">
                   <div class="col-md-2"></div>
                    <div class="col-xs-12 col-md-2 input_title">비밀번호</div>
                    <div class="col-xs-12 col-md-6"><input class="form-control" type="password" name="u_pwd" value="" id="u_pwd" placeholder="비밀번호를 입력하세요." maxlength="20" onkeyup="showPwd(this.value)" required>
                        <p id="pwdHint" class="hint"></p>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row input_wrap">
                   <div class="col-md-2"></div>
                    <div class="col-xs-12 col-md-2 input_title">비밀번호 확인</div>
                    <div class="col-xs-12 col-md-6">
                        <input class="form-control" type="password" name="u_pwd_chk" value=""  placeholder="비밀번호확인을 입력하세요." maxlength="20" onkeyup="checkPwd()" required>
                        <p id="checkPwd" class="hint"></p>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row input_wrap">
                   <div class="col-md-2"></div>
                    <div class="col-xs-12 col-md-2 input_title">이름</div>
                    <div class="col-xs-12 col-md-6">
                        <input class="form-control" type="text" name="u_name" value="<?= $row['u_name'] ?>" placeholder="이름을 입력하세요." required>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row input_wrap">
                   <div class="col-md-2"></div>
                    <div class="col-xs-12 col-md-2 input_title">성별</div>
                    <div class="col-xs-12 col-md-6"><select class="form-control" name="u_gender" value="남" required>
                        <option value="<?= $row['u_gender'] ?>" value="남"><?= $row['u_gender'] ?></option>
                        <option value="남">남</option>
                        <option value="여">여</option></select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row input_wrap">
                   <div class="col-md-2"></div>
                    <div class="col-xs-12 col-md-2 input_title">생년월일</div>
                    <div class="col-xs-12 col-md-6">
                        <input class="form-control" value="<?= $row['u_birthdate'] ?>" type="date" name="u_birthdate" required>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row input_wrap">
                   <div class="col-md-2"></div>
                    <div class="col-xs-12 col-md-2 input_title">전화번호</div>
                    <div class="col-xs-12 col-md-6">
                        <div class="col-xs-4 col-md-4 tel_box">
                            <select class="tel_box form-control" name="u_tel1" required>
                                        <option value="<?= $u_tel1 ?>"  value="010"><?= $u_tel1 ?></option>
                                        <option value="010">010</option>
                                        <option value="011">011</option>
                                        <option value="016">016</option>
                                        <option value="017">017</option>
                                        <option value="018">018</option>
                                        <option value="019">019</option>
                                        </select>
                        </div>
                        <div class="col-xs-4 col-md-4 tel_box">
                            <input class="col-md-3 tel_box form-control" value="<?= $u_tel2 ?>" type="text" class="u_tel" name="u_tel2" id="u_tel2" maxlength="4" required>
                        </div>
                        <div class="col-xs-4 col-md-4 tel_box">
                            <input class="col-md-3 tel_box form-control" value="<?= $u_tel3 ?>" type="text" class="u_tel" name="u_tel3" maxlength="4" required>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="clearfix"></div>
                <input class="blind" type="hidden" name="level">
                <div class="col-xs-12 btn_wrap">
                    <input class="btn btn-default" type="submit" href="#u_id" value="수정">
                </div>
                <div class="clearfix"></div>
        </form>
        </div>
</main>
<?php
include '../lib/include_footer.php';
?>