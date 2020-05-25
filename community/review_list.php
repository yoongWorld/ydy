<?php
include ("../lib/include.php"); 
$_SESSION["uri"] = $_SERVER["REQUEST_URI"];
?>
<div class="col-sm-12 bgc_wrap">
    <img src="../img/temple17-1.jpg" class="img-fluid bgc_img" alt="Image">
    <div class="bgc_con_wrap1">
     <div class="hidden-xs bgc_con_wrap2">
      <p class="bgc_title">커뮤니티</p>
     </div>
      <p class="bgc_con">모든이에게 마음의 안정과 평화를 찾아주는<br>
        <mark class="mark">템플스테이</mark> 휴식 공간입니다.</p>
     </div>
</div>
<div class="clearfix"></div>
<main>
    <div class="container content_wrap">
       <h1 class="sec_title">이용후기</h1>
       <div class="clearfix"></div>
<?php
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

$viewPage = 5; // 한 페이지에 보여줄 게시글의 수.$onePage ->$viewPage 수정
$viewSection = 5; //한번에 보여줄 총 페이지 개수(1 ~ 10, 11 ~ 20 ...)$oneSection->$viewSection으로 변수명 수정


$sql = "select count(*) as cnt from review". $searchSql;
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

$allPost = $row['cnt']; //전체 게시글의 수

if(empty($allPost)) {
		$emptyData = "<tr><td class='textCenter' colspan='6'>글이 존재하지 않습니다.</td></tr>";
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
			$paging .= '<li><a href="review_list.php?page=1 '. $subString . '">&laquo;</a></li>';
		}
		//첫 섹션이 아니라면 이전 버튼을 생성
		if($currentSection != 1) { 
			$paging .= '<li><a href="review_list.php?page=' . $prevPage . $subString . '">&lsaquo;</a></li>';
		}
		
		for($i = $firstPage; $i <= $lastPage; $i++) {
			if($i == $page) {
				$paging .= '<li class="active"><a href="#">' . $i . '</li>';
			} else {
				$paging .= '<li><a href="review_list.php?page=' . $i . $subString . '">' . $i . '</a></li>';
			}
		}
		
		//마지막 섹션이 아니라면 다음 버튼을 생성
		if($currentSection != $allSection) { 
			$paging .= '<li><a href="review_list.php?page=' . $nextPage . $subString . '">&#8250;</a></li>';
		}
		
		//마지막 페이지가 아니라면 끝 버튼을 생성
		if($page != $allPage) { 
			$paging .= '<li><a href="review_list.php?page=' . $allPage . $subString . '">&raquo</a></li>';
		}
		$paging .= '</ul>';
    ?>
    </div>
    <?php
    $currentLimit = ($viewPage * $page) - $viewPage; //몇 번째의 글부터 가져오는지
		$sqlLimit = ' limit ' . $currentLimit . ', ' . $viewPage; //limit sql 구문
		
		$sql = 'select * from review' . $searchSql . ' order by rv_no desc' . $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지
		$result = mysqli_query($conn,$sql);
       
    
	}

?>


<div class="list_table">
<p class="hidden-xs all">&nbsp;&nbsp;<span class="badge"><?php echo $allPost?></span>개의 게시물이 있습니다.</p>
 <div class="searchBox">
<form action="review_list.php" method="get">
    <div class="col-sm-7"></div>
    <div class="col-sm-5 search_box">
    <select name="searchColumn">
		<option value="rv_title" selected="selected">제목</option>
		<option value="rv_content">내용</option>
	</select>
	<input type="text" name="searchText" value="<?= isset($searchText) ? $searchText : null; ?>">
	<button class="btn glyphicon glyphicon-search" type="submit" value="검색"></button></div>
</form>
</div>
<div class="clearfix"></div>
  <?php
   if(isset($emptyData)) {echo $emptyData;}
     else { while($row = mysqli_fetch_assoc($result)){
				$datetime = explode(' ', $row['rv_date']);
				$date = $datetime[0];
				$time = $datetime[1];
				if($date == Date('Y-m-d'))
				$row['rv_date'] = $date;
				else
				$row['rv_date'] = $date;
         
    $sql2="select count(*) as cnt2 from reviewcomment where rv_no=".$row['rv_no'];
    $result2 = mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $coment = $row2['cnt2'];
  ?>

 <?php
$strim = mb_strimwidth($row['rv_title'], '0', '50', '...', 'utf-8');
$strim2 = mb_strimwidth($row['rv_content'], '0', '350', '...', 'utf-8');
 ?>
<div class="clearfix"></div>
<div class="review_list_wrap">
 <?php if($row['rv_file_copy1']!=null){
     ?>
  <div class="col-xs-12 col-sm-4 review_img_wrap">
     <a href="review_view.php?no=<?= $row['rv_no']?>&page=<?=$page?>">
         <img class="img-responsive review_list_img" src="<?= "./data/".$row['rv_file_copy1']?>" onerror="this.style.display='none'"></a>
  </div>
  <?php
         }elseif($row['rv_file_copy1']==null){
         ?>
    <div class="col-xs-12 col-sm-4 review_img_wrap review_noimg_wrap"><a href="review_view.php?no=<?= $row['rv_no']?>&page=<?=$page?>"><span class='glyphicon text-center glyphicon-camera noimg' style='color:#6a6763' aria-hidden='true'></span><p class="text-center">이미지가 없습니다</p></a></div>
         <?php
    }
    ?>
   <div class="col-xs-12 col-sm-7">
   <div class="review_con_wrap">
   <a class="review_title" href="review_view.php?no=<?= $row['rv_no']?>&page=<?=$page?>"><?php echo $strim ?>&nbsp;<?php if($row['rv_file_upload1']!=null)?>&nbsp;<span style="color:#bbb"><?php if($coment!=0){echo "[".$coment."]";} ?></span><?php if(time() - strtotime($row['rv_date']) <= 60 * 60 * 24 ){
    echo "&nbsp;<span class='label label-warning'>new</span>";
}?></a>
   </div>
   <div class="review_caption">
    <span><?= $row['rv_date']?> | </span>
    <span><?= $row['u_id']?> | </span>
    <span>조회수 <?= $row['rv_hit']?></span>
   </div>
       <a href="review_view.php?no=<?= $row['rv_no']?>&page=<?=$page?>"><div class="review_con"><?php echo $strim2 ?></div></a>
    </div>
    </div>
    <div class="clearfix"></div><br>
<?php
 }
}
?>

 </div>

<?php
if($_SESSION['u_id']!="admin"){echo "<a href='review_write.php' class='btn-default write_btn'>글쓰기</a>";}elseif($_SESSION['u_id']=="admin"){echo"<div class='blind'></div>";}
?>
<div class="clearfix"></div><br>

<div class="paging">
<?php 
if (isset($paging)) {
	echo $paging;
} else {
	echo " ";
}
?>
	</div>
</div></main>
<div class="clearfix"></div>
<?php
include '../lib/include_footer.php';
?>