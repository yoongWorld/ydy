<?php
include ("../lib/include.php");
$_SESSION["uri"] = $_SERVER["REQUEST_URI"];
if(!isset($_SESSION['u_id'])){
echo("<script>
alert('로그인이 필요합니다.')
location.href='../login/login.php';
</script>");
exit;}

//if(isset($_GET["p_id"]));$p_id=$_GET["p_id"];
//$sql="select * from product where p_id = '$p_id'";
//$result=mysqli_query($conn, $sql);
//$data = mysqli_fetch_array($result);
//


if(isset($_GET['r_no']))$r_no=$_GET['r_no'];
$sql2="select * from reservation a left join product b on a.p_id = b.p_id where r_no = '$r_no'";
$result2=mysqli_query($conn, $sql2);
$data2 = mysqli_fetch_array($result2);


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

<br>
<main>
<div class="container sub_wrap">
<div class="sub-tab">
		<ul>
            <li><a href="members_info.php" class="a off">나의정보</a></li>
					<li><a href="members_reservation.php" class="on">예약내역</a></li>
					<li><a href="members_modify_prev.php" class="off">개인정보수정</a></li>
					<li><a href="members_delete_prev.php" class="off">회원탈퇴</a></li>
		</ul>
                <div class="sub_border"></div>
        <div class="clear"></div>
</div>
<div class="sub-tab-select">
<select name="jump" onchange="location.href=this.value">
<option value="members_reservation.php"> 예약내역</option>
<option value="members_info.php"> 나의정보</option>
<option value="members_modify_prev.php"> 개인정보수정</option><option value="members_delete_prev.php" > 회원탈퇴</option>
</select>
</div><div class="clearfix"></div>
       <div class="member_title">예약 내역</div>
        <hr class="hr">
        <div class="clearfix"></div>
<div class="container row">
<div class="col-sm-1 col-md-2"></div>
<div class="col-sm-10 col-md-8">
<form class="reservation_form" name="reservation_from" method="post" action="members_reservation_update.php?r_no=<?= $data2["r_no"]?>" role="form">

<select class="form-control" name="p_id">

<?  
$p_result = mysqli_query($conn,"select * from `product`");
while($p_data2 = mysqli_fetch_array($p_result)){ 
?>
<option <? if($_GET["p_id"] == $p_data2["p_id"]) echo "selected"; ?> value="<?=$p_data2["p_id"] ?>"><?=$p_data2["p_name"] ?></option>
<? } ?>    

</select>
<input class="form-control" type="date" value="<?php echo $data2['r_applydate'] ?>" min="<?php echo date('Y-m-d');?>" name='r_applydate' required>
<input class="btn btn-default" id="resu" type="submit" value="수정하기">
</form>
</div><br><br>

<div class="col-sm-1 col-md-2"></div> 
</div>

</div>
</main>
<?php include ("../lib/include_footer.php"); ?>