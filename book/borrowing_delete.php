<?
include "../config.php";
include "../util.php";
$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$book_id = $_GET['book_id'];
$ret = mysqli_query($conn, "delete from borrowing where book_id = $book_id");

	if(!$ret)
	{
	    msg('도서 반납에 실패했습니다. : '.mysqli_error($conn));
	}
	else
	{
	    s_msg ('성공적으로 반납되었습니다. 도서 번호 : '.$book_id);
        echo "<script>location.replace('book_view.php?book_id=$book_id');</script>";
	}
?>

