<?php
session_start();
include ("../lib/dbconn.php");

if(isset($_GET['u_no']))$u_no=$_GET['u_no'];
if(isset($_GET['page']))
$sql="select * from member where u_no=$u_no";
$result=mysqli_query($conn, $sql);
$row=mysqli_fetch_array($result);
$chk_no=$row['u_no'];
$sql="delete from member where u_no=$u_no";
mysqli_query($conn, $sql);
mysqli_close($conn);
?>
<script>
alert("삭제 되었습니다.");
location.href=history.go(-3);
</script>
