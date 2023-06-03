<?
include "../header.php";
include "../config.php";    //데이터베이스 연결 설정파일
include "../util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);


if (array_key_exists("id", $_GET)) {
    $id = $_GET["id"];
    $query =  "select * from member where id = $id";
    $result = mysqli_query($conn, $query);
    $member = mysqli_fetch_array($result);
    if(!$member) {
        msg("존재하지 않는 회원입니다.");
    }
}
?>
    <div class="container">
            <h3>회원 상세 정보</h3>
            <p>
                <label for="id">학번</label>
                <textarea readonly readonly name="id"><?=$member['id']?></textarea>
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
            <?
            echo "<center><a href='member_form.php?id={$member['id']}'><button class='button primary small'>수정하기</button></a>
            <button onclick='javascript:deleteConfirm({$member['id']})' class='button danger small'>삭제하기</button></center>
            ";
            ?>
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
<? include("footer.php") ?>