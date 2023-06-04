<?
include "../header.php";
include "../config.php";    //데이터베이스 연결 설정파일
include "../util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "등록";
$action = "member_insert.php";

if (array_key_exists("id", $_GET)) {
    $id = $_GET["id"];
    $query =  "select * from member where member_id = $id";
    $result = mysqli_query($conn, $query);
    $member = mysqli_fetch_array($result);
    if(!$member) {
        msg("존재하지 않는 회원입니다.");
    }
    $mode = "수정";
    $action = "member_modify.php"; // todo : member_modifiy.php 구현 -> 이미 학번이 존재하는 회원 금지하기.
}
?>

    <div class="container">
        <form name="member_form" action="<?=$action?>" method="post" class="fullwidth">
            <h3>회원 <?=$mode?></h3>
            <p>
                <label for="id">학번</label>
                <input type="number" placeholder="학번 입력" name="id" value="<?=$member['member_id']?>"/>
            </p>
            <p>
                <label for="role">직위</label>
                <select name="role" id="role">
                    <option value="-1" <?php if ($member['role'] == -1) echo "selected"; ?>>선택해 주십시오.</option>
                    <option value="회장" <?php if ($member['role'] == "회장") echo "selected"; ?>>회장</option>
                    <option value="임원" <?php if ($member['role'] == "임원") echo "selected"; ?>>임원</option>
                    <option value="정회원" <?php if ($member['role'] == "정회원") echo "selected"; ?>>정회원</option>
                    <option value="준회원" <?php if ($member['role'] == "준회원") echo "selected"; ?>>준회원</option>
                </select>
            </p>
            <p>
                <label for="name">이름</label>
                <input type="text" placeholder="이름 입력" id="name" name="name" value="<?=$member['name']?>"/>
            </p>
            <p>
                <label for="department">학과</label>
                <textarea placeholder="학과 입력" id="department" name="department"><?=$member['department']?></textarea>
            </p>
            <p>
                <label for="phone_number">전화 번호</label>
                <input type="text" placeholder="전화 번호 입력" id="phone_number" name="phone_number" value="<?=$member['phone_number']?>" />
            </p>
            <p>
                <label for="email">이메일</label>
                <input type="text" placeholder="이메일 입력" id="email" name="email" value="<?=$member['email']?>" />
            </p>
            <p>
                <label for="address">주소</label>
                <input type="text" placeholder="주소 입력" id="address" name="address" value="<?=$member['address']?>" />
            </p>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("role").value == "-1") {
                        alert ("직위를 선택해주십시오"); return false;
                    }
                    else if(document.getElementById("name").value == "") {
                        alert ("이름을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("department").value == "") {
                        alert ("학과를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("phone_number").value == "") {
                        alert ("전화번호를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("email").value == "") {
                        alert ("이메일 주소를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("address").value == "") {
                        alert ("주소를 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>