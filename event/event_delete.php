<?
include "../config.php";
include "../util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$event_id = $_GET['event_id'];
$ret = mysqli_query($conn, "delete from event where event_id = $event_id");

	if(!$ret)
	{
	    msg('행사 삭제에 실패했습니다. : '.mysqli_error($conn));
	}
	else
	{
	    s_msg ('성공적으로 삭제 되었습니다');
	    echo "<meta http-equiv='refresh' content='0;url=event_list.php'>";
	}	

?>

