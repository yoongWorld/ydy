<?php
include ("../lib/include.php");
$_SESSION["uri"] = $_SERVER["REQUEST_URI"];
if(isset($_SESSION['u_id']))$u_id=$_SESSION['u_id'];
if(!$_SESSION["u_id"]){
	echo "
		<script>
				alert('로그인을 먼저해주세요');
				location.href = '../login/login.php';
		</script>
	";
}
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
<?php
if(isset($_GET['u_no']))$u_no=$_GET['u_no'];
if(isset($_GET['page']) && $_GET['page'] > 0){
    $page = $_GET['page'];
}
$sql="select * from member where u_id='$u_id'";
$result=mysqli_query($conn, $sql);

?>
<br>
<main>
<div class="container sub_wrap">
<div class="sub-tab">
		<ul>
            <li><a href="members_info.php" class="a on">나의정보</a></li>
					<li><a href="members_reservation.php" class="off">예약내역</a></li>
					<li><a href="members_modify_prev.php" class="off">개인정보수정</a></li>
					<li><a href="members_delete_prev.php" class="off">회원탈퇴</a></li>
		</ul>
                <div class="sub_border"></div>
        <div class="clear"></div>
</div>
<div class="sub-tab-select">
<select name="jump" onchange="location.href=this.value">
<option value="members_info.php"> 나의정보</option>
<option value="members_reservation.php"> 예약내역</option>
<option value="members_modify_prev.php"> 개인정보수정</option><option value="members_delete_prev.php" > 회원탈퇴</option>
</select>
</div><div class="clearfix"></div>
       <div class="member_title">회원 정보</div>
        <hr class="hr">
        <form name="iForm" method="post" action="members_delete_save.php?u_no=<?=$u_no?>&page=<?=$page?>">
               <?php while($data = mysqli_fetch_array($result)){
    ?>

               <div class="hidden-xs col-md-2"></div>
               <div class="col-md-8">
                <div class="row input_wrap">
                    <div class="col-xs-12 col-md-3 input_title">아이디</div>
                    <div class="col-xs-12 col-md-9">
                        <div class="form-control"><?=$data['u_id']?></div>
                    </div>
                </div>
                <div class="row input_wrap">
                    <div class="col-xs-12 col-md-3 input_title">이름</div>
                    <div class="col-xs-12 col-md-9">
                        <div class="form-control"><?=$data['u_name']?></div>
                    </div>
                </div>
                <div class="row input_wrap">
                    <div class="col-xs-12 col-md-3 input_title">성별</div>
                    <div class="col-xs-12 col-md-9"><div class="form-control"><?=$data['u_gender']?></div>
                    </div>
                </div>
                <div class="row input_wrap">
                    <div class="col-xs-12 col-md-3 input_title">생년월일</div>
                    <div class="col-xs-12 col-md-9">
                        <div class="form-control"><?=$data['u_birthdate']?></div>
                    </div>
                </div>
                <div class="row input_wrap">
                    <div class="col-xs-12 col-md-3 input_title">전화번호</div>
                    <div class="col-xs-12 col-md-9">
                        <div class="form-control">
                            <?=$data['u_tel']?>
                        </div>
                    </div>
                </div>
                </div>
                <div class="hidden-xs col-md-2"></div><div class="clearfix"></div>
                <hr>
                <div class="clearfix"></div>
                
        </form>
<?php
}
?>
</div>
</main>

<?php
include '../lib/include_footer.php';
?>