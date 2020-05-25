<meta charset="utf-8">
<?php
session_start();
include "../lib/dbconn.php";
$uid=$_SESSION["u_id"];
$pid=$_POST["p_id"];
$pname=$_POST["p_name"];

$edate=$_POST["r_applydate"];
$sql="insert into reservation (u_id, r_applydate, p_name, p_id) ";
$sql.="values('$uid','$edate','$pname','$pid')";
$conn->query($sql);
$conn->close();
echo("<script>location.href='../member/members_reservation.php';</script>");
?>