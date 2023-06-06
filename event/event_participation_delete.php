<?
include "../config.php";
include "../util.php";
$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$id = $_GET['member_id'];
$event_id = $_GET['event_id'];
$ret = mysqli_query($conn, "delete from event_participation where member_id = $id and event_id = $event_id");

	if(!$ret)
	{
	    msg('참여 인원 삭제에 실패했습니다. : '.mysqli_error($conn));
	}
	else
	{
	    s_msg ('성공적으로 삭제 되었습니다. 회원 번호 : '.$id);
        echo "<script>location.replace('event_view.php?event_id=$event_id');</script>";
	}
?>

