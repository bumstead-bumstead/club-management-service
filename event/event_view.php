
<?
include "../header.php";
include "../config.php";
include "../util.php";

$conn = dbconnect($host, $dbid, $dbpass, $dbname);


if (array_key_exists("event_id", $_GET)) {
    $id = $_GET["event_id"];
    $query =  "select * from event where event_id = $id";
    $result = mysqli_query($conn, $query);
    $event = mysqli_fetch_array($result);
    if(!$event) {
        msg("존재하지 않는 행사입니다.");
    }
    $member_query = "select member_id, name from event_participation natural join member where event_id = $id";
    $members = mysqli_query($conn, $member_query);
}

?>
    <div class="container">
            <h3>행사 상세 정보
                <?
                echo "<span style='font-size: small;'><a href='event_form.php?event_id={$event['event_id']}'><button class='button primary small'>수정</button></a></span>
                <span style='font-size: small;'><button onclick='javascript:deleteConfirm({$event['event_id']})' class='button danger small'>삭제</button></span>
                ";
                ?>
            </h3>
            <p>
                <label for="name">행사명</label>
                <textarea readonly readonly name="name"><?=$event['name']?></textarea>
            </p>
            <p>
                <label for="type">분류</label>
                <textarea readonly id="type" name="type"><?=$event['type']?></textarea>
            </p>
            <p>
                <label for="date">행사일자</label>
                <textarea readonly id="date" name="date"><?=$event['date']?></textarea>
            </p>
            <p>
                <label for="details">행사 설명</label>
                <textarea readonly id="details" name="details"><?=$event['details']?></textarea>
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
                echo "window.location = 'event_participation_delete.php?member_id=' + member_id + '&event_id=$id';"
                ?>
            }else{
                return;
            }
        }
        </script>

        <? echo "<form name='event_participation_insert' action='event_participation_insert.php?event_id=$id' method='post' class='fullwidth'>"?>
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

        <script>
            function deleteConfirm(id) {
                if (confirm("정말 삭제하시겠습니까?") == true){
                    window.location = "event_delete.php?event_id=" + id;
                }else{
                    return;
                }
            }
        </script> 
    </div>
<? include("footer.php") ?>