<?php
include "../lib/include.php";
if($_SESSION["u_id"]){
	echo "
		<script>
				location.href = '../index.php';
		</script>
	";
}
?>
<div class="col-sm-12 bgc_wrap">
    <img src="../img/temple12-2.jpg" class="img-fluid bgc_img" alt="Image">
    <div class="bgc_con_wrap1">
     <div class="hidden-xs bgc_con_wrap2">
      <p class="bgc_title">로그인</p>
     </div>
      <p class="bgc_con">모든이에게 마음의 안정과 평화를 찾아주는<br>
        <mark class="mark">템플스테이</mark> 휴식 공간입니다.</p>
     </div>
</div>
<div class="clearfix"></div>
          <main>
           <div class="container content_wrap">
                <h1 class="sec_title">로그인</h1>
                <div class="form_wrap">
                    <form action="login_chk.php" method="post" name="index" class="login_form">
                      <div class="row login_input">
                      <div class="col-sm-3"></div>
                      <div class="col-sm-6">
                        <input type="hidden" name="returl" value="<? echo $_SERVER['PHP_SELF']?>" /> 
                        <input type="hidden" name="level">
                        <div class="col-sm-3">
                        <label class="login_label" for="u_id">아이디</label>
                        </div>
                        <div class="col-sm-9"><input class="form-control" type="text" name="u_id" id="u_id" class="login_box" placeholder="아이디를 입력해주세요." autofocus></div>
                          </div>
                          <div class="col-sm-3"></div>
                        </div>
                        <div class="row login_input">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6">
                        <div class="col-sm-3">
                        <label class="login_label" for="u_pwd">비밀번호</label></div>
                        <div class="col-sm-9">
                        <input class="form-control" type="password" name="u_pwd" id="u_pwd" class="login_box" placeholder="비밀번호를 입력해주세요."></div></div>
                        <div class="col-sm-3"></div>
                        </div>
                        <div class="row login_btn_wrap">
                          <div class="col-sm-3"></div>
                          <div class="col-sm-6">
                            <div class="col-xs-12 col-sm-3"></div>
                             <div class="col-sm-9" class="jutisfy">
                              <a href="../member/members_register.php">회원가입</a> | <a class="main_register" href="find_mem.php">아이디찾기 | 비밀번호찾기</a>
                              </div>
                        </div>
                        <div class="col-sm-3"></div>
                          </div>
                         <div class="row">
                          <div class="col-sm-3"></div>
                          <div class="col-sm-6">
                        <input class="col-xs-12 btn btn-default login_btn" type="submit" value="로그인" id="btn_login">
                        </div>
                        <div class="col-sm-3"></div>
                          </div>
                    </form>
                </div>
</div>
</main>
<?php
include '../lib/include_footer.php';
?>