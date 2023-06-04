<?
include "../config.php";    //데이터베이스 연결 설정파일
include "../util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$id = $_GET['id'];
$ret = mysqli_query($conn, "delete from study where study_id = $id");

	if(!$ret)
	{
	    msg('스터디 삭제에 실패했습니다. : '.mysqli_error($conn));
	}
	else
	{
	    s_msg ('성공적으로 삭제 되었습니다');
	    echo "<meta http-equiv='refresh' content='0;url=study_list.php'>";
	}	

?>

