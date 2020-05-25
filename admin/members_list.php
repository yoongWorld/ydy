<?php
include ("../lib/include.php"); 

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

if(isset($_GET["u_no"]))$u_no=$_GET["u_no"];
/* 페이징 시작 */
	if(isset($_GET['page']) && $_GET['page'] > 0){
    $page = $_GET['page'];
}else{
    $page = 1;
}
/* 검색 시작 */
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
/* 검색 끝 */
$viewPage = 10; // 한 페이지에 보여줄 게시글의 수.$onePage ->$viewPage 수정
$viewSection = 5; //한번에 보여줄 총 페이지 개수(1 ~ 10, 11 ~ 20 ...)$oneSection->$viewSection으로 변수명 수정

?>
<?php
$sql = "select count(*) as cnt from member". $searchSql;
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

$allPost = $row['cnt']; //전체 게시글의 수

if(empty($allPost)) {
		$emptyData = "<tr><td colspan='10'>글이 존재하지 않습니다.</td></tr>";
	} else {

		
		$allPage = ceil($allPost / $viewPage); //전체 페이지의 수
		if($page < 1 && $page > $allPage) {
?>
<script>alert("존재하지 않는 페이지입니다."); history.back();
</script>

<?php
 exit;
		}
$currentSection = ceil($page / $viewSection); //현재 섹션
$allSection = ceil($allPage / $viewSection); //전체 섹션의 수
$firstPage = ($currentSection * $viewSection) - ($viewSection - 1); //현재 섹션의 처음 페이지    
if($currentSection == $allSection) {
			$lastPage = $allPage; //현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.
		} else {
			$lastPage = $currentSection * $viewSection; //현재 섹션의 마지막 페이지
		}
    $prevPage = (($currentSection - 1) * $viewSection); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.
		$nextPage = (($currentSection + 1) * $viewSection) - ($viewSection - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.
    ?>
    <div class="paging">
    <?php
    $paging = '<ul class="pagination pagination-sm">'; // 페이징을 저장할 변수
    //첫 페이지가 아니라면 처음 버튼을 생성
		if($page != 1) { 
			$paging .= '<li><a href="members_list.php?page=1 '. $subString . '">&laquo;</a></li>';
		}
		//첫 섹션이 아니라면 이전 버튼을 생성
		if($currentSection != 1) { 
			$paging .= '<li><a href="members_list.php?page=' . $prevPage . $subString . '">&lsaquo;</a></li>';
		}
		
		for($i = $firstPage; $i <= $lastPage; $i++) {
			if($i == $page) {
				$paging .= '<li class="active"><a href="#">' . $i . '</span>';
			} else {
				$paging .= '<li><a href="members_list.php?page=' . $i . $subString . '">' . $i . '</a></li>';
			}
		}
		
		//마지막 섹션이 아니라면 다음 버튼을 생성
		if($currentSection != $allSection) { 
			$paging .= '<li><a href="members_list.php?page=' . $nextPage . $subString . '">&#8250;</a></li>';
		}
		
		//마지막 페이지가 아니라면 끝 버튼을 생성
		if($page != $allPage) { 
			$paging .= '<li><a href="members_list.php?page=' . $allPage . $subString . '">&raquo</a></li>';
		}
		$paging .= '</ul>';
    
    ?>
    </div>
    <?php
    $currentLimit = ($viewPage * $page) - $viewPage; //몇 번째의 글부터 가져오는지
		$sqlLimit = ' limit ' . $currentLimit . ', ' . $viewPage; //limit sql 구문
		
		$sql = 'select * from member' . $searchSql . ' order by u_no desc' . $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지
		$result = mysqli_query($conn,$sql);
	}
?>
<main>
<div class="container sub_wrap">
<div class="sub-tab">
		<ul>
            <li><a href="reservation_list.php" class="off">예약관리</a></li>
            <li><a href="members_list.php" class="on">회원관리</a></li>
		</ul>
                <div class="sub_border"></div>
        <div class="clear"></div>
</div>
<div class="sub-tab-select">
<select name="jump" onchange="location.href=this.value">
<option value="members_list.php"> 회원관리</option>
<option value="reservation_list.php"> 예약관리</option>
</select>
</div><div class="clearfix"></div>
       <div class="member_title">회원 관리</div>
        <hr class="hr">
<div class="col-md-2"></div>  

<div class="clearfix"></div>
<div class="sec2">
    
    <div class="col-md-2"></div>
<div class="col-md-8">
<p class="all"><span class="badge"><?php echo $allPost?></span>명의 회원이 있습니다.</p>
<div class="search">
        <form class="search_box" action="members_list.php" method="get"><select class="search_select" name="searchColumn">
        <option value="u_name">이름</option>
        <option value="u_id">아이디</option>
        <option value="u_tel">전화번호</option>
        <option value="u_birthdate">생년월일</option>
        </select>
        <input class="search_text" type="text" name="searchText" value="<?= isset($searchText) ? $searchText : null; ?>">
        <button class="btn glyphicon glyphicon-search" type="submit" value="검색"></button>
    </form>
</div>
<table class="table text-centerd member_list">
<thead class="hidden-xs">
    <tr>
     <th>번호</th>
     <th>아이디</th>
     <th>이름</th>
     <th>성별</th>
     <th>전화번호</th>
     <th>생년월일</th>
     <th>수정 / 삭제</th>
    </tr>
</thead>
 <tbody>
  <?php if(isset($emptyData)) {echo $emptyData;} 
     else { while($row = mysqli_fetch_assoc($result)){
  ?>
 <tr>
  <td class="hidden-xs"><?= $row['u_no']?></td>
   <td><?= $row['u_id']?><span class="hidden-sm hidden-md hidden-lg">&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<?= $row['u_name']?><br><?= $row['u_tel']?>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<?=substr($row['u_birthdate'],0,10)?></span></td>
    <td class="hidden-xs"><?= $row['u_name']?></td>
    <td class="hidden-xs"><?= $row['u_gender']?></td>
    <td class="hidden-xs"><?= $row['u_tel']?></td>
    <td class="hidden-xs"><?=substr($row['u_birthdate'],0,10)?></td>
    <td><input class="btn btn-sm btn-warning" type="button" value="수정" onClick="location.href='members_modify_prev.php?u_no=<?=$row['u_no']?>&page=<?=$page?>'">
    <input class="btn btn-sm btn-warning" type="button" value="삭제" onClick="location.href='members_delete_prev.php?u_no=<?=$row['u_no']?>&page=<?=$page?>'"></td>
</tr>
<?php
    }
}
?>
  </tbody>
 </table><div class="clearfix"></div>
<div class="write_button_wrap">
        <button class="btn btn-default admin_btn" type="button" onClick="location.href='members_register.php'">회원등록하기</button></div>
        </div><div class="col-md-2"></div><div class="clearfix"></div>
<div class="paging text-center">
<?php 
if (isset($paging)) {
	echo $paging;
} else {
	echo "1";
}
?>
</div><div class="clearfix"></div>
    </div></div></main>
<?php
include '../lib/include_footer.php';
?>
