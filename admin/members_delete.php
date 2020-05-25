<?php
include ("../lib/include.php");

if($_POST['u_pwd'] == ""){
    ?>
    <script>
        alert("비밀번호를 입력해 주세요.");
        history.back();
    </script>
    <?php echo $_POST['u_pwd'];
    exit;
}
if($_POST['u_pwd'] != $chk_data['u_pwd']='admin'){
        ?>
        <script>
            alert("비밀번호가 다릅니다.");
            history.back();
        </script>
        <?
        exit;
    }
?>
<?php
if(isset($_GET['u_no']))$u_no=$_GET['u_no'];
if(isset($_GET['page']) && $_GET['page'] > 0){
    $page = $_GET['page'];
}else{
    $page = 1;
}
$page_row = 1;
$sql="select * from member where u_no='$u_no'";
$result=mysqli_query($conn, $sql);

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
       <div class="member_title">회원 삭제</div>
        <hr class="hr"><div class="clearfix"></div>
        <div class="col-sm-1"></div>
<form name="iForm" method="post" action="members_delete_save.php?u_no=<?=$u_no?>&page=<?=$page?>">
               <?php while($data = mysqli_fetch_array($result)){
    ?>

               <div class="hidden-xs col-md-2"></div>
               <div class="col-md-8">
                <div class="row input_wrap">
                    <div class="col-xs-12 col-md-3 input_title">아이디</div>
                    <div class="col-xs-12 col-md-9">
                        <div class="form-control"><?=$data['u_id']?></div>
                    </div>
                </div>
                <div class="row input_wrap">
                    <div class="col-xs-12 col-md-3 input_title">이름</div>
                    <div class="col-xs-12 col-md-9">
                        <div class="form-control"><?=$data['u_name']?></div>
                    </div>
                </div>
                <div class="row input_wrap">
                    <div class="col-xs-12 col-md-3 input_title">성별</div>
                    <div class="col-xs-12 col-md-9"><div class="form-control"><?=$data['u_gender']?></div>
                    </div>
                </div>
                <div class="row input_wrap">
                    <div class="col-xs-12 col-md-3 input_title">생년월일</div>
                    <div class="col-xs-12 col-md-9">
                        <div class="form-control"><?=$data['u_birthdate']?></div>
                    </div>
                </div>
                <div class="row input_wrap">
                    <div class="col-xs-12 col-md-3 input_title">전화번호</div>
                    <div class="col-xs-12 col-md-9">
                        <div class="form-control">
                            <?=$data['u_tel']?>
                        </div>
                    </div>
                </div>
                </div>
                <div class="hidden-xs col-md-2"></div><div class="clearfix"></div>
                <hr>
                <div class="clearfix"></div>
                
        
    <div class="col-xs-12 btn_wrap"><input class="btn btn-default" type="submit" value="삭제" onclick="if(!confirm('회원을 삭제하시겠습니까?')){return false;}">
    <input class="btn btn-default" type="button" value="취소" onClick="javascript:history.go(-2);return false;"></div>
</form>
<?php
    }
?>
    </div></main><?php
include '../lib/include_footer.php';
?>