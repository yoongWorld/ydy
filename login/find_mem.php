<?php
include ("../lib/include.php");
if($_SESSION["u_id"]){
	echo "
		<script>
				alert('이미 로그인 되어있습니다.');
				location.href = '/index.php';
		</script>
	";
}
?>
<div class="col-sm-12 bgc_wrap">
    <img src="../img/temple12-2.jpg" class="img-fluid bgc_img" alt="Image">
    <div class="bgc_con_wrap1">
     <div class="hidden-xs bgc_con_wrap2">
      <p class="bgc_title">회원 찾기</p>
     </div>
      <p class="bgc_con">모든이에게 마음의 안정과 평화를 찾아주는<br>
        <mark class="mark">템플스테이</mark> 휴식 공간입니다.</p>
     </div>
</div>
<div class="clearfix"></div>
          <main>
           <div class="container content_wrap">
                <h1 class="sec_title">회원 찾기</h1>
                <div class="col-md-2"></div>
                <div class="col-md-8 find_titld">
                <h3>아이디 찾기</h3>
               <p>가입 시 입력하신 이름, 생년월일, 이메일을 입력해주세요.</p></div>
               <div class="col-md-2"></div><div class="clearfix"></div>
        <form name="member_form" method="post" action="find_id.php" onSubmit="return post_check();">
                <div class="row input_wrap">
                   <div class="col-md-2"></div>
                    <div class="col-xs-12 col-md-2 input_title">이름</div>
                    <div class="col-xs-12 col-md-6">
                        <input class="form-control" type="text" name="u_name" placeholder="이름을 입력하세요." required>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row input_wrap">
                   <div class="col-md-2"></div>
                    <div class="col-xs-12 col-md-2 input_title">생년월일</div>
                    <div class="col-xs-12 col-md-6">
                        <input class="form-control" type="date" name="u_birthdate" required>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row input_wrap">
                   <div class="col-md-2"></div>
                    <div class="col-xs-12 col-md-2 input_title">전화번호</div>
                    <div class="col-xs-12 col-md-6">
                        <div class="col-xs-4 col-md-4 tel_box">
                            <select class="tel_box form-control" name="u_tel1" required>
                                        <option value="010">010</option>
                                        <option value="011">011</option>
                                        <option value="016">016</option>
                                        <option value="017">017</option>
                                        <option value="018">018</option>
                                        <option value="019">019</option>
                                        </select>
                        </div>
                        <div class="col-xs-4 col-md-4 tel_box">
                            <input class="col-md-3 tel_box form-control" type="text" class="u_tel" name="u_tel2" id="u_tel2" maxlength="4" required>
                        </div>
                        <div class="col-xs-4 col-md-4 tel_box">
                            <input class="col-md-3 tel_box form-control" type="text" class="u_tel" name="u_tel3" maxlength="4" required>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>

            <div class="product_button_wrap">
                <input class="btn-default" type="submit" href="#u_id" value="찾기">
                <input class="btn-default" type="button" onClick="location.href=history.go(-1)" value="취소">
            </div>
        </form>

  <div>

                <div class="col-md-2"></div>
                <div class="col-md-8 find_titld">
                <h3>비밀번호 찾기</h3>
               <p>가입 시 입력하신 아이디, 이름, 생년월일, 이메일을 입력해주세요.</p></div>
               <div class="col-md-2"></div><div class="clearfix"></div>
        <form name="member_form" method="post" action="find_pwd.php" onSubmit="return post_check();">
                <div class="row input_wrap">
                    <div class="col-md-2"></div>
                    <div class="col-xs-12 col-md-2 input_title">아이디</div>
                    <div class="col-xs-12 col-md-6">
                        <input class="form-control" type="text" name="u_id" id="u_id" placeholder="아이디를 입력하세요." maxlength="20"required>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row input_wrap">
                   <div class="col-md-2"></div>
                    <div class="col-xs-12 col-md-2 input_title">이름</div>
                    <div class="col-xs-12 col-md-6">
                        <input class="form-control" type="text" name="u_name" placeholder="이름을 입력하세요." required>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row input_wrap">
                   <div class="col-md-2"></div>
                    <div class="col-xs-12 col-md-2 input_title">생년월일</div>
                    <div class="col-xs-12 col-md-6">
                        <input class="form-control" type="date" name="u_birthdate" required>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row input_wrap">
                   <div class="col-md-2"></div>
                    <div class="col-xs-12 col-md-2 input_title">전화번호</div>
                    <div class="col-xs-12 col-md-6">
                        <div class="col-xs-4 col-md-4 tel_box">
                            <select class="tel_box form-control" name="u_tel1" required>
                                        <option value="010">010</option>
                                        <option value="011">011</option>
                                        <option value="016">016</option>
                                        <option value="017">017</option>
                                        <option value="018">018</option>
                                        <option value="019">019</option>
                                        </select>
                        </div>
                        <div class="col-xs-4 col-md-4 tel_box">
                            <input class="col-md-3 tel_box form-control" type="text" class="u_tel" name="u_tel2" id="u_tel2" maxlength="4" required>
                        </div>
                        <div class="col-xs-4 col-md-4 tel_box">
                            <input class="col-md-3 tel_box form-control" type="text" class="u_tel" name="u_tel3" maxlength="4" required>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>

            <div class="product_button_wrap">
                <input class="btn-default" type="submit" href="#u_id" value="찾기">
                <input class="btn-default" type="button" onClick="location.href=history.go(-1)" value="취소">
            </div>
        </form>
  </div>
     </div>
  </main>
<?php
include '../lib/include_footer.php';
?>