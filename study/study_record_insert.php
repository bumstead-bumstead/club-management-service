<?
include "../config.php";
include "../util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$title = $_POST['title'];
$content = $_POST['content'];
$study_id = $_GET['study_id'];
$date = date("Y-m-d");
$query = "insert into study_record (title, content, date, study_id) values ('$title', '$content', '$date', '$study_id')";
$result = mysqli_query($conn, $query);

if(!$result)
{
    $error_message = $mysqli_error($conn);
    echo "
    <script>
         window.alert('기록 생성에 실패했습니다. : $error_message');
         history.go(-1);
    </script>";
}
else
{
    $inserted_row_id = mysqli_insert_id($conn);
    echo "
    <script>
        window.alert('성공적으로 추가되었습니다.');
    </script>";
    echo "<script>location.replace('study_view.php?id=$study_id');</script>";
}
?>