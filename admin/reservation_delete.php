<?
	include ("../lib/dbconn.php");
	
		$r_no = $_GET["r_no"];
		if($r_no){
			$sql = "delete from `reservation` where r_no = '".$r_no."' ";
			mysqli_query($conn,$sql);	
		}
?>
<script>
location.href='reservation_list.php';
</script>