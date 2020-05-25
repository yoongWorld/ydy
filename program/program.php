<?php
include ("../lib/include.php");
include ("../lib/lib.php");
$_SESSION["uri"] = $_SERVER["REQUEST_URI"];
if(isset($_GET["u_no"])) $u_no=$_GET["u_no"];



//// 2. 페이지 변수 설정
//if(isset($_GET["num"])) $num=$_GET["num"];
//
//if(isset($_GET['page']) && $_GET['page'] > 0){
//    // 현재 페이지 값이 존재하고 0 보다 크면 그대로 사용
//    $page = $_GET['page'];
//}else{
//    // 그 외의 경우는 현재 페이지를 1로 설정
//    $page = 1;
//}
//
//
//
//// 한 페이지에 보일 글 수
//$page_row = 10;
//// 한줄에 보여질 페이지 수
//$page_scale = 5;
//// 페이징을 출력할 변수 초기화
//$paging_str = "";
//
//// 3. 전체 글 갯수 알아내기
//$sql = "select count(*) as cnt from product where 1";
//$total_count = sql_total($sql);
//
//// 4. 페이지 출력 내용 만들기
//$paging_str = paging($page, $page_row, $page_scale, $total_count);
//
//// 5. 시작 열을 구함
//$from_record = ($page - 1) * $page_row;

// 6. 글목록 구하기
$query1 = "select * from product where p_id = 0";
$result1 = mysqli_query($conn,$query1);
$data1 = mysqli_fetch_array($result1);

$query2 = "select * from product where p_id = 1";
$result2 = mysqli_query($conn,$query2);
$data2 = mysqli_fetch_array($result2);

$query3 = "select * from product where p_id = 2";
$result3 = mysqli_query($conn,$query3);
$data3 = mysqli_fetch_array($result3);


?>
<div class="col-sm-12 bgc_wrap">
    <img src="../img/haetae2-2.jpg" class="img-fluid bgc_img" alt="Image">
    <div class="bgc_con_wrap1">
     <div class="hidden-xs bgc_con_wrap2">
      <p class="bgc_title">프로그램</p>
     </div>
      <p class="bgc_con">모든이에게 마음의 안정과 평화를 찾아주는<br>
        <mark class="mark">템플스테이</mark> 휴식 공간입니다.</p>
     </div>
