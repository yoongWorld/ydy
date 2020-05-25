<?php
include "../lib/include.php";
$_SESSION["uri"] = $_SERVER["REQUEST_URI"];
if(!isset($_SESSION['u_id'])){
echo("<script>
alert('로그인이 필요합니다.')
location.href='../login/login.php';
</script>");
exit;}
$enterday = date('Y-m-d');
$table="reservation";
$scale=10;
if(isset($_SESSION['page']))$page=$_GET['page'];
$userid=$_SESSION['u_id'];
$sql="select * from $table where u_id='$userid' order by r_no desc";
$result=$conn->query($sql);
$total_record=mysqli_num_rows($result);
if($total_record%$scale==0){$total_page=floor($total_record/$scale);
}else{$total_page=floor($total_record/$scale)+1;}
if(!isset($page) or $page<1){$page=1;}
$start=($page-1)*$scale;
$number=$total_record-$start;

$query1 = "select * from product where p_id";
$result1 = mysqli_query($conn,$query1);
$data = mysqli_fetch_array($result1);


?>
<div class="col-sm-12 bgc_wrap">
    <img src="../img/temple12-2.jpg" class="img-fluid bgc_img" alt="Image">
    <div class="bgc_con_wrap1">
     <div class="hidden-xs bgc_con_wrap2">
      <p class="bgc_title">마이페이지</p>
     </div>
      <p class="bgc_con">모든이에게 마음의 안정과 평화를 찾아주는<br>
        <mark class="mark">템플스테이</mark> 휴식 공간입니다.</p>
     </div>
</div>
<div class="clearfix"></div>
<?php
if(isset($_GET['u_no']))$u_no=$_GET['u_no'];
if(isset($_GET['page']) && $_GET['page'] > 0){
    $page = $_GET['page'];
}
$sql="select * from member where u_id='$u_id'";
$result=mysqli_query($conn, $sql);

?>
<br>
<main>
<div class="container sub_wrap">
<div class="sub-tab">
		<ul>
            <li><a href="members_info.php" class="a off">나의정보</a></li>
					<li><a href="members_reservation.php" class="on">예약내역</a></li>
					<li><a href="members_modify_prev.php" class="off">개인정보수정</a></li>
					<li><a href="members_delete_prev.php" class="off">회원탈퇴</a></li>
		</ul>
                <div class="sub_border"></div>
        <div class="clear"></div>
</div>
<div class="sub-tab-select">
<select name="jump" onchange="location.href=this.value">
<option value="members_reservation.php"> 예약내역</option>
<option value="members_info.php"> 나의정보</option>
<option value="members_modify_prev.php"> 개인정보수정</option><option value="members_delete_prev.php" > 회원탈퇴</option>
</select>
</div><div class="clearfix"></div>
       <div class="member_title">예약 내역</div>
        <hr class="hr">
<?php
if(isset($_GET['page'])) {$page = $_GET['page'];} else {$page = 1;}
$sql="select count(*) as cnt from $table where u_id='$userid' ";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$allPost = $row['cnt']; //전체 게시글의 수
if(empty($allPost)) {$emptyData = '<tr><td class="textCenter" colspan="8">예약이 존재하지 않습니다.</td></tr>';} else {
$onePage = 5; // 한 페이지에 보여줄 게시글의 수.
$allPage = ceil($allPost / $onePage); //전체 페이지의 수
if($page < 1 && $page > $allPage) {
?>
 
<script>alert("존재하지 않는 페이지입니다.");history.back();</script>
<?php
exit;}   
$subString = "";$oneSection = 5; $currentSection = ceil($page / $oneSection); $allSection = ceil($allPage / $oneSection); $firstPage = ($currentSection * $oneSection) - ($oneSection - 1); if($currentSection == $allSection) {$lastPage = $allPage;} else {$lastPage = $currentSection * $oneSection; }$prevPage = (($currentSection - 1) * $oneSection); $nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1);
$paging = '<ul class="pagination pagination-sm">'; if($page != 1) {$paging .= '<li><a class="first" href="./members_reservation.php?page=1' . $subString . '">&laquo;</a></li>';}if($currentSection != 1) {$paging .= '<li><a class="prev" href="./members_reservation.php?page=' . $prevPage . $subString . '">&lsaquo;</a></li>';}
for($i = $firstPage; $i <= $lastPage; $i++) {
if($i == $page) {$paging .= '<li class="active"><a href="#">' . $i . '</a></li>';} else {$paging .= '<li class="page"><a href="members_reservation.php?page=' . $i . $subString . '">' . $i . '</a></li>';}}
if($currentSection != $allSection) { $paging .= '<li><a href="./members_reservation.php?page=' . $nextPage . $subString . '">&#8250;</a><li>';}if($page != $allPage) { $paging .= '<li><a href="./members_reservation.php?page=' . $allPage . '">&raquo</a><li>';};
$paging .= '</ul>';
$currentLimit = ($onePage * $page) - $onePage; $sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage;
$sql ="select * from $table where u_id='$userid'  order by r_no desc". $sqlLimit; $result = mysqli_query($conn,$sql);} ?>


  
  
<div class="col-md-2"></div>
<div class="col-md-8">
<table class="table">
<thead><tr><th class="hidden-xs">예약번호</th><th>프로그램명</th><th>예약날짜</th><th>취소</th></tr></thead><tbody>
<?php
//
//$sql2 = "select * from $table where r_applydate > now() order by r_applydate asc". $sqlLimit;
//$result = mysqli_query($conn,$sql2);
    
if(isset($emptyData)){
echo $emptyData;
} else {while($row = mysqli_fetch_assoc($result)){
$datetime = explode(' ', $row['r_applydate']);
?>
<tr><td class="hidden-xs"><?=$row['r_no']?></td><td><?=$row['p_name']?></td>
<td><?=$row['r_applydate']?></td>
<td><?php
if($row['r_applydate']>$enterday){
?>
<input class="btn btn-sm btn-warning" type="button" value="수정" onClick="location.href='members_reservation_form.php?p_id=<?=$row['p_id']?>&r_no=<?=$row['r_no']?>'">
<input type='button' class='btn btn-sm btn-warning' value='취소' onClick="if(confirm('정말로 취소하시겠습니까?'))location.href='reservation_delete.php?r_no=<?=$row['r_no']?>'">
<?php
;}else{
?>
<sapn>완료</sapn>
<?php
;} 
?>
</td>
<?php
}
}
?>
</tr>
<tr><td colspan="5" class="text-center"><?php 
if (isset($paging)) {echo $paging;} else {echo "<ul class='pagination'><li class='active'><a href='#'>1</a></li></ul>";}
?></td></tr>
</tbody></table>

    
    
    
</div>
<div class="col-md-2"></div>
</div> 
</main>
       
<?php
include '../lib/include_footer.php';
mysqli_close($conn);
?>