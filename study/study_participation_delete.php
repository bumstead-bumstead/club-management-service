<?
include "../config.php";    //데이터베이스 연결 설정파일
include "../util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$id = $_GET['member_id'];
$study_id = $_GET['study_id'];
$ret = mysqli_query($conn, "delete from study_participation where member_id = $id and study_id = $study_id");

	if(!$ret)
	{
	    msg('참여 인원 삭제에 실패했습니다. : '.mysqli_error($conn));
	}
	else
	{
	    s_msg ('성공적으로 삭제 되었습니다');
        echo "<script>location.replace('study_view.php?id=$study_id');</script>";
	}
?>