</div>
<div class="clearfix"></div>
<main>
<div class="content_wrap">
 <div class="container program_title">
  <h1 class="sec_title">프로그램 안내</h1>
 </div>
  <div class="hidden-xs container program_title">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">휴식형<br><span class="title_caption">REST TYPE</span></a></li>
    <li><a data-toggle="tab" href="#menu1">단체형<br><span class="title_caption">GROUP TYPE</span></a></li>
    <li><a data-toggle="tab" href="#menu2">새해맞이형<br><span class="title_caption">NEW YEAR TYPE</span></a></li>
  </ul>
  </div>
  <div class="hidden-sm hidden-md hidden-lg container program_title">
  <ul class="nav nav-tabs">
    <li class="active"><a class="program_xs_tab" data-toggle="tab" href="#home" style="padding-right:45px">휴<br>식<br>형</a></li>
    <li><a class="program_xs_tab" data-toggle="tab" href="#menu1" style="padding-right:45px">단<br>체<br>형</a></li>
    <li><a class="program_xs_tab" data-toggle="tab" href="#menu2">새<br>해<br>맞<br>이<br>형</a></li>
  </ul>
  </div>
  <div class="tab-content">
      <div id="home" class="tab-pane fade in active">
		<div class="program_wrap">
		<div class="container">
		<div class="hidden-xs col-sm-6 product_img1_wrap">
		<img class="img-responsive product_img1" src="<?=$data1['p_img']?>" alt="휴식형 사진">
		</div>
		<div class="col-xs-12 col-sm-6 program_con_wrap">
		<div class="hidden-xs col-md-12 program_con_title"><h1>휴<br>식<br>형</h1></div><button class="col-xs-12 btn-default" onClick="location.href='../reservation/reservation_form.php?p_id=<?=$data1['p_id']?>'">예약하기</button>
		<div class="col-xs-12">
		<p class="product_short"><?=nl2br($data1['p_content']) ?></p></div></div></div>
		<div class="clearfix"></div>
      
       
        <div class="container-fluid col-xs-12 col-md-12 program_con_wrap2">
        <div class="container">
		<div class="col-xs-2 col-md-1 program_con_title2"><h3>일<br>정<br>표</h3></div>
            <div class="col-xs-10 col-md-11 product_short2">
                <div class="col-xs-12 col-md-6 product_table_wrap"><div class="product_table_title">오전</div>
                   <div class="col-xs-12 product_table_cap_wrap">
                    <div class="col-xs-3 col-md-3 product_table_cap">시간</div>
                    <div class="col-xs-9 col-md-9 product_table_cap">프로그램</div>
                   </div>
                    <div class="col-xs-3 col-md-3">4:00</div>
                    <div class="col-xs-9 col-md-9">아침 예불</div>
                    <div class="col-xs-3 col-md-3">5:00</div>
                    <div class="col-xs-9 col-md-9">자유 휴식명상</div>
                    <div class="col-xs-3 col-md-3">7:00</div>
                    <div class="col-xs-9 col-md-9">아침 공양</div>
                    <div class="col-xs-3 col-md-3">8:00</div>
                    <div class="col-xs-9 col-md-9">울력, 걷기명상</div>
                    <div class="col-xs-3 col-md-3">9:00</div>
                    <div class="col-xs-9 col-md-9">자유 휴식명상</div>
                    <div class="col-xs-3 col-md-3">11:00</div>
                    <div class="col-xs-9 col-md-9">점심공양</div>
                </div>
                <div class="col-xs-12 col-md-6 product_table_wrap"><div class="product_table_title">오후</div>
                   <div class="col-xs-12 product_table_cap_wrap">
                    <div class="col-xs-3 col-md-3 product_table_cap">시간</div>
                    <div class="col-xs-9 col-md-9 product_table_cap">프로그램</div>
                   </div>
                    <div class="col-xs-3 col-md-3">12:30</div>
                    <div class="col-xs-9 col-md-9">자유 휴식명상</div>
                    <div class="col-xs-3 col-md-3">5:00</div>
                    <div class="col-xs-9 col-md-9">사찰예절 안내</div>
                    <div class="col-xs-3 col-md-3">5:30</div>
                    <div class="col-xs-9 col-md-9">저녁공양</div>
                    <div class="col-xs-3 col-md-3">6:30</div>
                    <div class="col-xs-9 col-md-9">저녁예불</div>
                    <div class="col-xs-3 col-md-3">7:10</div>
                    <div class="col-xs-9 col-md-9">다담(휴식명상법 배우기 )</div>
                    <div class="col-xs-3 col-md-3">10:00</div>
                    <div class="col-xs-9 col-md-9">취침</div>
                </div>
            </div>
        </div>
        </div>
		<div class="clearfix"></div>
		</div>
      </div>
      
      <div id="menu1" class="tab-pane fade">
        <div class="program_wrap">
		<div class="container">
		<div class="hidden-xs col-sm-6 product_img1_wrap">
		<img class="img-responsive product_img1" src="<?=$data2['p_img']?>" alt="휴식형 사진">
		</div>
		<div class="col-xs-12 col-sm-6 program_con_wrap">
		<div class="hidden-xs col-md-12 program_con_title"><h1>단<br>체<br>형</h1></div><button class="col-xs-12 btn-default" onClick="location.href='../reservation/reservation_form.php?p_id=<?=$data2['p_id']?>'">예약하기</button>
		<p class="col-md-12 product_short"><?=nl2br($data2['p_content']) ?></p></div></div>
		<div class="clearfix"></div>
		
        <div class="container-fluid col-xs-12 col-md-12 program_con_wrap2">
        <div class="container">
		<div class="col-xs-2 col-md-1 program_con_title2"><h3>일<br>정<br>표</h3></div>
            <div class="col-xs-10 col-md-11 product_short2">
                <div class="col-xs-12 col-md-6 product_table_wrap"><div class="product_table_title">오전</div>
                   <div class="col-xs-12 product_table_cap_wrap">
                    <div class="col-xs-3 col-md-3 product_table_cap">시간</div>
                    <div class="col-xs-9 col-md-9 product_table_cap">프로그램</div>
                   </div>
                    <div class="col-xs-3 col-md-3">4:00</div>
                    <div class="col-xs-9 col-md-9">아침 예불</div>
                    <div class="col-xs-3 col-md-3">5:00</div>
                    <div class="col-xs-9 col-md-9">자유 휴식명상</div>
                    <div class="col-xs-3 col-md-3">7:00</div>
                    <div class="col-xs-9 col-md-9">아침 공양</div>
                    <div class="col-xs-3 col-md-3">8:00</div>
                    <div class="col-xs-9 col-md-9">울력, 걷기명상</div>
                    <div class="col-xs-3 col-md-3">9:00</div>
                    <div class="col-xs-9 col-md-9">자유 휴식명상</div>
                    <div class="col-xs-3 col-md-3">11:00</div>
                    <div class="col-xs-9 col-md-9">점심공양</div>
                </div>
                <div class="col-xs-12 col-md-6 product_table_wrap"><div class="product_table_title">오후</div>
                   <div class="col-xs-12 product_table_cap_wrap">
                    <div class="col-xs-3 col-md-3 product_table_cap">시간</div>
                    <div class="col-xs-9 col-md-9 product_table_cap">프로그램</div>
                   </div>
                    <div class="col-xs-3 col-md-3">12:30</div>
                    <div class="col-xs-9 col-md-9">자유 휴식명상</div>
                    <div class="col-xs-3 col-md-3">5:00</div>
                    <div class="col-xs-9 col-md-9">사찰예절 안내</div>
                    <div class="col-xs-3 col-md-3">5:30</div>
                    <div class="col-xs-9 col-md-9">저녁공양</div>
                    <div class="col-xs-3 col-md-3">6:30</div>
                    <div class="col-xs-9 col-md-9">저녁예불</div>
                    <div class="col-xs-3 col-md-3">7:10</div>
                    <div class="col-xs-9 col-md-9">다담(휴식명상법 배우기 )</div>
                    <div class="col-xs-3 col-md-3">10:00</div>
                    <div class="col-xs-9 col-md-9">취침</div>
                </div>
            </div>
        </div>
        </div>
		<div class="clearfix"></div>

		</div>
      </div>
      <div id="menu2" class="tab-pane fade">
        <div class="program_wrap">
		<div class="container">
		<div class="hidden-xs col-sm-6 product_img1_wrap">
		<img class="img-responsive product_img1" src="<?=$data3['p_img']?>" alt="휴식형 사진">
		</div>
		<div class="col-xs-12 col-sm-6 program_con_wrap">
		<div class="hidden-xs col-md-12 program_con_title"><h1>새<br>해<br>맞<br>이<br>형</h1></div><button class="col-xs-12 btn-default" onClick="location.href='../reservation/reservation_form.php?p_id=<?=$data3['p_id']?>'">예약하기</button>
		<p class="col-md-12 product_short"><?=nl2br($data3['p_content']) ?></p></div></div>
		<div class="clearfix"></div>
		
        <div class="container-fluid col-xs-12 col-md-12 program_con_wrap2">
        <div class="container">
		<div class="col-xs-2 col-md-1 program_con_title2"><h3>일<br>정<br>표</h3></div>
            <div class="col-xs-10 col-md-11 product_short2">
                <div class="col-xs-12 col-md-6 product_table_wrap"><div class="product_table_title">오전</div>
                   <div class="col-xs-12 product_table_cap_wrap">
                    <div class="col-xs-3 col-md-3 product_table_cap">시간</div>
                    <div class="col-xs-9 col-md-9 product_table_cap">프로그램</div>
                   </div>
                    <div class="col-xs-3 col-md-3">4:00</div>
                    <div class="col-xs-9 col-md-9">아침 예불</div>
                    <div class="col-xs-3 col-md-3">5:00</div>
                    <div class="col-xs-9 col-md-9">자유 휴식명상</div>
                    <div class="col-xs-3 col-md-3">7:00</div>
                    <div class="col-xs-9 col-md-9">아침 공양</div>
                    <div class="col-xs-3 col-md-3">8:00</div>
                    <div class="col-xs-9 col-md-9">울력, 걷기명상</div>
                    <div class="col-xs-3 col-md-3">9:00</div>
                    <div class="col-xs-9 col-md-9">자유 휴식명상</div>
                    <div class="col-xs-3 col-md-3">11:00</div>
                    <div class="col-xs-9 col-md-9">점심공양</div>
                </div>
                <div class="col-xs-12 col-md-6 product_table_wrap"><div class="product_table_title">오후</div>
                   <div class="col-xs-12 product_table_cap_wrap">
                    <div class="col-xs-3 col-md-3 product_table_cap">시간</div>
                    <div class="col-xs-9 col-md-9 product_table_cap">프로그램</div>
                   </div>
                    <div class="col-xs-3 col-md-3">12:30</div>
                    <div class="col-xs-9 col-md-9">자유 휴식명상</div>
                    <div class="col-xs-3 col-md-3">5:00</div>
                    <div class="col-xs-9 col-md-9">사찰예절 안내</div>
                    <div class="col-xs-3 col-md-3">5:30</div>
                    <div class="col-xs-9 col-md-9">저녁공양</div>
                    <div class="col-xs-3 col-md-3">6:30</div>
                    <div class="col-xs-9 col-md-9">저녁예불</div>
                    <div class="col-xs-3 col-md-3">7:10</div>
                    <div class="col-xs-9 col-md-9">다담(휴식명상법 배우기 )</div>
                    <div class="col-xs-3 col-md-3">10:00</div>
                    <div class="col-xs-9 col-md-9">취침</div>
                </div>
            </div>
        </div>
        </div>
		<div class="clearfix"></div>
        
		
		</div>
      </div>
  </div>
  <div class="clearfix"></div><br><br>    

		<div class="clearfix"></div>  
		<div class="container">
