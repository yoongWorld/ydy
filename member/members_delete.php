<?php
include ("../lib/include.php");
$_SESSION["uri"] = $_SERVER["REQUEST_URI"];
if(isset($_SESSION["u_id"]))$u_id = $_SESSION["u_id"];
if(isset($_POST["u_pwd"]))$u_pwd = $_POST["u_pwd"];
if(!$_SESSION["u_id"]){
	echo "
		<script>
				alert('로그인을 먼저해주세요');
				location.href = '../login/login.php';
		</script>
	";
}
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
$sql="select * from member where u_id='$u_id'";
$result=mysqli_query($conn, $sql);
$num_match=mysqli_num_rows($result);
if(!isset($u_pwd)){
    echo("
      <script>
        window.alert('비밀번호를 입력하지 않았습니다.');
        history.go(-1);
      </script>
    ");
    exit;
  }
    $row=mysqli_fetch_array($result);
    $db_pass=$row['u_pwd'];
    if($u_pwd!=$db_pass){
      echo("
        <script>
          window.alert('비밀번호가 틀렸습니다.');
          history.go(-1);
        </script>
      ");
      exit;
    }
?>
<?php
if(isset($_GET['u_no']))$u_no=$_GET['u_no'];
if(isset($_GET['page']) && $_GET['page'] > 0){
    $page = $_GET['page'];
}
$sql="select * from member where u_id='$u_id'";
$result=mysqli_query($conn, $sql);

?>
<div class="clearfix"></div>
<main>
<div class="container sub_wrap">
<div class="sub-tab">
		<ul>
            <li><a href="members_info.php" class="a off">나의정보</a></li>
					<li><a href="members_reservation.php" class="off">예약내역</a></li>
					<li><a href="members_modify_prev.php" class="off">개인정보수정</a></li>
					<li><a href="members_delete_prev.php" class="on">회원탈퇴</a></li>
		</ul>
                <div class="sub_border"></div>
        <div class="clear"></div>
</div>
<div class="sub-tab-select">
<select name="jump" onchange="location.href=this.value">
<option value="members_delete_prev.php" > 회원탈퇴</option>
<option value="members_info.php"> 나의정보</option>
<option value="members_reservation.php"> 예약내역</option>
<option value="members_modify_prev.php"> 개인정보수정</option>
</select>
</div><div class="clearfix"></div>
       <div class="member_title">회원탈퇴</div>
        <hr class="hr">
        <form name="iForm" method="post" action="members_delete_save.php?u_no=<?=$u_no?>&page=<?=$page?>">
               <?php while($data = mysqli_fetch_array($result)){
    ?>
                        <input type="hidden" name="u_no" value="<?= $data['u_no'] ?>">
<div class="col-md-1"></div>  
<div class="col-md-10">
    <h2>회원탈퇴 전 유의하시기 바랍니다.</h2><br>
    <p class="members_delete">- 회원탈퇴 시 회원정보가 모두 사라집니다.<br>
    - 회원탈퇴 시 본 사이트의 회원전용 서비스를 이용할 수 없습니다.<br>
    - 회원탈퇴 시 미납 결제 요금과 환불 금액에 대한 사항은 관리자에게 문의 바랍니다.<br>
    - 회원탈퇴 후 재가입은 바로 가능하며 기존의 정보와 내역은 모두 사라집니다.</p>

                <div class="col-md-1"></div><div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-1"></div> 
                <hr>
                <div class="col-xs-12 btn_wrap text-center">
                    <input class="btn btn-default" type="submit" value="삭제" onclick="if(!confirm('정말로 회원 탈퇴 하시겠습니까?')){return false;}">
                </div>
        </form>
        </div>
<?php
    }
?>
</main>

<?php
include '../lib/include_footer.php';
?>