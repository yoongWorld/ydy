<?php
include ("../lib/include.php");
$_SESSION["uri"] = $_SERVER["REQUEST_URI"];
if(isset($_GET['u_id']))$u_id=$_GET['u_id'];
if(!$_SESSION["u_id"]){
	echo "
		<script>
				alert('로그인을 먼저해주세요');
				location.href = '../login/login.php';
		</script>
	";
}

$sql="select * from member where u_id='$u_id'";
$result=mysqli_query($conn, $sql);
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
		<ul>
            <li><a href="members_info.php" class="a off">나의정보</a></li>
					<li><a href="members_reservation.php" class="off">예약내역</a></li>
					<li><a href="members_modify_prev.php" class="on">개인정보수정</a></li>
					<li><a href="members_delete_prev.php" class="off">회원탈퇴</a></li>
		</ul>
                <div class="sub_border"></div>
        <div class="clear"></div>
</div>
<div class="sub-tab-select">
<select name="jump" onchange="location.href=this.value">
<option value="members_modify_prev.php"> 개인정보수정</option>
<option value="members_info.php"> 나의정보</option>
<option value="members_reservation.php"> 예약내역</option>
<option value="members_delete_prev.php" > 회원탈퇴</option>
</select>
</div>
<div>
   <h2 class="member_title">회원 수정</h2>
   <hr class="hr">
   <div class="member_form">
       <p>회원님의 정보를 안전하게 보호하기 위해 비밀번호를 다시 한 번 입력해주세요.</p><br>
        <form action="members_modify.php" method="post" name="index">
            <div class="row">
            <div class="col-xs-1 col-sm-3 col-md-4"></div>
            <div class="col-xs-10 col-sm-6 col-md-4">
            <input type="hidden" name="u_no" id="u_no">
            <input class="form-control" type="password" name="u_pwd" id="u_pwd" autofocus> <br><br>
            <input class="btn btn-default" type="submit" value="확인" id="btn_login">
            <input class="btn btn-default" type="button" value="취소" onClick="javascript:location.href='members_info.php';return false;"></div>
            <div class="col-xs-1 col-sm-3 col-md-4"></div>
            </div>
        </form>
    </div>
</div>
</div>
</main>
<?php
include '../lib/include_footer.php';
?>