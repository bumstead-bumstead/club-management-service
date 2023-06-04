<?
include "../config.php";
include "../util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);
$id = $_POST['id'];
$name = $_POST['name'];
$department = $_POST['department'];
$role = $_POST['role'];
$phone_number = $_POST['phone_number'];
$email = $_POST['email'];
$address = $_POST['address'];
$query = "update member set name = '$name', department = '$department', role = '$role', phone_number = '$phone_number', email = '$email', address = '$address' where member_id = '$id'";
$result = mysqli_query($conn, $query);

if(!$result)
{
    msg('회원 수정에 실패했습니다. : '.mysqli_error($conn));
}
else
{
    $result = mysqli_query($conn, "select member_id, name from member where member_id = $id");
    $row = mysqli_fetch_array($result);
    echo "
    <script>
        window.alert('성공적으로 수정 되었습니다. 학번 : {$row['id']}, 이름 : {$row['name']}');
    </script>";
    echo "<script>location.replace('member_list.php');</script>";
}

?>