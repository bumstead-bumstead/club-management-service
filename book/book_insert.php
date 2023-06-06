<?
include "../config.php";
include "../util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$title = $_POST['title'];
$author = $_POST['author'];
$ISBN = $_POST['ISBN'];
$publisher = $_POST['publisher'];
$edition = $_POST['edition'];
$query = "insert into book (title, author, ISBN, publisher, edition) values ('$title', '$author', '$ISBN', '$publisher', '$edition')";
$result = mysqli_query($conn, $query);

if(!$result)
{
    msg('도서 등록에 실패했습니다. : '.mysqli_error($conn));
}
else
{
    $inserted_row_id = mysqli_insert_id($conn);
    echo "
    <script>
        window.alert('성공적으로 추가되었습니다. 도서 번호 : $inserted_row_id, 이름 : $title');
    </script>";
    echo "<script>location.replace('book_list.php');</script>";
}
?>