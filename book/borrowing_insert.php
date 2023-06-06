<?
include "../config.php";
include "../util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$member_id = $_POST['member_id'];
$book_id = $_GET['book_id'];
$date = date("Y-m-d");

//회원의 대출 가능 여부 확인
$count_result = mysqli_query($conn, "select count(*) from borrowing where member_id = $member_id");
$number_of_books = mysqli_fetch_array($count_result);
if ($number_of_books['count(*)'] >= 2) {
    msg("더 이상 대출할 수 없습니다.");
}

$insert_query = "insert into borrowing (book_id, member_id, date) values ('$book_id', '$member_id', '$date')";
$update_query = "update book set number_of_borrows = number_of_borrows + 1 where book_id = $book_id";
$insert_result = mysqli_query($conn, $insert_query);
if(!$insert_result)
{
    msg('도서 대출 처리에 실패했습니다. : '.mysqli_error($conn));
}
else {
    $update_result = mysqli_query($conn, $update_query);
    if(!$update_result)
    {
        msg('도서 대출 처리에 실패했습니다. : '.mysqli_error($conn));
    }
    else
    {
        echo "
        <script>
            window.alert('성공적으로 대출되었습니다. 학번 : $member_id, 도서 번호 : $book_id');
        </script>";
        echo "<script>location.replace('book_view.php?book_id=$book_id');</script>";
    }
}
?>