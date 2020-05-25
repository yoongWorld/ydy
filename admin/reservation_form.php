<?php
include "../lib/include.php";
$_SESSION["uri"] = $_SERVER["REQUEST_URI"];
if(isset($_SESSION["u_id"]))$u_id = $_SESSION["u_id"];
if($_SESSION["u_id"] != "admin"){
	echo "
		<script>
				alert('관리자만 접근할 수 있습니다.');
				location.href = '../login/login.php';
		</script>
	";
}

if(isset($_GET['r_no']))$r_no=$_GET['r_no'];
$sql2="select * from reservation a left join product b on a.p_id = b.p_id where r_no = '$r_no'";
$result2=mysqli_query($conn, $sql2);
$data2 = mysqli_fetch_array($result2);


?>
 
<main>
<div class="container sub_wrap">
<div class="sub-tab">
		<ul>
            <li><a href="reservation_list.php" class="on">예약관리</a></li>
		    <li><a href="members_list.php" class="off">회원관리</a></li>
		</ul>
                <div class="sub_border"></div>
        <div class="clear"></div>
</div>
<div class="sub-tab-select">
<select name="jump" onchange="location.href=this.value">
<option value="reservation_list.php"> 예약관리</option>
<option value="members_list.php"> 회원관리</option>
</select>
</div><div class="clearfix"></div>
       <div class="member_title">예약 수정</div>
        <hr class="hr"><div class="clearfix"></div><br><br>
<div class="container row">
<div class="col-sm-1 col-md-2"></div>
<div class="col-sm-10 col-md-8">
<form class="reservation_form" name="reservation_from" method="post" action="reservation_update.php?r_no=<?= $data2["r_no"]?>" role="form">
<input class="form-control" type="text" value="<?php echo $data2['u_id'] ?>" name='u_id' disabled>
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
</div></div>
</main>
<?php include ("../lib/include_footer.php"); ?>