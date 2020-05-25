<?php
include ("../lib/include.php");

if(isset($_GET['u_no']))$u_no=$_GET['u_no'];
if(isset($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = 1;
	}
?>
<?php
if($_POST['u_pwd'] == ""){
    ?>
    <script>
        alert("비밀번호를 입력해 주세요.");
        history.back();
    </script>
    <?php echo $_POST['u_pwd'];
    exit;
}
if($_POST['u_pwd'] != $chk_data['u_pwd']='admin'){
        ?>
        <script>
            alert("비밀번호가 다릅니다.");
            history.back();
        </script>
        <?
        exit;
    }
?>
<?php
//$userid = $_SESSION["u_id"];

$sql="select * from member where u_no='$u_no'";
$result=mysqli_query($conn, $sql);
$row=mysqli_fetch_array($result);

$u_tel=explode("-",$row['u_tel']);
$u_tel1=$u_tel[0];
$u_tel2=$u_tel[1];
$u_tel3=$u_tel[2];
?>
<main>
<div class="container sub_wrap">
<div class="sub-tab">
		<ul>
            <li><a href="reservation_list.php" class="off">예약관리</a></li>
            <li><a href="members_list.php" class="on">회원관리</a></li>
		</ul>
                <div class="sub_border"></div>
        <div class="clear"></div>
</div>
<div class="sub-tab-select">
<select name="jump" onchange="location.href=this.value">
<option value="members_list.php"> 회원관리</option>
<option value="reservation_list.php"> 예약관리</option>
</select>
</div><div class="clearfix"></div>
       <div class="member_title">회원 수정</div>
        <hr class="hr"><div class="clearfix"></div>
<div class="col-md-2"></div>  
        <form name="member_form" method="post" action="members_modify_save.php?u_no=<?$u_no?>&page=<?=$page?>" onSubmit="return post_check();" role="form">
                <div class="row input_wrap">
                    <div class="col-md-2"></div>
                    <td><input type="hidden" name="u_no" id="u_no" value="<?= $row['u_no'] ?>"></td>
                    <div class="col-xs-12 col-md-2 input_title">아이디</div>
                    <div class="col-xs-12 col-md-6">
                        <input class="form-control" type="text" name="u_id" id="u_id" placeholder="아이디를 입력하세요." maxlength="20" onkeyup="showId(this.value)" value="<?= $row['u_id'] ?>" disabled><span id="idHint" class="hint help-block"></span>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row input_wrap">
                   <div class="col-md-2"></div>
                    <div class="col-xs-12 col-md-2 input_title">비밀번호</div>
                    <div class="col-xs-12 col-md-6"><input class="form-control" type="password" name="u_pwd" value="<?= $row['u_pwd'] ?>" id="u_pwd" placeholder="비밀번호를 입력하세요." maxlength="20" onkeyup="showPwd(this.value)" required>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row input_wrap">
                   <div class="col-md-2"></div>
                    <div class="col-xs-12 col-md-2 input_title">비밀번호 확인</div>
                    <div class="col-xs-12 col-md-6">
                        <input class="form-control" type="password" name="u_pwd_chk" value="<?= $row['u_pwd'] ?>"  placeholder="비밀번호확인을 입력하세요." maxlength="20" onkeyup="checkPwd()" required>
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
                <div class="col-xs-12 btn_wrap">
                    <input class="btn-default" type="submit" href="#u_id" value="수정">
                    <input class="btn-default" type="button" onClick="javascript:history.go(-2);return false;" value="취소">
                </div>
                <div class="clearfix"></div>
        </form>
    </div></main>
<?php
include '../lib/include_footer.php';
?>