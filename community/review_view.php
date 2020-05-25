<?php
include ("../lib/dbconn.php");
include ("../lib/include.php"); 
$_SESSION["uri"] = $_SERVER["REQUEST_URI"];
?>
<?php

$n_No = $_GET['no'];
if(!empty($n_No) && empty($_COOKIE['templestay' . $n_No])) {
		$sql = 'update review set rv_hit = rv_hit + 1 where rv_no = ' . $n_No;
		$result = mysqli_query($conn,$sql);
		if(empty($result)) {
			?>
			<script>
				alert('오류가 발생했습니다.');
				history.back();
			</script>
			<?php 
		} else {
			setcookie('templestay' . $n_No, TRUE, time() + (1), '/');
		}
	}
?>
<?php
	$sql = "select * from review where rv_no = {$_GET['no']}";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);
?>
<?php
$strim = mb_strimwidth($row['rv_title'], '0', '50', '...', 'utf-8');
 ?>
<div class="col-sm-12 bgc_wrap">
    <img src="../img/temple17-1.jpg" class="img-fluid bgc_img" alt="Image">
    <div class="bgc_con_wrap1">
     <div class="hidden-xs bgc_con_wrap2">
      <p class="bgc_title">커뮤니티</p>
     </div>
      <p class="bgc_con">모든이에게 마음의 안정과 평화를 찾아주는<br>
        <mark class="mark">템플스테이</mark> 휴식 공간입니다.</p>
     </div>
</div>
<div class="clearfix"></div>
<main>
    <div class="container content_wrap">
       <h1 class="sec_title">이용후기</h1>
       <div class="clearfix"></div>
       
       <div class="col-sm-1"></div>
       <div class="col-sm-10 review_view_wrap">

		<div class="review_v_info_wrap">
		
			<h3 class="review_v_title"><?= $strim ?></h3>
			<div class="review_v_info">
				<?= $row['u_id']?> | <?= substr($row['rv_date'],0,10)?> | 조회수 : <?= $row['rv_hit']?>
            </div>
			</div>
			<div class="review_v_con_wrap">
			<img class="img-responsive review_img" src="<?= "./data/".$row['rv_file_copy1']?>" onerror="this.style.display='none'">
			<div class="review_v_con"><?= nl2Br($row['rv_content'])?></div>
			</div>
               <div class="">
               <div class="review_v_list">
                <input class="btn-default review_v_btn" type="button" value=" 목록 " onClick="location.href='review_list.php?no=<?=$_GET['no']?>&page=<?=$_GET['page']?>';"></div>
			    <?php if($_SESSION['u_id']==$row['u_id']||$_SESSION['u_id']=="admin"){?>
              <div class="review_v_admin">
               <input class="btn-default review_v_btn" type="button" value=" 수정 " onClick="location.href='review_modify.php?no=<?=$_GET['no']?>&page=<?=$_GET['page']?>';"><?php } ?>
				<?php if($_SESSION['u_id']==$row['u_id']||$_SESSION['u_id']=="admin"){?><input class="btn-default review_v_btn" type="button" value="삭제" onclick="if(!confirm('삭제시 댓글도 모두 삭제됩니다. 삭제 하시겠습니까?')){return false;}else{location.href='review_delete.php?no=<?=$_GET['no']?>&page=<?=$_GET['page']?>';}">
                  <?php } ?></div>
           </div><div class="clearfix"></div>
		<div class="boardComment">
			<?php include("review_comment.php")?>
		</div>

</div></div><div class="col-sm-1"></div>
    </main>
<?php
include ("../lib/include_footer.php");
?>