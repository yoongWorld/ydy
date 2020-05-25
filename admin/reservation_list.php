<?php
include "../lib/include.php";
$_SESSION["uri"] = $_SERVER["REQUEST_URI"];
if(isset($_SESSION["u_id"]))$u_id = $_SESSION["u_id"];
if($_SESSION["u_id"] != "admin"){
	echo "
		<script>
				alert('관리자만 접근할 수 있습니다.');
				location.href = '../login/login.php';
		</script>
	";
}
$enterday = date('Y-m-d');
$table="reservation";
$scale=10;
if(isset($_SESSION['page']))$page=$_GET['page'];
$userid=$_SESSION['u_id'];
$sql="select * from $table order by r_no desc";
$result=$conn->query($sql);
$total_record=mysqli_num_rows($result);
if($total_record%$scale==0){$total_page=floor($total_record/$scale);
}else{$total_page=floor($total_record/$scale)+1;}
if(!isset($page) or $page<1){$page=1;}
$start=($page-1)*$scale;
$number=$total_record-$start;

//$query1 = "select * from product where p_id";
//$result1 = mysqli_query($conn,$query1);
//$data = mysqli_fetch_array($result1);


?>

<?php
if(isset($_GET['u_no']))$u_no=$_GET['u_no'];
if(isset($_GET['page']) && $_GET['page'] > 0){
    $page = $_GET['page'];
}
//$sql="select * from member where u_id='$u_id'";
//$result=mysqli_query($conn, $sql);

?>
<main>
<div class="container sub_wrap">
<div class="sub-tab">
		<ul>
            <li><a href="reservation_list.php" class="on">예약관리</a></li>
		    <li><a href="members_list.php" class="off">회원관리</a></li>
		</ul>
                <div class="sub_border"></div>
        <div class="clear"></div>
</div>
<div class="sub-tab-select">
<select name="jump" onchange="location.href=this.value">
<option value="reservation_list.php"> 예약관리</option>
<option value="members_list.php"> 회원관리</option>
</select>
</div><div class="clearfix"></div>
       <div class="member_title">예약 관리</div>
        <hr class="hr"><div class="clearfix"></div>
        
<?php
if(isset($_GET['page'])) {$page = $_GET['page'];} else {$page = 1;}
$sql="select count(*) as cnt from $table ";
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
$paging = '<ul class="pagination pagination-sm">'; if($page != 1) {$paging .= '<li><a class="first" href="./reservation_list.php?page=1' . $subString . '">&laquo;</a></li>';}if($currentSection != 1) {$paging .= '<li><a class="prev" href="./reservation_list.php?page=' . $prevPage . $subString . '">&lsaquo;</a></li>';}
for($i = $firstPage; $i <= $lastPage; $i++) {
if($i == $page) {$paging .= '<li class="active"><a href="#">' . $i . '</a></li>';} else {$paging .= '<li class="page"><a href="reservation_list.php?page=' . $i . $subString . '">' . $i . '</a></li>';}}
if($currentSection != $allSection) { $paging .= '<li><a href="./members_reservation.php?page=' . $nextPage . $subString . '">&#8250;</a><li>';}if($page != $allPage) { $paging .= '<li><a href="./reservation_list.php?page=' . $allPage . '">&raquo</a><li>';};
$paging .= '</ul>';
$currentLimit = ($onePage * $page) - $onePage; 
$sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage;
$sql ="select * from $table order by r_applydate desc". $sqlLimit; $result = mysqli_query($conn,$sql);} 
    
$subString = ""; 
if(isset($_GET['searchColumn'])) {
		$searchColumn = $_GET['searchColumn'];
		$subString = '&amp;searchColumn=' . $searchColumn;
	}
	if(isset($_GET['searchText'])) {
		$searchText = $_GET['searchText'];
		$subString .= '&amp;searchText=' . $searchText;
	}
	
	if(isset($searchColumn) && isset($searchText)) {
		$searchSql = ' where ' . $searchColumn . ' like "%' . $searchText . '%"';
	} else {
		$searchSql = '';    
    }
    ?>
  
<div class="col-md-2"></div>
<div class="col-md-8">
  
<p class="all"><span class="badge"><?php echo $allPost?></span>개의 예약이 있습니다.</p>
<div class="search">
        <form class="search_box" action="reservation_list.php" method="get"><select class="search_select" name="searchColumn">
        <option value="r_no">예약번호</option>
        <option value="p_name">프로그램명</option>
        <option value="u_id">아이디</option>
        </select>
        <input class="search_text" type="text" name="searchText" value="<?= isset($searchText) ? $searchText : null; ?>">
        <button class="btn glyphicon glyphicon-search" type="submit" value="검색"></button>
    </form>
</div>
  <div class="clearfix"></div>
<table class="table">
<thead class="hidden-xs"><tr><th>예약번호</th><th>프로그램명</th><th>아이디</th><th>예약날짜</th><th>취소</th></tr></thead><tbody>
<?php
    
if(isset($emptyData)){
echo $emptyData;
} else {while($row = mysqli_fetch_assoc($result)){
$datetime = explode(' ', $row['r_applydate']);
?>
<tr><td class="hidden-xs"><?=$row['r_no']?></td><td><?=$row['p_name']?><div class="hidden-sm hidden-md hidden-lg"><?=$row["u_id"]?> | <?=$row['r_applydate']?></div></td><td class="hidden-xs"><?=$row["u_id"]?></td>
<td class="hidden-xs"><?=$row['r_applydate']?></td>
<td><?php
if($row['r_applydate']>$enterday){
?>
<input class="btn btn-sm btn-warning" type="button" value="수정" onClick="location.href='reservation_form.php?p_id=<?=$row['p_id']?>&r_no=<?=$row['r_no']?>'">
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
<div class="clearfix"></div>
<?php
include '../lib/include_footer.php';
mysqli_close($conn);
?>