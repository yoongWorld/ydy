<?php
include ("../lib/include.php");
$_SESSION["uri"] = $_SERVER["REQUEST_URI"];
if(!isset($_SESSION["u_id"])){
?>
<meta charset="utf-8">
    <script>
        alert("로그인을 먼저 해주세요.");
        location.href = '../login/login.php';
    </script>
    <?php
exit;}

if(isset($_GET["p_id"]));$p_id=$_GET["p_id"];
$sql="select * from product where p_id = '$p_id'";
$result=mysqli_query($conn, $sql);
$data = mysqli_fetch_array($result);

if(isset($_GET["r_no"]));$r_no=$_GET["r_no"];
$r_result   = mysqli_query($conn,"select * from `reservation`  where r_no = '".$_GET["r_no"]."' ");
$r_data     = mysqli_fetch_array($r_result);

?>
    <script>
        function showUser(str) {
            if (str == "") {
                document.getElementById("txtHint").innerHTML = "";
                return;
            } else {
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "getinfo.php?q=" + str, true);
                xmlhttp.send();
            }
        }
    </script>

<div class="col-sm-12 bgc_wrap">
    <img src="../img/temple11-1.jpg" class="img-fluid bgc_img" alt="Image">
    <div class="bgc_con_wrap1">
     <div class="hidden-xs bgc_con_wrap2">
      <p class="bgc_title">예약하기</p>
     </div>
      <p class="bgc_con">모든이에게 마음의 안정과 평화를 찾아주는<br>
        <mark class="mark">템플스테이</mark> 휴식 공간입니다.</p>
     </div>
</div>
<div class="clearfix"></div>
<main class="program_main">
   <div class="content_wrap">
    <div class="container program_title">
       <h1 class="sec_title">예약하기</h1>
       </div>
       <div class="clearfix"></div>
        <div class="container">
            <form class="reservation_form" name="reservation_from" method="post" action="insert.php" role="form">
                <div class="form-group col-xs-12">
                    <label for="color" class="hidden">프로그램 선택</label><select class="form-control" id="color" name="programs" onchange="showUser(this.value)">
                    <? 
                    
        if(isset($_GET["p_id"])){?>
        <option <? if($_GET["p_id"]) echo "selected"; ?> value="<?=$data["p_id"] ?>"><?=$data["p_name"] ?></option>
        <?php }else{ ?><option style="writing-mode:tb-lr;" selected="selected" value="6">프로그램 선택</option>
                    
<?php
}
$sql = "select p_name, p_id from product";
$result = $conn->query($sql);
$pnum=$result->num_rows;
for($i=0;$i<$pnum; $i++){mysqli_data_seek($result, $i);
$row = $result->fetch_assoc();
$item_name=$row['p_name'];
$item_name=str_replace(" ", "&nbsp;", $row['p_name']);
$pid=$row['p_id'];
?>
<option value="<?=$pid?>"><?=$item_name?></option>
    <?php
    }
    ?>
</select>
    </div>
    <div class="clearfix"></div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script>
        jQuery(document).ready(function() {
            var select = $("select#color");
            select.change(function() {
                var select_name = $(this).children("option:selected").text();
                $(this).siblings("label").text(select_name);
            });
        });
    </script>
    <div id="txtHint">
        <?php
        if(isset($p_id)){
        ?>
        
        <div class="container">
        
        <div class="hidden-xs col-sm-5 col-md-6 product_img1_wrap">
            <img class="img-responsive product_img1" src="<?=$data["p_img"]?>">
        </div>
        <div class="col-md-6 reservation_sec_wrap">
        
        <div class="col-sm-7 col-md-12 reservation_con_wrap">
        
        <div class="reservation_con_title"><h1><?=$data["p_name"]?></h1>
        </div>
        
        <div class="reservation_input_wrap">
        <div class="">
        <input class="form-control" id="redate" type="date" value="<?php echo date('Y-m-d'); ?>" min="<?php if(isset($_GET["r_no"])){echo $r_data["r_applydate"];}else{ echo date('Y-m-d'); }?>" name='r_applydate' required></div>
        <div class="">
        <input type="hidden" name="p_name" value="<?=$data['p_name'] ?>">
        <input type="hidden" name="p_id" value="<?=$data['p_id'] ?>">
        <?php
        if($_SESSION["u_id"]=="admin"){
            ?>
            <a href="../admin/reservation_list.php" class="btn btn-default" id="resu">예약 관리 바로가기</a>
        <?php
        }elseif($_SESSION["u_id"]!="admin"){
        ?>
        <input class="btn btn-default" id="resu" type="submit" value="예약하기">
        <?php
        }
        ?>
        </div>
        </div>
        
        </div><div class="clearfix"></div>
        
        <div class="col-xs-12">
        <?=$data["p_content"]?>
        </div>
        </div>
        </div>
    <?php
        }elseif(!$p_id){
        ?>
        <div class="container">
        
        <div class="hidden-xs col-sm-5 col-md-6 product_img1_wrap">
            <img class="img-responsive product_img1" src="../img/review1-1.png">
        </div>
        <div class="col-md-6 reservation_sec_wrap">
        
        <div class="col-sm-7 col-md-12 reservation_con_wrap">
        
        <div class="reservation_con_title"><h1>프로그램</h1>
        </div>
        
        </div>
        
        <div class="">
        프로그램 선택 전 아래 참가비와 주의사항을 참고바랍니다.
        </div>
        </div>
        </div>
        <?php
        }if(isset($p_id)){
        ?>
    
    <?php
    }
    ?>
    </div>
