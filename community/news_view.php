<?php
include ("../lib/include.php");
$_SESSION["uri"] = $_SERVER["REQUEST_URI"];
?>
<?php
$n_No = $_GET['no'];
if(!empty($n_No) && empty($_COOKIE['BewithUs' . $n_No])) {
		$sql = 'update news set n_hit = n_hit + 1 where n_no = ' . $n_No;
		$result = mysqli_query($conn,$sql);
		if(empty($result)) {
			?>
			<script>
				alert('오류가 발생했습니다.');
				history.back();
			</script>
			<?php 
		} else {
			setcookie('BewithUs' . $n_No, TRUE, time() + (1), '/');
		}
	}
?>
<?php
	$sql = "select * from news where n_no = {$_GET['no']}";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);
?>
<?php
$strim = mb_strimwidth($row['n_title'], '0', '50', '...', 'utf-8');
 ?>
<body>
<div class="reviewlist_bgi">
    <div class="bgc"><p>커뮤니티</p><hr></div>
</div>
<div class="container">
<h2 class="" id="view_readHide">Be With Us소식</h2>
		<div class="boardView">
			<h4 class="">제목: <?= $strim ?></h4>
			<hr>
			<div class="boardInfo">
				<span class="">작성일: <?= substr($row['n_date'],0,10)?></span>
				<span class="">조회: <?= $row['n_hit']?></span>
			</div>
			<hr>
			<div class="view_img_wrap">
			<img src="<?= "data/".$row['n_file_copy1']?>" onerror="this.style.display='none'" class="img-responsive">
			</div>
			<div class="boardContent"><?= nl2Br($row['n_content'])?></div>
			<hr>
                <input class="btnSet" type="button" value=" 목록 " onClick="location.href='news_list.php?no=<?=$_GET['no']?>&page=<?=$_GET['page']?>';">
			    <?php if($_SESSION['u_id']==$row['u_id']||$_SESSION['u_id']=="admin"){?>
                <input class="btnSet" type="button" value=" 수정 " onClick="location.href='news_modify.php?no=<?=$_GET['no']?>&page=<?=$_GET['page']?>';"><?php } ?>
				<?php if($_SESSION['u_id']==$row['u_id']||$_SESSION['u_id']=="admin"){?>
                 <input class="btnSet" type="button" value="삭제" onclick="if(!confirm('삭제시 댓글도 모두 삭제됩니다. 삭제 하시겠습니까?')){return false;}else{location.href='news_delete.php?no=<?=$_GET['no']?>&page=<?=$_GET['page']?>';}">
                 <?php } ?>
                 <hr>
		<div class="boardComment">
			<?php include("news_comment.php")?>
		</div>
		</div>
	</div>	
<?php
include ("../lib/include_footer.php");
?>