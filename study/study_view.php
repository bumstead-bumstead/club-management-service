<!-- todo : 
1. 스터디 세부사항 확인 (study_record, 참가자 포함) 
4. 스터디 활동 기록 등록/삭제/조회/수정 기능
5. 스터디 참가자 추가/삭제 기능
-->

<?
include "../header.php";
include "../config.php";
include "../util.php";

$conn = dbconnect($host, $dbid, $dbpass, $dbname);


if (array_key_exists("id", $_GET)) {
    $id = $_GET["id"];
    $query =  "select * from study where study_id = $id";
    $result = mysqli_query($conn, $query);
    $study = mysqli_fetch_array($result);
    if(!$study) {
        msg("존재하지 않는 스터디입니다.");
    }
    $member_query = "select member_id, name from study_participation natural join member where study_id = $id";
    $record_query = "select record_id, title, content, date from study_record where study_id = $id";
    $members = mysqli_query($conn, $member_query);
    $records = mysqli_query($conn, $record_query);
}

?>
    <div class="container">
            <h3>스터디 상세 정보
                <?
                echo "<span style='font-size: small;'><a href='study_form.php?id={$study['study_id']}'><button class='button primary small'>정보 수정하기</button></a></span>
                <span style='font-size: small;'><button onclick='javascript:deleteConfirm({$study['study_id']})' class='button danger small'>삭제하기</button></span>
                ";
                ?>
            </h3>
            <p>
                <label for="title">제목</label>
                <textarea readonly readonly name="title"><?=$study['title']?></textarea>
            </p>
            <p>
                <label for="semester">학기</label>
                <textarea readonly id="semester" name="semester"><?=$study['semester']?></textarea>
            </p>
            <p>
                <label for="category">카테고리</label>
                <textarea readonly id="category" name="category"><?=$study['category']?></textarea>
            </p>
            <p>
                <label for="type">분류</label>
                <textarea readonly id="type" name="type"><?=$study['type']?></textarea>
            </p>
            <p>
                <label for="details">스터디 설명</label>
                <textarea readonly id="details" name="details"><?=$study['details']?></textarea>
            </p>

    </div>
    <div class="container"  style="max-width: 400px;">
        <h4>참여 인원</h4> <br>
        <table class="table table-striped table-bordered">
            <colgroup>
                <col style="width: 15%">
                <col style="width: 10%">
                <col style="width: 3%">

            </colgroup> 
            <tr>
                <th>학번</th>
                <th>이름</th>
            </tr>
            <?
            while ($row = mysqli_fetch_array($members)) {
                echo "<tr>";
                echo "<td>{$row['member_id']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td><button onclick='javascript:participationDeleteConfirm({$row['member_id']})' class='button danger small'>삭제</button></td>";
                echo "</tr>";
            }
            ?>
        </table>

        <script>
        function participationDeleteConfirm(member_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                <?
                echo "window.location = 'study_participation_delete.php?member_id=' + member_id + '&study_id=$id';"
                ?>
                //window.location = "study_participation_delete.php?member_id=" + member_id + "&study_id=" + ;
            }else{   //취소
                return;
            }
        }
        </script>

        <? echo "<form name='study_participation_insert' action='study_participation_insert.php?study_id=$id' method='post' class='fullwidth'>"?>
            <p>
                <label for="member_id">학번</label>
                <input type="number" placeholder="학번 입력" name="member_id" id="member_id"/>
            </p>
            <p align="center"><button class="button primary small" onclick="javascript:return validate();">참여 인원 추가</button></p>
            <script>
                function validate() {
                    if(document.getElementById("member_id").value == "") {
                        alert ("학번을 입력해주십시오"); return false;
                    }
                    return true;
                }
            </script>
        </form>
        </div>
        
        <div class = "container">
        <h4>스터디 활동 기록
            <?
            echo "<span style='font-size: small;'><a href='study_record_form.php?study_id=$id'><button class='button primary small'>기록 생성</button></a></span>"
            ?>
		</h4>
		<br>
        <table class="table table-striped table-bordered">
            <colgroup>
                <col style="width: 3%">
                <col style="width: 5%">
                <col style="width: 15%">
                <col style="width: 5%">
                <col style="width: 1%">
            </colgroup> 
            <tr>
                <th>번호</th>
                <th>제목</th>
                <th>내용</th>
                <th>날짜</th>
            </tr>
            <?
            $row_index = 1;
            while ($row = mysqli_fetch_array($records)) {

                echo "<tr>";
                echo "<td>{$row_index}</td>";
                echo "<td>{$row['title']}</td>";
                echo "<td>{$row['content']}</td>";
                echo "<td>{$row['date']}</td>";
                echo "<td>
                <a href='study_record_form.php?record_id={$row['record_id']}&study_id=$id'><button class='button primary small'>수정</button></a>
                <button onclick='javascript:recordDeleteConfirm({$row['record_id']}, $id)' class='button danger small'>삭제</button>
                </td>";
                echo "</tr>";
                $row_index += 1;
            }
            ?>

            <script>
                function recordDeleteConfirm(record_id, study_id) {
                    if (confirm("정말 삭제하시겠습니까?") == true){
                        window.location = "study_record_delete.php?study_id=" + study_id + "&record_id=" + record_id;
                    }else{
                        return;
                    }
                }
            </script>  
        </table>

        <?
        echo "<center><a href='study_form.php?id={$study['study_id']}'><button class='button primary small'>수정하기</button></a>
        <button onclick='javascript:deleteConfirm({$study['study_id']})' class='button danger small'>삭제하기</button></center>
        ";
        ?>
        <script>
            function deleteConfirm(id) {
                if (confirm("정말 삭제하시겠습니까?") == true){
                    window.location = "study_delete.php?id=" + id;
                }else{
                    return;
                }
            }
        </script> 
    </div>
<? include("footer.php") ?>