</form>
</div><br><br>

<div class="clearfix"></div>
<div class="hidden-xs col-md-12 program_con_wrap3">
    <div class="container">
	    <div class="col-xs-1 col-md-1 program_con_title2"><h3>참<br>가<br>비</h3></div>
        <div class="col-xs-11 col-md-11 product_short2">
            <div class="col-xs-12 col-md-10 product_table_wrap"><div class="product_table_title">1인 기준</div>
               <div class="col-xs-12 product_table_cap_wrap">
                <div class="col-xs-3 product_table_cap">구분</div>
                <div class="col-xs-3 product_table_cap">1박2일</div>
                <div class="col-xs-3 product_table_cap">2박3일</div>
                <div class="col-xs-3 product_table_cap">개인방사</div>
                </div>
                <div class="col-xs-3">일반실</div>
                <div class="col-xs-3">5만원</div>
                <div class="col-xs-3">8만원</div>
                <div class="col-xs-3">2만원 추가</div>
                <div class="col-xs-3">목조특실(욕실)</div>
                <div class="col-xs-3">5만원</div>
                <div class="col-xs-3">10만원</div>
                <div class="col-xs-3">4만원 추가</div>
                <div class="col-xs-12">* 1인 기준, 주말 참가비는 동일<br>* 2박 3일 이상도 가능합니다.</div>
            </div>
        </div>
    </div>
