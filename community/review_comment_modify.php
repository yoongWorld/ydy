<?php
include ("../lib/dbconn.php");
$_SESSION["uri"] = $_SERVER["REQUEST_URI"];
?>
<?php
	$sql = "select * from reviewcomment where rvc_no=rvc_order and rv_no={$_GET['no']}";
	$result = mysqli_query($conn,$sql);
    $no=$_GET['no'];
    if(isset($_SESSION['u_id']))$u_id=$_SESSION['u_id'];
?>
<div id="commentView">
	<?php
		while($row = mysqli_fetch_assoc($result)) {
	?>
	<ul class="oneDepth">
		<li>
			<div>
				<span style=color:blue;><?=$row['u_id']?></span><span><?= substr($row['rvc_date'],0,10)?></span>
				<a href="review_comment_delete.php?no=<?= $row['rvc_no']?>" onclick="if(!confirm('댓글을 삭제하시겠습니까?')){return false;}">삭제</a>
                    <p><?php echo $row['rvc_content']?></p>
			</div>
         <?php
				}
			?>
		</li>
	</ul>
</div>

<h4>댓 글</h4>
<form action="review_comment_chk.php" method="post">
	<input type="hidden" name="no" value="<?php echo $no?>">
	<table>
		<tbody>
			<tr>
				<th scope="row"><label for="coContent">내용</label></th>
				<td><textarea name="coContent" id="coContent"></textarea></td>
			</tr>
		</tbody>
	</table>
	<div class="btnSet">
		<input type="submit" value="코멘트 작성">
	</div>
</form>


<?php
include ("../lib/include_footer.php");
?>