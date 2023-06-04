<?
include "../config.php";
include "../util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$record_id = $_GET['record_id'];
$study_id = $_GET['study_id'];
$query = "delete from study_record where record_id = $record_id";
$result = mysqli_query($conn, $query);

if(!$result)
{
    $error_message = $mysqli_error($conn);
    echo "
    <script>
         window.alert('기록 삭제에 실패했습니다. : $error_message');
         history.go(-1);
    </script>";
}
else
{
    echo "
    <script>
        window.alert('성공적으로 삭제되었습니다.');
    </script>";
    echo "<script>location.replace('study_view.php?id=$study_id');</script>";
}
?>