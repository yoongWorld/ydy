<?php
include ("../lib/dbconn.php");
include ("../lib/include.php"); 
$_SESSION["uri"] = $_SERVER["REQUEST_URI"];
if(isset($_GET['u_id']))$u_id=$_GET['u_id'];
if(!$_SESSION["u_id"]){
	echo "
		<script>
				alert('로그인을 먼저해주세요');
				location.href = '../login/login.php';
		</script>
	";
}
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
$sql = "select count(*) as cnt from question left join review ". $searchSql;
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
    $paging = ''; // 페이징을 저장할 변수
    //첫 페이지가 아니라면 처음 버튼을 생성
		if($page != 1) { 
			$paging .= '<span class="page page_start"><a href="members_my_write.php?page=1 '. $subString . '">&laquo;</a></span>';
		}
		//첫 섹션이 아니라면 이전 버튼을 생성
		if($currentSection != 1) { 
			$paging .= '<span class="page page_prev"><a href="members_my_write.php?page=' . $prevPage . $subString . '">&lsaquo;</a></span>';
		}
		
		for($i = $firstPage; $i <= $lastPage; $i++) {
			if($i == $page) {
				$paging .= '<span class="page current">' . $i . '</span>';
			} else {
				$paging .= '<span class="page"><a href="members_my_write.php?page=' . $i . $subString . '">' . $i . '</a></span>';
			}
		}
		
		//마지막 섹션이 아니라면 다음 버튼을 생성
		if($currentSection != $allSection) { 
			$paging .= '<span class="page page_next"><a href="members_my_write.php?page=' . $nextPage . $subString . '">&rsaquo;</a></span>';
		}
		
		//마지막 페이지가 아니라면 끝 버튼을 생성
		if($page != $allPage) { 
			$paging .= '<span class="page page_end"><a href="members_my_write.php?page=' . $allPage . $subString . '">&raquo;</a></span>';
		}
		$paging .= '';
    ?>
    </div>
    <?php
    $currentLimit = ($viewPage * $page) - $viewPage; //몇 번째의 글부터 가져오는지
		$sqlLimit = ' limit ' . $currentLimit . ', ' . $viewPage; //limit sql 구문
		
		$sql = "select * from question a left join review b on a.q_no = b.rv_no where u_id='$u_id' . $searchSql . ' order by q_no desc, rv_no desc" . $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지
		$result = mysqli_query($conn,$sql);
	}
?>
<div class="mypage_bgi">
     <div class="bgc"><p>마이페이지</p><hr></div>
 </div>
<main>
<div class="member_wrap">
<div class="member_sec1">
    <div class="member_menu_wrap">
        <ul class="member_menu_float">
            <li><a href="members_info.php"><i class="mem_fa fa fa-user"></i><br>개인정보</a></li>
            <li><a href="members_reservation.php"><i class="mem_fa fa fa-calendar-check-o"></i><br>예매확인/취소</a></li>
            <li><a href="members_modify_prev.php"><i class="mem_fa fa fa-address-card-o"></i><br>개인정보수정</a></li>
            <li><a href="members_delete_prev.php"><i class="mem_fa fa fa-sign-out"></i><br>회원탈퇴</a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>
<div class="member_sec2">
   <h2 class="member_title">내가 쓴 글</h2>
  <div class="searchBox">
<form action="members_my_write.php" method="get">
					<select name="searchColumn" class="search">
						<option value="rv_title" selected="selected">제목</option>
						<option value="rv_content">내용</option>
					</select>
					<input class="search_text" type="text" name="searchText" value="<?= isset($searchText) ? $searchText : null; ?>">
					<button class="search_button" type="submit">검색</button>
				</form>
</div>

<table class="list_table">
<p class="all">* 전체 <span class="allPost"><?php echo $allPost?></span>개의 게시글이 있습니다.</p>
<thead>
    <tr>
     <th scope="col" class="no">번호</th>
     <th scope="col" >제목</th>
     <th scope="col" class="author">작성자</th>
     <th scope="col" class="date">조회수</th>
     <th scope="col" class="hit" >등록일</th>
    </tr>
</thead>
 <tbody>

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
 <tr>
 <?php
$strim = mb_strimwidth($row['rv_title'], '0', '50', '...', 'utf-8');
 ?>
  <td class="no"><?= $row['q_no'] || $row['rv_no']?></td>
   <td class="title">
   <a href="review_view.php?no=<?= $row['rv_no']?>&page=<?=$page?>"><?php echo $strim ?>&nbsp;<?php if($row['rv_file_upload1']!=null){echo "<img src='../img/camera.png'>";}?>&nbsp;<span style="color:#bbb"><?php if($coment!=0){echo "[".$coment."]";} ?></span><?php if(time() - strtotime($row['rv_date']) <= 60 * 60 * 24 ){
    echo "&nbsp;<span class='new_style'>new</span>";
}?></a>
   </td>
    <td class="author"><?= $row['u_id']?></td>
    <td class="hit"><?= $row['rv_hit']?></td>
    <td class="date"><?= $row['rv_date']?></td>
 </tr>
<?php
 }
}
?>
  </tbody>
 </table>
            <div class="paging">
				<?php 
				if (isset($paging)) {
					echo $paging;
				} else {
					echo " ";
				}
				?>
			</div>
<?php
if($_SESSION['u_id']){echo "<a href='review_write.php' class='btnWrite btn'>글쓰기</a>";}else{echo"<div class='button_hidden'></div>";}
?>
</div>
<div id="list_bottom"></div>
    </div>
</main>
<? include ("../lib/include_footer.php"); ?>    