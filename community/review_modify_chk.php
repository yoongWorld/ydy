<?php
include ("../lib/dbconn.php");
include ("../lib/include.php"); 
if(!isset($_SESSION["u_id"])){
?>
      <script>
            alert('로그인을 먼저해주세요.');
            location.href = '../login/login.php';
      </script>
   <?php
}else{
$page = $_POST['page'];
$no = $_POST['no'];
$rv_title = $_POST['rv_title'];
$rv_content = $_POST['rv_content'];

$files=$_FILES["upfile"];
$count=count($files["name"]);
$upload_dir="data/";
$upfile_name=$files["name"];
$upfile_tmp_name=$files["tmp_name"];
$upfile_type=$files["type"];
$upfile_size=$files["size"];
$upfile_error=$files["error"];
$file=explode(".", $upfile_name);
if(!$upfile_error)
    {
    $new_file_name=date("Y_m_d_H_i_s");
    $new_file_name.="_";
    $copied_file_name=$new_file_name;
    $uploaded_file=$upload_dir.$copied_file_name;
if($upfile_size>5000000){
        echo("
        <script>
        alert('파일 용량이 큽니다 5M이하의 파일만 가능합니다.');
        history.go(-1);
        </script>
        ");
        exit;
      }
      if(($upfile_type!="image/gif") && ($upfile_type!="image/jpeg") && ($upfile_type!="image/jpg") && ($upfile_type!="image/png")){
        echo("
        <script>
        alert('jpg, png, gif만 업로드가능합니다.');
        history.go(-1);
        </script>
        ");
        exit;
      }
      if(!move_uploaded_file($upfile_tmp_name, $uploaded_file)){// 이동할 파일 시작, 도착
        echo("
        <script>
        alert('디렉토리 복사에 실패했습니다. 다시 올려주십시오');
        history.go(-1);
        </script>
        ");
        exit;
      }
    }

      $position=$_POST['del_file'];//del_file는 배열

    $sql="select * from review where rv_no=$no";
    $result=mysqli_query($sql, $conn);
    $row=mysqli_fetch_array($result);

    
      $filed_org_name="rv_file_upload1";
      $filed_real_name="rv_file_copy1";

      $org_name_value=$upfile_name;
      $org_real_value=$copied_file_name;
      
      
      if($_POST['del_file']=="y"){
        $delete_name=$row["rv_file_copy1"];
        $delete_path=$upload_dir.$delete_name;

        unlink($delete_path);//삭제

        $sql="update review set ";
        $sql.="$filed_org_name='$org_name_value', $filed_real_name='$org_real_value'";
        $sql.=" where rv_no=$no";
        //echo $sql;
        $result = mysqli_query($conn,$sql);
      }else{//체크박스 선택 안한 항목에 대해서
        if(!$upfile_error){//오류가 없다면 파일 올리기
          $sql="update review set ";
          $sql.="$filed_org_name='$org_name_value', $filed_real_name='$org_real_value'";
          $sql.=" where  where rv_no=$no";
          //echo $sql;
          $result = mysqli_query($conn,$sql);
        }
      }
$sql = "";     
$sql .= "UPDATE review SET rv_title='".addslashes(htmlspecialchars($rv_title))."' , rv_content='".addslashes(htmlspecialchars($rv_content))."'";
if($upfile_name){
   $sql .= " ,rv_file_upload1='".$upfile_name."',rv_file_copy1='".$copied_file_name."'";   
}
$sql .= " WHERE rv_no='".$no."'";
$result = mysqli_query($conn,$sql);
//mysqli_query($sql, $connect);
mysqli_close($conn);?>
<script>
  location.href="review_view.php?no=<?=$no?>&page=<?= $page?>";
</script>
<?php
}
?>