<div class="col-md-1"></div>
<div class="col-md-10 container">
  <h3 class="accordion_title">자주하는 질문</h3>
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><strong>Q. </strong>새벽예불이나 108배 같은 수행프로그램에 꼭 참여해야 하는 건가요?<span class="glyphicon glyphicon-menu-down"></span></a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse">
        <div class="panel-body"><strong>A. </strong>꼭 그렇지는 않습니다.
일상에서 벗어나 산사에서 맞는 새벽의 기운을 느껴보고 부처님과 마주하는 새벽예불은 이제껏 경험하지 못한 특별한 시간이 될 것입니다.
108배의 경우 몸이 불편하거나, 어린아이와 동반하여 참석이 어려운 경우 먼저 양해를 구하고 참여하지 않아도 괜찮습니다. 
만약 종교적 이유로 절을 하기 가 부담이 되신다면 조용히 앉아 있기만 해도 충분합니다. 
종교와 관계없이 건강에 좋은 108배는 한번쯤 체험해 보는 것도 좋을 것 같습니다.</div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><strong>Q. </strong>템플스테이는 어떻게 참가 하나요?<span class="glyphicon glyphicon-menu-down"></span></a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body"><strong>A. </strong>사전예약이 필수이므로 사찰로 직접 예약을 하시고 참가하시기 바랍니다.
단체 참가의 경우, 일정 조정이 가능합니다.</div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse3"><strong>Q. </strong>참가 시 준비물은 무엇인가요?<span class="glyphicon glyphicon-menu-down"></span></a>
        </h4>
      </div>
      <div id="collapse3" class="panel-collapse collapse">
        <div class="panel-body"><strong>A. </strong>대부분 사찰에서는 참가자에게 수련복을 지급하고 있습니다.
