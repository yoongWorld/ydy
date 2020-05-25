<?php
include ("../lib/include.php");

if(isset($_GET['u_no']))$u_no=$_GET['u_no'];
?>
    <script>
        function check_id() {
            window.open("members_id_chk.php?u_id=" + document.member_form.u_id.value, "IDcheck", "left=200,top=200,width=400,height=200,text-align=center,scrollbars=no,resizable=yes");
        }
    </script>


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
       <div class="member_title">회원 등록</div>
        <hr class="hr">

<div class="clearfix"></div>
<div class="sec2">
                <form name="member_form" method="post" action="members_register_save.php" onSubmit="return post_check();" role="form">
                <div class="row input_wrap">
                    <div class="col-md-2"></div>
                    <div class="col-xs-12 col-md-2 input_title">아이디</div>
                    <div class="col-xs-12 col-md-6">
                        <input class="form-control" type="text" name="u_id" id="u_id" placeholder="아이디를 입력하세요." maxlength="20" onkeyup="showId(this.value)" autofocus required><br><a class="btn btn-warning" href="#" onclick="check_id();">중복확인</a><span class="form_span">&nbsp;6~20자의 영문 소문자, 숫자만 사용 가능</span>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row input_wrap">
                   <div class="col-md-2"></div>
                    <div class="col-xs-12 col-md-2 input_title">비밀번호</div>
                    <div class="col-xs-12 col-md-6"><input class="form-control" type="password" name="u_pwd" id="u_pwd" placeholder="비밀번호를 입력하세요." maxlength="20" onkeyup="showPwd(this.value)" required>
                        <p id="pwdHint" class="hint"></p>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row input_wrap">
                   <div class="col-md-2"></div>
                    <div class="col-xs-12 col-md-2 input_title">비밀번호 확인</div>
                    <div class="col-xs-12 col-md-6">
                        <input class="form-control" type="password" name="u_pwd_chk" placeholder="비밀번호확인을 입력하세요." maxlength="20" onkeyup="checkPwd()" required>
                        <p id="checkPwd" class="hint"></p>
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
                    <div class="col-xs-12 col-md-2 input_title">성별</div>
                    <div class="col-xs-12 col-md-6"><select class="form-control" name="u_gender" value="남" required>
                        <option value="남">남</option>
                        <option value="여">여</option></select>
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
                </div>
                <div class="col-xs-12 btn_wrap text-center">
                    <input class="btn-default" type="submit" href="#u_id" value="등록 하기">
                    <input class="btn-default" type="button" onClick="javascript:history.go(-1);return false;" value="취소">
                </div>
            </form>
        </div> 
    </div>
<div class="clearfix"></div></main>
<?php
include '../lib/include_footer.php';
?>