</div>

        
<div class="hidden-sm hidden-md hidden-lg container">
<div class="panel-group reservation_accordion" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a class="program_notice_title" data-toggle="collapse" data-parent="#accordion" href="#collapse1">참가비<span class="glyphicon glyphicon-menu-down"></span></a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body"><div class="col-xs-12 col-md-12">
        <div class="container">
		<div class="col-xs-1 col-md-1 program_con_title2"><h3>참<br>가<br>비</h3></div>
            <div class="col-xs-11 col-md-11 product_short2">
                <div class="col-xs-12 col-md-10 product_table_wrap"><div class="product_table_title">1인 기준</div>
                   <div class="col-xs-12 product_table_cap_wrap">
                    <div class="col-xs-3 product_table_cap">구분</div>
                    <div class="col-xs-3 product_table_cap">1박2일</div>
                    <div class="col-xs-3 product_table_cap">2박3일</div>
                    <div class="col-xs-3 product_table_cap">개인방사</div>
                  </div>
                    <div class="col-xs-3">일반실</div>
                    <div class="col-xs-3">5만원</div>
                    <div class="col-xs-3">8만원</div>
                    <div class="col-xs-3">2만원 추가</div>
                    <div class="col-xs-3">목조특실(욕실)</div>
                    <div class="col-xs-3">5만원</div>
                    <div class="col-xs-3">10만원</div>
                    <div class="col-xs-3">4만원 추가</div>
                    <div class="col-xs-12">* 1인 기준, 주말 참가비는 동일<br>* 2박 3일 이상도 가능합니다.</div>
                </div>
            </div>
        </div>
        </div>
		<div class="clearfix"></div></div>
      </div>
    </div>

  </div> 
   </div>
   
   
         <div class="hidden-xs col-md-12 program_con_wrap3">
        <div class="container">
		<div class="col-xs-1 col-md-1 program_con_title2"><h3>주<br>의<br>사<br>항</h3></div>
            <div class="col-xs-10 col-md-11 product_short2">
                <div class="product_table_wrap notice">
                    <img src="../img/clock.svg" alt="접시">오후 4시~ 5시까지 도착 하시길 바랍니다.<br>
                    <img src="../img/shirt.svg" alt="접시">참가준비물은 세면도구,편안한 옷, 등산화, 장갑, 수건, 필기도구 등입니다.<br>
                    <img src="../img/loud.svg" alt="접시">산사 체험기간에는 묵언을 기본으로 합니다. 필요이상의 말이나 큰소리는 내지 않습니다.<br>
                    <img src="../img/plate.svg" alt="접시">사찰에서 공양(식사)를 할때는 묵언을 하며 절대로 음식을 남기지 말고 자기가 먹을 만큼만 적당히 덜어서 먹습니다.<br>
                    <img src="../img/clean.svg" alt="접시">청소를 함으로써 몸으로 하는 일이 기쁨이고 수행임을 깨닫게 됩니다.<br>
                    <img src="../img/smoke.svg" alt="접시">사찰 도량 내에서는 금연입니다.<br>
                    <img src="../img/smile.svg" alt="접시">사찰 도량 내에서 스님을 만나면 합장반배 인사를 해야 합니다.
                </div>
            </div>
        </div>
        </div>
        
        <div class="clearfix"></div>
        
        <div class="hidden-sm hidden-md hidden-lg container">
<div class="panel-group reservation_accordion" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a class="program_notice_title" data-toggle="collapse" data-parent="#accordion" href="#collapse2">주의사항<span class="glyphicon glyphicon-menu-down"></span></a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body"><div class="col-xs-12 col-md-12">
        <div class="">
		<div class="hidden-xs col-md-1 program_con_title2"><h3>주<br>의<br>사<br>항</h3></div>
                <div class="col-md-11 notice">
                  <div class="row">
                   <div class="col-xs-2">
                    <img src="../img/clock.svg" alt="시계"></div><div class="col-xs-10">오후 4시~ 5시까지 도착 하시길 바랍니다.</div></div>
                    <div class="row">
                    <div class="col-xs-2">
                        <img src="../img/shirt.svg" alt="준비물"></div><div class="col-xs-10">참가준비물은 세면도구,편안한 옷, 등산화, 장갑, 수건, 필기도구 등입니다.</div></div>
                    <div class="row">
                    <div class="col-xs-2">
                        <img src="../img/loud.svg" alt="묵언"></div><div class="col-xs-10">산사 체험기간에는 묵언을 기본으로 합니다. 필요이상의 말이나 큰소리는 내지 않습니다.</div></div><div class="row">
                        <div class="col-xs-2"><img src="../img/plate.svg" alt="식사"></div><div class="col-xs-10">사찰에서 공양(식사)를 할때는 묵언을 하며 절대로 음식을 남기지 말고 자기가 먹을 만큼만 적당히 덜어서 먹습니다.</div></div>
                    <div class="row">
                        <div class="col-xs-2"><img src="../img/clean.svg" alt="청소"></div><div class="col-xs-10">청소를 함으로써 몸으로 하는 일이 기쁨이고 수행임을 깨닫게 됩니다.</div></div><div class="row">
                    <div class="col-xs-2"><img src="../img/smoke.svg" alt="금연"></div><div class="col-xs-10">사찰 도량 내에서는 금연입니다.</div></div>
                    <div class="row">
                        <div class="col-xs-2"><img src="../img/smile.svg" alt="인사"></div><div class="col-xs-10">사찰 도량 내에서 스님을 만나면 합장반배 인사를 해야 합니다.</div>
                </div>
            </div>
        </div>
        </div>
		<div class="clearfix"></div></div>
      </div>
    </div>

  </div> 
   </div>
   
    <img src="../img/temple17-2.png" class="img-responsive product_bgc" alt="프로그램 배경이미지">

<div class="clearfix"></div>
</div>
</main>
<?php include "../lib/include_footer.php" ?>