어린이를 위한 수련복이 부족한경우가 발생할 수 있사오니, 아이들을 위한 편한 옷을 준비해주시면 좋을 것 같습니다.
또한 개인 세면도구와 환절기 및 겨울철의 따뜻한 옷을 준비하시면 더욱 편안한 템플스테이를 경험하실 수 있습니다.</div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse4"><strong>Q. </strong>참가비는 얼마인가요?<span class="glyphicon glyphicon-menu-down"></span></a>
        </h4>
      </div>
      <div id="collapse4" class="panel-collapse collapse">
        <div class="panel-body"><strong>A. </strong>1박2일 성인1인 기준, 체험 형 프로그램은 5만원에서 7만원 정도의 비용이며, 숙식비와 프로그램 진행에 필요한 제반 경비를 포함한 금액입니다. (휴식 형은 2만원에서 3만원가량) 예약하기 페이지에서도 확인하실 수 있으며 
프로그램별, 대상별 참가비용에 차이가 있으니 자세한 내용은 사찰에 문의해 주시기 바랍니다.</div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse5"><strong>Q. </strong>숙소는 개인별로 배정이 되나요?<span class="glyphicon glyphicon-menu-down"></span></a>
        </h4>
      </div>
      <div id="collapse5" class="panel-collapse collapse">
        <div class="panel-body"><strong>A. </strong>일반적으로 사찰에서는 남녀로 구분하여 각각 대중방을 사용합니다.
그러나 가족단위 및 소규모 참가자의 경우 사찰에 따라 개별로 방을 제공하기도 합니다.</div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse6"><strong>Q. </strong>템플스테이 참가 시 사찰에서 교통편을 제공하나요?<span class="glyphicon glyphicon-menu-down"></span></a>
        </h4>
      </div>
      <div id="collapse6" class="panel-collapse collapse">
        <div class="panel-body"><strong>A. </strong>일반적으로는 개별적으로 대중교통이나 자가용을 이용하셔야 합니다.
대중교통 이용 시 일부 사찰에서는 사찰 인근의 역 또는 터미널로 마중을 나가거나, 셔틀버스를 운영하기도 합니다.
자세한 내용은 참가 예약 시 사찰에 문의하시기 바랍니다.</div>
      </div>
    </div>
  </div> 
</div>
<div class="col-md-1"></div>
</div>  


    <div class="clearfix"></div>
</div>

</main>


<?php 

include ("../lib/include_footer.php"); ?>