<?php
include ("../lib/include.php");
if(!isset($_SESSION["u_id"])){
?>
      <script>
            alert('로그인을 먼저해주세요.');
            location.href = '../login/login.php';
      </script>
   <?php
}else{
?>

<?php
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
if($upfile_size>2000000){
        echo("
        <script>
        alert('파일 용량이 큽니다 2M이하의 파일만 가능합니다.');
        history.go(-1);
        </script>
        ");
        exit;
      }
      if(($upfile_type!="image/gif") && ($upfile_type!="image/jpeg") && ($upfile_type!="image/jpg") && ($upfile_type!="image/png")){
        echo("
        <script>
        alert('jpg, jpeg, png, gif파일만 업로드가능합니다.');
        history.go(-1);
        </script>
        ");
        exit;
      }
      if(!move_uploaded_file($upfile_tmp_name, $uploaded_file)){// 이동할 파일 시작, 도착
        echo("
        <script>
        alert('디렉토리 복사에 실패했습니다. 다시 올려주십시');
        </script>
        ");
        exit;
      }
    }
        $sql="insert into news set n_title = '".addslashes(htmlspecialchars($_POST['n_title']))."', n_content = '".addslashes(htmlspecialchars($_POST['n_content']))."', n_date = now(),n_file_upload1='".$upfile_name."',n_file_copy1='".$copied_file_name."'";

$result = mysqli_query($conn,$sql);
$insertno = mysqli_insert_id($conn);
?>
<script>
alert('글이 저장 되었습니다.');
location.replace('news_view.php?no=<?=$insertno?>');
</script>
<?php } ?>

