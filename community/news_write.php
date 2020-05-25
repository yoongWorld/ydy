<?php
include ("../lib/include.php"); 
$_SESSION["uri"] = $_SERVER["REQUEST_URI"];
?>
<div class="reviewlist_bgi">
    <div class="bgc"><p>커뮤니티</p><hr></div>
</div>
<div class="container">
<h2 class="readHide">Be With Us 소식</h2>

<form name="bWriteForm" action="news_write_chk.php" method="post" enctype="multipart/form-data">
 
<table class="table">
<tr>
    <td class="">제목&nbsp;|</td>
    <td ><input class="form-control" type="text" name="n_title" id="n_title" placeholder="제목을 입력해주세요." required="required"/></td>
</tr> 
<tr>
    <td class="">내용&nbsp;|</td>
    <td><textarea class="form-control" cols="50" rows="20" name="n_content" id="n_content" placeholder="내용을 입력해주세요." required="required"></textarea></td>
</tr>
<tr>
<td class="">그림파일&nbsp;|</td><td><input class="upfile_button form-control" type="file" name="upfile"></input></td>
</tr>
<tr>
<td colspan="2"><input class="" type="submit" value="글등록" onClick="write_save();">&nbsp;<input class="back_button" type="button" value=" 뒤로가기 " onClick="history.back();"></td>
</tr> 
</table>
</form>
</div>
<script>
function write_save()
{
    var f = document.bWriteForm;
    if(f.rv_title.value == ""){
        alert("글제목을 입력해 주세요.");
        return false;
    }
    if(f.rv_content.value == ""){
        alert("글내용을 입력해 주세요.");
        return false;
    }
    f.submit();
}
</script>
<?php
include ("../lib/include_footer.php");
?>