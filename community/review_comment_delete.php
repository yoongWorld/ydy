<?php
include ("../lib/dbconn.php");
include ("../lib/include.php"); 
?>
<?php
$sql = "delete from reviewcomment where rvc_no={$_GET['no']}";
$result = mysqli_query($conn,$sql);
mysqli_close($conn);
?>
<script>
history.go(-1);
</script>