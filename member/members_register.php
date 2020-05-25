<?php
include ("../lib/include.php");
ini_set('display_errors', 0);
if($_SESSION["u_id"]){
	echo "
		<script>
				location.href = '../index.php';
		</script>
	";
}

?>
<script>
function showId(str) {
    if (str.length == 0) { 
        document.getElementById("idHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("idHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("POST", "members_id_ajax.php?u_id=" + str, true);
        xmlhttp.send();
    }
}
    
function showPwd(str) {
    if (str.length == 0) { 
        document.getElementById("pwdHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("pwdHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("POST", "members_pwd_ajax.php?u_pwd=" + str, true);
        xmlhttp.send();
    }
}
</script>
<script>
function checkPwd(){
  var f1 = document.forms[0];
  var pw1 = f1.u_pwd.value;
  var pw2 = f1.u_pwd_chk.value;
  if(pw1!=pw2){
   document.getElementById('checkPwd').style.color = "red";
   document.getElementById('checkPwd').innerHTML = "동일한 암호를 입력하세요."; 
  }else{
   document.getElementById('checkPwd').style.color = "#0059B3";
   document.getElementById('checkPwd').innerHTML = "암호가 확인 되었습니다."; 
  }
  
 }
</script>
<div class="col-sm-12 bgc_wrap">
    <img src="../img/temple12-2.jpg" class="img-fluid bgc_img" alt="Image">
    <div class="bgc_con_wrap1">
     <div class="hidden-xs bgc_con_wrap2">
      <p class="bgc_title">회원가입</p>
     </div>
      <p class="bgc_con">모든이에게 마음의 안정과 평화를 찾아주는<br>
        <mark class="mark">템플스테이</mark> 휴식 공간입니다.</p>
     </div>
</div>
<div class="clearfix"></div>
<main>
    <div class="container content_wrap">
       <h1 class="sec_title">회원가입</h1>
       <div class="clearfix"></div>
        <div>
                <form name="member_form" method="post" action="members_register_save.php" onSubmit="return post_check();" role="form">
                <div class="row input_wrap">
                    <div class="col-md-2"></div>
                    <div class="col-xs-12 col-md-2 input_title">아이디</div>
                    <div class="col-xs-12 col-md-6">
                        <input class="form-control" type="text" name="u_id" id="u_id" placeholder="아이디를 입력하세요." minlength="6" maxlength="20" onkeyup="showId(this.value)" autofocus required><span id="idHint" class="hint help-block"></span>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row input_wrap">
                   <div class="col-md-2"></div>
                    <div class="col-xs-12 col-md-2 input_title">비밀번호</div>
                    <div class="col-xs-12 col-md-6"><input class="form-control" type="password" name="u_pwd" id="u_pwd" placeholder="비밀번호를 입력하세요." minlength="6" maxlength="20" onkeyup="showPwd(this.value)" required>
                        <p id="pwdHint" class="hint"></p>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row input_wrap">
                   <div class="col-md-2"></div>
                    <div class="col-xs-12 col-md-2 input_title">비밀번호 확인</div>
                    <div class="col-xs-12 col-md-6">
                        <input class="form-control" type="password" name="u_pwd_chk" placeholder="비밀번호확인을 입력하세요." minlength="6" maxlength="20" onkeyup="checkPwd()" required>
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
                            <input class="col-md-3 tel_box form-control" type="text" class="u_tel" name="u_tel2" id="u_tel2" minlength="4" maxlength="4" required>
                        </div>
                        <div class="col-xs-4 col-md-4 tel_box">
                            <input class="col-md-3 tel_box form-control" type="text" class="u_tel" name="u_tel3" minlength="4" maxlength="4" required>
                        </div>
                    </div>
                </div>
                <input class="blind" type="hidden" name="level">
                <div class="col-xs-12 product_button_wrap">
                    <input class="btn btn-default" type="submit" href="#u_id" value="회원가입">
                </div>
        </form>
            </div>
        </div>
    </main>
<?php
include '../lib/include_footer.php';
?>