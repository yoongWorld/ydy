<?php
include ("../lib/dbconn.php");
include ("../lib/include.php"); 
$_SESSION["uri"] = $_SERVER["REQUEST_URI"];
if(!isset($_SESSION["u_id"])){
?>
      <script>
            alert('로그인을 먼저해주세요.');
            location.href = '../login/login.php';
      </script>
   <?php
}if($_SESSION['u_id']=="admin"){?>
      <script>
            alert('관리자는 글을 쓸 수 없습니다.');
            location.href = 'review_list.php';
      </script>
   <?php
    }else{
?>
<div class="col-sm-12 bgc_wrap">
    <img src="../img/temple17-1.jpg" class="img-fluid bgc_img" alt="Image">
    <div class="bgc_con_wrap1">
     <div class="bgc_con_wrap2">
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
<form name="bWriteForm" action="review_write_chk.php" method="post" enctype="multipart/form-data" name="board_form" >
 
<div class="col-sm-1"></div>
<div class="col-sm-10 review_write">
    <div class="question_write">제목
    <input class="form-control" type="text" name="rv_title" id="rv_title" placeholder="제목을 입력해주세요." required="required"/></div><br>

    <div class="question_write question_write_con">내용
    <textarea class="form-control" cols="50" rows="20" name="rv_content" id="rv_content" placeholder="내용을 입력해주세요." required="required"></textarea></div><br>

<div class="review_write">그림파일<input class="form-control" type="file" name="upfile"></div>

<div colspan="2"><input class="btn-default" type="submit" value="글등록" onClick="write_save();">&nbsp;&nbsp;&nbsp;<input class="btn-default" type="button" value=" 뒤로가기 " onClick="history.back();"></div>
    </div>
<div class="col-sm-1"></div>
</form>
    </div>
</main>
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
}
?>