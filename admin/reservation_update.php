<meta charset="utf-8">
<?php
session_start();
include "../lib/dbconn.php";

if(isset($_GET['r_no']))$r_no=$_GET['r_no'];

if(isset($_POST['p_id']))$p_id=$_POST['p_id'];

$sql="select * from reservation where r_no = $r_no";
$result = mysqli_query($conn,$sql);
$data= mysqli_fetch_array($result);

$sql2="select * from reservation where p_id = $p_id";
$result2 = mysqli_query($conn,$sql2);
$data2 = mysqli_fetch_array($result2);

if(isset($_POST['r_applydate']))$r_applydate=$_POST['r_applydate'];





$sql="update `reservation` set u_id='".$data['u_id']."', r_applydate='".$r_applydate."', p_name='".$data2['p_name']."', p_id=".$_POST['p_id']." where r_no =".$r_no."";

$conn->query($sql);
$conn->close();
?>
<script>
alert("예약이 수정되었습니다");
location.href='reservation_list.php';
</script>