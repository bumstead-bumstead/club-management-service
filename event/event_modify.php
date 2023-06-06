<?
include "../config.php";
include "../util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$event_id = $_GET['event_id'];
$name = $_POST['name'];
$type = $_POST['type'];
$details = $_POST['details'];
$date = $_POST['date'];
$query = "update event set name = '$name', type = '$type', details = '$details', date = '$date'where event_id = '$event_id'" ;
$result = mysqli_query($conn, $query);

if(!$result)
{
    msg('행사 수정에 실패했습니다. : '.mysqli_error($conn));
}
else
{
    echo "
    <script>
        window.alert('성공적으로 수정되었습니다. 행사 번호 : $event_id, 이름 : $name');
    </script>";
    echo "<script>location.replace('event_list.php');</script>";
}
?>