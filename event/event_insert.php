<?
include "../config.php";
include "../util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$name = $_POST['name'];
$type = $_POST['type'];
$details = $_POST['details'];
$date = $_POST['date'];
$query = "insert into event (name, type, details, date) values ('$name', '$type', '$details', '$date')";
$result = mysqli_query($conn, $query);

if(!$result)
{
    msg('행사 등록에 실패했습니다. : '.mysqli_error($conn));
}
else
{
    $inserted_row_id = mysqli_insert_id($conn);
    $result = mysqli_query($conn, "select event_id, name from event where event_id = $inserted_row_id");
    $row = mysqli_fetch_array($result);
    echo "
    <script>
        window.alert('성공적으로 개설되었습니다. 행사 번호 : {$row['event_id']}, 이름 : {$row['name']}');
    </script>";
    echo "<script>location.replace('event_list.php');</script>";
}
?>