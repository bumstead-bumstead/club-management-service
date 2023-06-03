<?
include "../config.php";
include "../util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);
// todo : 공백입력 시 에러 띄우기
$id = $_POST['id'];
$name = $_POST['name'];
$department = $_POST['department'];
$role = $_POST['role'];
$phone_number = $_POST['phone_number'];
$email = $_POST['email'];
$address = $_POST['address'];
$query = "insert into member (id, name, department, role, phone_number, email, address) values ('$id', '$name', '$department', '$role', '$phone_number', '$email', '$address')";
$result = mysqli_query($conn, $query);

if(!$result)
{
    msg('회원 등록에 실패했습니다. : '.mysqli_error($conn));
}
else
{
    $result = mysqli_query($conn, "select id, name from member where id = $id");
    $row = mysqli_fetch_array($result);
    echo "
    <script>
        window.alert('성공적으로 입력 되었습니다. 학번 : {$row['id']}, 이름 : {$row['name']}');
    </script>";
    echo "<script>location.replace('member_list.php');</script>";
}

?>