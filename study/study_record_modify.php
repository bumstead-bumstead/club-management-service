<?
include "../config.php";
include "../util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$title = $_POST['title'];
$content = $_POST['content'];
$record_id = $_GET['record_id'];
$study_id = $_GET['study_id'];
$date = date("Y-m-d");
$query = "update study_record set title = '$title', content = '$content' where record_id = '$record_id'";
$result = mysqli_query($conn, $query);

if(!$result)
{
    msg('기록 수정에 실패했습니다. : '.mysqli_error($conn));
}
else
{
    echo "
    <script>
        window.alert('성공적으로 수정되었습니다. 기록 번호 : $record_id');
    </script>";
    echo "<script>location.replace('study_view.php?id=$study_id');</script>";
}
?>