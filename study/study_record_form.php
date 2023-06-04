<?
include "../header.php";
include "../config.php";
include "../util.php";

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "생성";
$study_id = $_GET["study_id"];
$action = "study_record_insert.php?study_id=$study_id";

if (array_key_exists("record_id", $_GET)) {
    $record_id = $_GET["record_id"];
    $query =  "select * from study_record where record_id = $record_id";
    $result = mysqli_query($conn, $query);
    $study_record = mysqli_fetch_array($result);
    if(!$study_record) {
        msg("존재하지 않는 기록입니다.");
    }
    $mode = "수정";
    $action = "study_record_modify.php?record_id=$record_id&study_id=$study_id"; 
}
?>

    <div class="container">
        <form name="study_form" action="<?=$action?>" method="post" class="fullwidth">
            <h3>스터디 기록 <?=$mode?></h3>
            <p>
                <label for="title">제목</label>
                <input type="text" placeholder="스터디 활동 기록 제목 입력" id = "title" name="title" value="<?=$study_record['title']?>"/>
            </p>
            <p>
                <label for="content">활동 세부 내용</label>
                <textarea type="text" placeholder="활동 세부 내용 입력" id = "content" name="content"><?=$study_record['content']?></textarea>
            </p>
            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("title").value == "") {
                        alert ("제목을 입력해주십시오"); return false;
                    }
                    else if(document.getElementById("content").value == "") {
                        alert ("분류를 선택해주십시오"); return false;
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>