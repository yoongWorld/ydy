<?php
include ("../lib/dbconn.php");
include ("../lib/include.php"); 
?>
<?php
if(!$_SESSION["u_id"]){
	echo "
		<script>
				alert('로그인을 먼저해주세요.');
				location.href = '../login/login.php';
		</script>
	";
}elseif($_SESSION["u_id"]=="admin"){
      echo
          "<script>
				alert('관리자는 답글을 달 수 없습니다.');
				history.go(-1);
		  </script>";}
else{
	$no = $_POST['no'];
    $page = $_POST['page'];
	$coContent = $_POST['coContent'];
	$sql = "insert into reviewcomment set rv_no='".$no."',rvc_content='".addslashes(htmlspecialchars($coContent))."' ,u_id='". $_SESSION['u_id']."',rvc_date=now()";
	$result = mysqli_query($conn,$sql);
	$insertno = mysqli_insert_id($conn);
	$sql = "update reviewcomment set rvc_order = rvc_no where rvc_no =" . $insertno;
	$result = mysqli_query($conn,$sql);
	if($result) {
?>
	<script>
//		alert('댓글이 정상적으로 작성되었습니다.');
		location.replace("review_view.php?no=<?php echo $no?>&page=<?php echo $page?>");
	</script>
<?php
	}}
?>




