<?php
session_start();
include "../lib/dbconn.php";
$q = intval($_GET['q']);mysqli_select_db($conn,"ajax_demo");
$sql="SELECT * FROM product WHERE p_id = '".$q."'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);
$img_name=$row['p_img'];
$detail=$row['p_content'];
$detail=str_replace(" ","&nbsp;",$detail);
$detail=str_replace("\n","<br>",$detail); 
$pname=$row['p_name'];   

if(isset($_GET['r_no']))$r_no=$_GET['r_no'];
$sql2="select * from reservation a left join product b on a.p_id = b.p_id where r_no = '$r_no'";
$result2=mysqli_query($conn, $sql2);
$data2 = mysqli_fetch_array($result2);
?>

<?php

if(isset($row["p_id"])){?>
        <div class="container">
        
        <div class="hidden-xs col-sm-5 col-md-6 product_img1_wrap">
            <img class="img-responsive product_img1" src="<?=$row["p_img"]?>">
        </div>
        <div class="col-md-6 reservation_sec_wrap">
        
        <div class="col-sm-7 col-md-12 reservation_con_wrap">
        
        <div class="reservation_con_title"><h1><?=$row["p_name"]?></h1>
        </div>
        
        <div class="reservation_input_wrap">
        <div class="">
        <input class="form-control" id="redate" type="date" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>" name='r_applydate' required></div>
        <div class="">
        <input type="hidden" name="p_name" value="<?=$row['p_name'] ?>">
        <input type="hidden" name="p_id" value="<?=$row['p_id'] ?>">
        <input type="hidden" name="r_no" value="<?=$data2['r_no'] ?>">
        <input class="btn btn-default" id="resu" type="submit" value="수정하기">
        </div>
        </div>
        
        </div><div class="clearfix"></div>
        
        <div class="col-xs-12">
        <?=$row["p_content"]?>
        </div>
        </div>
        </div>
  
    <?php
    }else{
        ?>
        <div class="container">
        
        <div class="hidden-xs col-sm-5 col-md-6 product_img1_wrap">
            <img class="img-responsive product_img1" src="../img/review1-1.png">
        </div>
        <div class="col-md-6 reservation_sec_wrap">
        
        <div class="col-sm-7 col-md-12 reservation_con_wrap">
        
        <div class="reservation_con_title"><h1>프로그램</h1>
        </div>
        
        </div><div class="clearfix"></div>
        
        <div class="col-xs-12">
        프로그램 선택 전 아래 참가비와 유의사항을 참고바랍니다.
        </div>
        </div>
        </div>
        <?php
        }
    ?>

<?php mysqli_close($conn); ?>