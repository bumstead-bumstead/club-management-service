<?
include "../config.php";
include "../util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);


$id = $_GET["id"];
$title = $_POST['title'];
$type = $_POST['type'];
$semester = $_POST['semester'];
$details = $_POST['details'];
$member_id = $_POST['member_id'];
$category = $_POST['category'];
$query = "update study set title = '$title', type = '$type', semester = '$semester', details = '$details', member_id = '$member_id', category = '$category' where study_id = '$id'";
$result = mysqli_query($conn, $query);

if(!$result)
{
    msg('스터디 수정에 실패했습니다. : '.mysqli_error($conn));
}
else
{
    $result = mysqli_query($conn, "select study_id, title from study where study_id = $id");
    $row = mysqli_fetch_array($result);
    echo "
    <script>
        window.alert('성공적으로 수정되었습니다. 스터디 번호 : {$row['study_id']}, 제목 : {$row['title']}');
    </script>";
    echo "<script>location.replace('study_list.php');</script>";
}

?>