<?
include "../config.php";
include "../util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$member_id = $_POST['member_id'];
$study_id = $_GET['study_id'];
$query = "insert into study_participation (study_id, member_id) values ('$study_id', '$member_id')";
$result = mysqli_query($conn, $query);

if(!$result)
{
    msg('회원 추가에 실패했습니다. : '.mysqli_error($conn));

}
else
{
    echo "
    <script>
        window.alert('성공적으로 추가되었습니다. 학번 : $member_id');
    </script>";
    echo "<script>location.replace('study_view.php?id=$study_id');</script>";
}
?>