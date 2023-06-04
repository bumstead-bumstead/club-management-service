<?
include "../header.php";
include "../config.php";    //데이터베이스 연결 설정파일
include "../util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "개설";
$action = "study_insert.php";

if (array_key_exists("id", $_GET)) {
    $id = $_GET["id"];
    $query =  "select * from study where study_id = $id";
    $result = mysqli_query($conn, $query);
    $study = mysqli_fetch_array($result);
    if(!$study) {
        msg("존재하지 않는 스터디입니다.");
    }
    $mode = "수정";
    $action = "study_modify.php?id=$id"; 
}
?>

    <div class="container">
        <form name="study_form" action="<?=$action?>" method="post" class="fullwidth">
            <h3>스터디 <?=$mode?></h3>
            <p>
                <label for="title">제목</label>
                <input type="text" placeholder="스터디 제목 입력" id = "title" name="title" value="<?=$study['title']?>"/>
            </p>
            <p>
                <label for="type">분류</label>
                <select name="type" id="type">
                    <option value="-1" <?php if ($study['type'] == -1) echo "selected"; ?>>선택해 주십시오.</option>
                    <option value="스터디" <?php if ($study['type'] == "스터디") echo "selected"; ?>>스터디</option>
                    <option value="세션" <?php if ($study['type'] == "세션") echo "selected"; ?>>세션</option>
                </select>
            </p>
            <p>
                <label for="category">스터디/세션 카테고리</label>
                <input type="text" placeholder="카테고리 입력" id = "category" name="category" value="<?=$study['category']?>"/>
            </p>
            <p>
                <label for="semester">학기</label>
                <input type="text" placeholder="개설 학기 입력" id = "semester" name="semester" value="<?=$study['semester']?>"/>
            </p>
            <p>
                <label for="details">스터디 설명</label>
                <textarea type="text" placeholder="스터디 설명 입력" id = "details" name="details"><?=$study['details']?></textarea>
            </p>
            <p>
                <label for="member_id">스터디장 학번</label>
                <input type="text" placeholder="스터디장 학번 입력" id="member_id" name="member_id" value="<?=$study['member_id']?>"/>
            </p>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("title").value == "") {
                        alert ("제목을 입력해주십시오"); return false;
                    }
                    else if(document.getElementById("type").value == "-1") {
                        alert ("분류를 선택해주십시오"); return false;
                    }
                    else if(document.getElementById("category").value == "") {
                        alert ("카테고리를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("semester").value == "") {
                        alert ("개설 학기를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("details").value == "") {
                        alert ("스터디 설명을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("member_id").value == "") {
                        alert ("스터디장 학번을 입력해 주십시오"); return false;
                    }

                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>