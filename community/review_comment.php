<?php
include ("../lib/dbconn.php");
$_SESSION["uri"] = $_SERVER["REQUEST_URI"];
?>
<?php
    $no=$_GET['no'];
    $page=$_GET['page'];
/* 페이징 시작 */
	if(isset($_GET['page2']) && $_GET['page2'] > 0){
    $page2 = $_GET['page2'];
}else{
    $page2 = 1;
}
/* 검색 시작 */
$subString_co = ""; $searchSql_co = '';

$viewPage_co = 5; // 한 페이지에 보여줄 게시글의 수.$onePage ->$viewPage 수정
$viewSection_co = 5; //한번에 보여줄 총 페이지 개수(1 ~ 10, 11 ~ 20 ...)$oneSection->$viewSection으로 변수명 수정

?>
<?php
$sql_co = "select count(*) as cnt from reviewcomment";
$result_co = mysqli_query($conn,$sql_co);
$row_co = mysqli_fetch_assoc($result_co);

$allPost_co = $row_co['cnt']; //전체 게시글의 수

if(empty($allPost_co)) {
		$emptyData_co = "<tr><td class='textCenter' colspan='6'>글이 존재하지 않습니다.</td></tr>";
	} else {

		
		$allPage_co = ceil($allPost_co / $viewPage_co); //전체 페이지의 수
		if($page2 < 1 && $page2 > $allPage_co) {
?>
<script>alert("존재하지 않는 페이지입니다."); history.back();
</script>

<?php
 exit;
		}
$currentSection_co = ceil($page2 / $viewSection_co); //현재 섹션
$allSection_co = ceil($allPage_co / $viewSection_co); //전체 섹션의 수
$firstPage_co = ($currentSection_co * $viewSection_co) - ($viewSection_co - 1); //현재 섹션의 처음 페이지    
if($currentSection_co == $allSection_co) {
			$lastPage_co = $allPage_co; //현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.
		} else {
			$lastPage_co = $currentSection_co * $viewSection_co; //현재 섹션의 마지막 페이지
		}
    $prevPage_co = (($currentSection_co - 1) * $viewSection_co); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.
		$nextPage_co = (($currentSection_co + 1) * $viewSection_co) - ($viewSection_co - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.
    ?>
    <div class="paging">
    <?php
    $sql2="select count(*) as cnt2 from reviewcomment where rv_no=".$row['rv_no'];
    $result2 = mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $coment = $row2['cnt2'];
    $paging_co = '<ul class="pagination pagination-sm">'; // 페이징을 저장할 변수
    //첫 페이지가 아니라면 처음 버튼을 생성
		if($page2 != 1) { 
			$paging_co .= '<li><a href="review_view.php?no='.$no.'&page='.$page.'&page2=1 '. $subString_co . '">처음</a></li>';
		}
		//첫 섹션이 아니라면 이전 버튼을 생성
		if($currentSection_co != 1) { 
			$paging_co .= '<li><a href="review_view.php?no='.$no.'&page='.$page.'&page2=' . $prevPage_co . $subString_co . '">이전</a></li>';
		}
		
		for($i = $firstPage_co; $i <= ceil($coment/$viewPage_co); $i++) {
			if($i == $page2) {
				$paging_co .= '<li class="active"><a href="#">' . $i . '</li>';
			} else {
				$paging_co .= '<li><a href="review_view.php?no='.$no.'&page='.$page.'&page2=' . $i . $subString_co . '">' . $i . '</a></li>';
			}
		}
		
		//마지막 섹션이 아니라면 다음 버튼을 생성
		if($currentSection_co != $allSection_co) { 
			$paging_co .= '<li"><a href="review_view.php?no='.$no.'&page='.$page.'&page2=' . $nextPage_co . $subString_co . '">다음</a></li>';
		}
		
		//마지막 페이지가 아니라면 끝 버튼을 생성
		if($page2 != ceil($coment/$viewPage_co)) { 
			$paging_co .= '<li><a href="review_view.php?no='.$no.'&page='.$page.'&page2=' . ceil($coment/$viewPage_co) . '">끝</a></li>';
		}
		$paging_co .= '</ul>';
    ?>
    </div>
    <?php
    $currentLimit_co = ($viewPage_co * $page2) - $viewPage_co; //몇 번째의 글부터 가져오는지
		$sqlLimit_co = ' limit ' . $currentLimit_co . ', ' . $viewPage_co; //limit sql 구문
		
		$sql_co = "select * from reviewcomment where rv_no=".$no." order by rvc_no desc" . $sqlLimit_co; //원하는 개수만큼 가져온다. (0번째부터 20번째까지
        
		$result_co= mysqli_query($conn,$sql_co);
	}

?>
<?php
	//$sql = "select * from reviewcomment where rvc_no=rvc_order and rv_no={$_GET['no']}";
	//$result = mysqli_query($conn,$sql);
    //$no=$_GET['no'];
    //$page=$_GET['page'];
    if(isset($_SESSION['u_id']))$u_id=$_SESSION['u_id'];
    

?>
<div class="col-sm-1"></div>
<div class="col-sm-10">
<div class="comment_wrap">
<form action="review_comment_chk.php" method="post">
	<input type="hidden" name="no" value="<?php echo $no?>">
	<input type="hidden" name="page" value="<?php echo $page?>">
	<input type="hidden" name="page2" value="<?php echo $page2?>">
	<br>
	<div class="comment_input_wrap">
       <div class="comment_box">
       <?php
            if(!$u_id){
                ?>
        <textarea class="form-control" name="coContent" id="coContent" cols="40" rows="5" disabled placeholder="로그인 후 댓글을 작성하실 수 있습니다."></textarea>
        <input class="btn-default comment_btn" type="submit" value="등록" disabled>
        <?php
    }elseif($u_id == "admin"){
                ?>
                <textarea class="form-control" name="coContent" id="coContent" cols="40" rows="5" disabled placeholder="관리자는 댓글을 작성하실 수 없습니다."></textarea>
        <input class="btn-default comment_btn" type="submit" value="등록" disabled>
        <?php
            }else{
        ?>
        <textarea class="form-control" name="coContent" id="coContent" cols="40" rows="5" required></textarea>
        </div> <input class="btn btn-default comment_btn" type="submit" value="등록">
        <?php
           }
           ?>
       <div class="clearfix"></div>
    </div>
</form>
<div class="comment_count">댓글 (<?= $coment ?>)</div><br>
<div id="commentView">
	<?php
		while($row_co= mysqli_fetch_assoc($result_co)) {
	?>
        <div class="comment_con_wrap">
				<span class="comment_id"><?=$row_co['u_id']?></span><span class="comment_date">&nbsp;|&nbsp;<?= substr($row_co['rvc_date'],0,10)?></span>
                <?php if($_SESSION['u_id']==$row_co['u_id'] or $_SESSION['u_id']=="admin"){?>&nbsp;&nbsp;
                <a class="comment_delete" href="review_comment_delete.php?no=<?= $row_co['rvc_no']?>" onclick="if(!confirm('댓글을 삭제하시겠습니까?')){return false;}">삭제</a><br>
                <?php } ?>
                <p class="comment_content"><?php echo nl2br($row_co['rvc_content'])?></p>
        </div>
         <?php
				}
			?>
</div><br>
<div class="paging2">
				<?php 
				if ($coment!=0) {
					echo $paging_co;
				} else {
					echo "<p class='paging2_none'>댓글이 없습니다.</p>";
				}
				?>
</div>
</div>
</div>
<div class="col-sm-1"></div>
<!--<script>
				alert('관리자는 답글을 달 수 없습니다.');
				history.go(-1);
		  </script>";-->