<?
include "../config.php";
include "../util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$title = $_POST['title'];
$type = $_POST['type'];
$semester = $_POST['semester'];
$details = $_POST['details'];
$member_id = $_POST['member_id'];
$category = $_POST['category'];
$query = "insert into study (title, type, semester, details, member_id, category) values ('$title', '$type', '$semester', '$details', '$member_id', '$category')";
$result = mysqli_query($conn, $query);

if(!$result)
{
    msg('스터디 등록에 실패했습니다. : '.mysqli_error($conn));
}
else
{
    $inserted_row_id = mysqli_insert_id($conn);
    $result = mysqli_query($conn, "select study_id, title from study where study_id = $inserted_row_id");
    $row = mysqli_fetch_array($result);
    echo "
    <script>
        window.alert('성공적으로 개설되었습니다. 스터디 번호 : {$row['study_id']}, 이름 : {$row['title']}');
    </script>";
    echo "<script>location.replace('study_list.php');</script>";
}
?>