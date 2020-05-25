<?php
session_start();
include ("../lib/dbconn.php");

if(isset($_GET['u_no']))$u_no=$_GET['u_no'];
if(isset($_GET['page']))
$u_no = $_POST['u_no'];
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
</script>
<?php
  session_unset();
  echo("
    <script>
      location.href='/index.php';
    </script>
  ");
?>