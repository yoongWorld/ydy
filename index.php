<?php
include ("lib/include.php");
//ini_set('display_errors', 0);
?>
<div class="container-fluid index_program_wrap">
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active center-block">
        <img class="center-block" src="img/buddhism3.png" alt="Image">
        <div class="carousel-caption">
          <h1 class="carousel_title">정광사</h1>
          <p class="carousel_con">모든이에게 마음의 안정과 평화를 찾아주는<br>
            <mark class="mark">템플스테이</mark> 휴식 공간입니다.</p>
        </div>      
      </div>

      <div class="item center-block">
        <img class="center-block" src="img/bgc3.png" alt="Image">
        <div class="carousel-caption">
          <h3 class="carousel_title">정광사</h3>
          <p class="carousel_con">모든이에게 마음의 안정과 평화를 찾아주는<br>
            <mark class="mark">템플스테이</mark> 휴식 공간입니다.</p>
        </div>      
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
 <div class="clearfix"></div>
  
<div class="container-fluid text-center animation">    
  <div class="row">
    <div class="col-sm-12 col-md-12 index_img2_wrap">
    
     <div class="index_img1_con_wrap">
      <p class="index_img2_title float">프<br>로<br>그<br>램</p>
         <p class="index_img2_con float">휴<br>식<br>형</p>
         <p class="index_img2_con float">단<br>체<br>형</p> <p class="index_img2_con float">새<br>해<br>맞<br>이<br>형</p><div class="clearfix"></div><br><br>
      <a class="btn-default index_btn" style="z-index:99999" href="program/program.php">자세히</a>
      </div><br><br>
        <div class="zindex">
<img src="img/introduce.png" class="img-responsive index_bgc" alt="인덱스 프로그램 배경이미지">
   </div>
      </div></div></div>
    <div class="clearfix"></div>
    
    <div class="col-sm-12 col-md-12 index_img1_wrap">
    <img src="img/landscape3-1.png" class="img-fluid index_img1" alt="Image">
     <div class="index_img1_con_wrap">
      <p class="index_img1_title">템플스테이란?</p>
      <p class="index_img1_con">삶의 쉼표가 필요할 때<br>마음이 쉬어가는 곳입니다.</p><br>
      <a class="btn-default index_btn" href="program/program.php">자세히</a>
      </div>
    </div><div class="clearfix"></div>
    
    
    <div class="container index_rv_rs_wrap">

        <div class="col-md-6 index_review_wrap col-md-12">
        <div class="col-xs-12 index_review_title">
        <p>이용후기</p>
        <a href="community/review_list.php"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></a>
        </div>
        <table class="table col-md-6">
            <thead class="hidden-xs hidden-sm"><tr><th>번호</th><th>제목</th><th>글쓴이</th><th>날짜</th></tr></thead>
            <tbody>
            <?php include ("lib/index_review.php"); ?> 
            </tbody>
        </table>
     </div>
<br>
    
    <div class="col-md-6 index_quickmenu">
     <div class="col-md-offset-1">
     <img src="img/buddgism5-1.png" alt="스님 아이콘">
      <h3>정광사에서의 하루</h3>
      <p>
일상에 몸도 마음도 지치신 분들을 위해<br>
정광사에서 마음 털어놓으시고 잠시 쉬었다 가실 수 있는<br>
원두막이 되어 드리려 합니다.</p>
      <a class="btn-default index_btn" href="reservation/reservation_form.php">
      예약 바로가기</a></div></div>
    </div>
</div><div class="clearfix"></div>
<?php
include ("lib/include_footer.php");
?>

