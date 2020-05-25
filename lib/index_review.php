<?php
$sql="select * from review order by rv_no desc limit 5";
$result = mysqli_query($conn,$sql);

    for($i=0;$row=mysqli_fetch_array($result);$i++){
        $sql2="select count(*) as cnt2 from reviewcomment where rv_no=".$row['rv_no'];
    $result2 = mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $coment = $row2['cnt2'];
    $strim = mb_strimwidth($row['rv_title'], '0', '35', '...', 'utf-8');
       $num=$row['rv_no'];
       $u_id=$row['u_id'];
       $rv_title=stripslashes($strim);
       $rv_date=substr($row['rv_date'], 0, 10);      
        echo"
         <tr>
         <td class='hidden-xs hidden-sm col-md-1'>$num</td>
         <td class='col-xs-9 col-sm-6  col-md-6'><a href='/community/review_view.php?no=$num'>$rv_title </a>"?>
         <?php if($row['rv_file_upload1']!=null){echo "<span class='glyphicon glyphicon-camera' style='color:#6a6763' aria-hidden='true'></span>";}?>
         <?php if($coment!=0){echo "<span style='color:#bbb'>[$coment]</span>";} echo "<div class='hidden-sm hidden-md hidden-lg index_review_info'>$u_id | $rv_date</div></td>"?>
         <?php echo "<td class='hidden-xs col-sm-2 col-md-2'><span>$u_id</span></td><td class='hidden-xs col-sm-4 col-md-4'><span>$rv_date</span>
         </td>
         </tr>"?>
 <?php }?>
