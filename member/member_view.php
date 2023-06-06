<?
include "../header.php";
include "../config.php";    //데이터베이스 연결 설정파일
include "../util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);


if (array_key_exists("id", $_GET)) {
    $id = $_GET["id"];
    $query =  "select * from member where member_id = $id";
    $study_query = "select title, semester, category, type from study, study_participation where study.study_id = study_participation.study_id and study_participation.member_id = $id";
    $result = mysqli_query($conn, $query);
    $study_query_result = mysqli_query($conn, $study_query);
    $member = mysqli_fetch_array($result);
    if(!$member) {
        msg("존재하지 않는 회원입니다.");
    }
}
?>
    <div class="container">
            <h3>회원 상세 정보
                <?
                echo "<span style='font-size: small;'><a href='member_form.php?id={$member['member_id']}'><button class='button primary small'>수정하기</button></a>
                <button onclick='javascript:deleteConfirm({$member['member_id']})' class='button danger small'>삭제하기</button></span>
                ";
                ?>

            </h3>
            <p>
                <label for="id">학번</label>
                <textarea readonly readonly name="id"><?=$member['member_id']?></textarea>
            </p>
            <p>
                <label for="role">직위</label>
                <textarea readonly id="role" name="role"><?=$member['role']?></textarea>
            </p>
            <p>
                <label for="name">이름</label>
                <textarea readonly id="name" name="name"><?=$member['name']?></textarea>
            </p>
            <p>
                <label for="department">학과</label>
                <textarea readonly id="department" name="department"><?=$member['department']?></textarea>
            </p>
            <p>
                <label for="phone_number">전화 번호</label>
                <textarea readonly id="phone_number" name="phone_number"><?=$member['phone_number']?></textarea>
            </p>
            <p>
                <label for="email">이메일</label>
                <textarea readonly id="email" name="email"><?=$member['email']?></textarea>
            </p>
            <p>
                <label for="address">주소</label>
                <textarea readonly id="address" name="address"><?=$member['address']?></textarea>
            </p>

            <script>
                function deleteConfirm(id) {
                    if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                        window.location = "member_delete.php?id=" + id;
                    }else{   //취소
                        return;
                    }
                }
            </script> 
    </div>

    <div class = 'container'> 
        <h4>참여 스터디 정보</h4> <br>
        <table class="table table-striped table-bordered">
            <colgroup>
                <col style="width: 10%">
                <col style="width: 15%">
                <col style="width: 15%">
                <col style="width: 10%">
            </colgroup> 
            <tr>
                <th>제목</th>
                <th>학기</th>
                <th>카테고리</th>
                <th>분류</th>
            </tr>
            <?
            $row_index = 1;
            while ($row = mysqli_fetch_array($study_query_result)) {
                echo "<tr>";
                echo "<td>{$row['title']}</td>";
                echo "<td>{$row['semester']}</td>";
                echo "<td>{$row['category']}</td>";
                echo "<td>{$row['type']}</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>

    <div class = 'container'> 
        <h4>참여 행사 정보</h4> <br>
        <table class="table table-striped table-bordered">
            <colgroup>
                <col style="width: 10%">
                <col style="width: 15%">
                <col style="width: 15%">
                <col style="width: 10%">
            </colgroup> 
            <tr>
                <th>행사명</th>
                <th>분류</th>
                <th>행사일자</th>
                <th>세부 사항</th>
            </tr>
            <?
            $query = "select * from event natural join event_participation where member_id = $id";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['type']}</td>";
                echo "<td>{$row['date']}</td>";
                echo "<td>{$row['details']}</td>";
                echo "</tr>";
            }
            ?>
        </table>    
    </div>
    <div class='container'>
        <h4>대출 중인 도서 목록</h4> <br>

        <table class="table table-striped table-bordered">
            <colgroup>
                <col style="width: 10%">
                <col style="width: 15%">
                <col style="width: 15%">
                <col style="width: 10%">
                <col style="width: 15%">
                <col style="width: 15%">
            </colgroup> 
            <tr>
                <th>도서명</th>
                <th>저자</th>
                <th>ISBN</th>
                <th>대출 횟수</th>
                <th>출판사</th>
                <th>판수</th>
            </tr>
            <?
            $query = "select * from book natural join borrowing where member_id = $id";
            $result = mysqli_query($conn, $query);
            
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>{$row['title']}</td>";
                echo "<td>{$row['author']}</td>";
                echo "<td>{$row['ISBN']}</td>";
                echo "<td>{$row['number_of_borrows']}</td>";
                echo "<td>{$row['publisher']}</td>";
                echo "<td>{$row['edition']}</td>";
                echo "</tr>";
            }
            ?>
        </table>        
    </div>
<!-- todo : 대출 도서, 참여 행사 정보  -->
<? include("footer.php") ?>