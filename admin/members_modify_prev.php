<?php
include ("../lib/include.php");

if(isset($_GET['u_no']))$u_no=$_GET['u_no'];
if(isset($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = 1;
	}
$sql="select * from member where u_no='$u_no'";
$result=mysqli_query($conn, $sql);

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
<div class="col-md-2"></div>  <div class="clearfix"></div>
    <div class="member_form">
       <p>회원님의 정보를 안전하게 보호하기 위해 비밀번호를 다시 한 번 입력해주세요.</p><br>
        <form action="members_modify.php?u_no=<?=$u_no?>&page=<?=$page?>" method="post" name="index">
            <div class="row">
            <div class="col-xs-1 col-sm-3 col-md-4"></div>
            <div class="col-xs-10 col-sm-6 col-md-4">
            <input type="hidden" name="u_no" id="u_no">
            <input class="form-control" type="password" name="u_pwd" id="u_pwd" autofocus> <br><br>
            <input class="btn btn-default" type="submit" value="확인" id="btn_login">
            <input class="btn btn-default" type="button" value="취소" onClick="javascript:history.go(-1);return false;"></div>
            <div class="col-xs-1 col-sm-3 col-md-4"></div>
            </div>
        </form>
    </div>
</div>
</main>
<?php
include '../lib/include_footer.php';
?>