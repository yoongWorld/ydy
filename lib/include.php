<?php
session_start();
include ("dbconn.php");
ini_set('display_errors', 0);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <title>윤다윤 정광사 템플스테이</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/common.css<?php filemtime('../css/common.css')?>" type="text/css">
  <link rel="stylesheet" href="css/common.css<?php filemtime('css/common.css')?>" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #333;
      padding: 25px;
    }
    
  .carousel-inner img {
      width: 100%; /* Set width to 100% */
      margin: auto;
      min-height:200px;
  }

  /* Hide the carousel text when the screen is less than 600 pixels wide */
  @media (max-width: 600px) {
    .carousel-caption {
      display: none; 
    }
  }

  </style>
</head>
<body>
<!--
<div class="container-fluid logo_wrap">
<a class="logo" href="/templestay/index.php">정광사 템플스테이</a>
</div>
-->
<!--data-spy="affix" -->
<nav class="navbar navbar-default" data-spy="affix" data-offset-top="80">

  <div class="container">
   
    <div class="navbar-header center-block">
<!--     data-spy="affix"-->
      <button type="button" class="navbar-toggle navbar_toggle_button" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
       <a class="navbar-brand container-fluid" href="../index.php">정광사 템플스테이</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="../introduce/introduce.php">사찰 소개</a></li>
        <li><a href="../program/program.php">프로그램</a></li>
        <li><a href="../reservation/reservation_form.php">예약</a></li>
        <li><a href="../community/review_list.php">이용후기</a></li>
      </ul>
      <?php
        if(isset($_SESSION["u_id"]))$u_id = $_SESSION["u_id"]; ?>
        <ul class="nav navbar-nav navbar-right">
        <?php
        if(!isset($u_id)){ ?>
        <li><a href="../login/login.php"><span class="glyphicon glyphicon-log-in"></span> 로그인</a></li>
        <li><a href="../member/members_register.php"><span class="glyphicon glyphicon-user"></span> 회원가입</a></li>
        <?php
        }elseif($u_id == "admin"){ ?>
        <li><a href="../admin/reservation_list.php"><span class="glyphicon glyphicon-user"></span> 관리자페이지</a></li>
        <li><a href="../login/logout.php"><span class="glyphicon glyphicon-log-in"></span> 로그아웃</a></li>
        <?php
        }elseif(isset($u_id)){ ?>
        <li><a href="../member/members_info.php"><span class="glyphicon glyphicon-user"></span> 마이페이지</a></li>
        <li><a href="../login/logout.php"><span class="glyphicon glyphicon-log-in"></span> 로그아웃</a></li>
        <?php
        }
        ?>
      </ul>
    </div>
  </div>
</nav>
<div>
<a href="#" class="scrollToTop"><span class="glyphicon glyphicon-menu-up"></span></a>
</div>
<script>
$(document).ready(function(){
	
	//Check to see if the window is top if not then display button
	$(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
			$('.scrollToTop').fadeIn();
		} else {
			$('.scrollToTop').fadeOut();
		}
	});
	
	//Click event to scroll to top
	$('.scrollToTop').click(function(){
		$('html, body').animate({scrollTop : 0},800);
		return false;
	});
	
});    
</script>
