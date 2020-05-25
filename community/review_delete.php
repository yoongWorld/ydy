<?php
include ("../lib/dbconn.php");
include ("../lib/include.php"); 
?>
<?php
$page = $_GET['page'];
$sql = "delete from review where rv_no={$_GET['no']}";
$result = mysqli_query($conn,$sql);
$sql2 = "delete from reviewcomment where rv_no={$_GET['no']}";
$result2 = mysqli_query($conn,$sql2);
mysqli_close($conn);
?>
<script>
location.href="review_list.php?page=<?=$page?>";
</script>