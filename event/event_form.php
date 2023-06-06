<?
include "../header.php";
include "../config.php";
include "../util.php";

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "개설";
$action = "event_insert.php";

if (array_key_exists("event_id", $_GET)) {
    $id = $_GET["event_id"];
    $query =  "select * from event where event_id = $id";
    $result = mysqli_query($conn, $query);
    $event = mysqli_fetch_array($result);
    if(!$event) {
        msg("존재하지 않는 행사입니다.");
    }
    $mode = "수정";
    $action = "event_modify.php?event_id=$id"; 
}
?>

    <div class="container">
        <form name="event_form" action="<?=$action?>" method="post" class="fullwidth">
            <h3>행사 <?=$mode?></h3>
            <p>
                <label for="name">행사명</label>
                <input type="text" placeholder="행사명 입력" id = "name" name="name" value="<?=$event['name']?>"/>
            </p>
            <p>
                <label for="type">분류</label>
                <select name="type" id="type">
                    <option value="-1" <?php if ($event['type'] == -1) echo "selected"; ?>>선택해 주십시오.</option>
                    <option value="세미나" <?php if ($event['type'] == "세미나") echo "selected"; ?>>세미나</option>
                    <option value="회원 교류" <?php if ($event['type'] == "회원 교류") echo "selected"; ?>>회원 교류</option>
                    <option value="대회" <?php if ($event['type'] == "대회") echo "selected"; ?>>대회</option>
                </select>
            </p>
            <p>
                <label for="date">행사 일자  </label>
                <input type="date" placeholder="행사 일자 입력" id = "date" name="date" value="<?=$event['date']?>"/>
            </p>
            <p>
                <label for="details">행사 설명</label>
                <textarea type="text" placeholder="행사 설명 설명 입력" id = "details" name="details"><?=$event['details']?></textarea>
            </p>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("name").value == "") {
                        alert ("제목을 입력해주십시오"); return false;
                    }
                    else if(document.getElementById("type").value == "-1") {
                        alert ("분류를 선택해주십시오"); return false;
                    }
                    else if(!isValidDate(document.getElementById("date").value)) {
                        alert ("날짜를 입력해 주십시오"); return false;
                    }

                    else if(document.getElementById("details").value == "") {
                        alert ("스터디 설명을 입력해 주십시오"); return false;
                    }
                    return true;
                }
                function isValidDate(dateString) {
                    var dateRegex = /^\d{4}-\d{2}-\d{2}$/;
                    if (!dateRegex.test(dateString)) return false;

                    var date = new Date(dateString);
                    var isValid = !isNaN(date.getTime());
                    return isValid;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>