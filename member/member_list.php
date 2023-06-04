<?
include "../header.php";
include "../config.php";
include "../util.php";
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from member";
    $result = mysqli_query($conn, $query);
    ?>
    <h3>회원 목록</h3>

    <table class="table table-striped table-bordered">
        <colgroup>
            <col style="width: 10%">
            <col style="width: 15%">
            <col style="width: 15%">
            <col style="width: 10%">
            <col style="width: 15%">
            <col style="width: 15%">
            <col style="width: 20%">
        </colgroup> 
        <tr>
            <th>학번</th>
            <th>이름</th>
            <th>학과</th>
            <th>직위</th>
            <th>전화번호</th>
            <th>이메일</th>
            <th>주소</th>

        </tr>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>{$row['member_id']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['department']}</td>";
            echo "<td>{$row['role']}</td>";
            echo "<td>{$row['phone_number']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "<td>{$row['address']}</td>";
            //echo "<td><a href='product_view.php?product_id={$row['product_id']}'>{$row['product_name']}</a></td>";
            echo "<td width='17%'> 
                <a href='member_view.php?id={$row['member_id']}'><button class='button primary small'>상세 정보</button></a>
                </td>"; // todo : member_form.php 작성. 삭제 및 수정은 memeber.form.php에서 구현하기
            echo "</tr>";
        }
        ?>
    </table>
    <center><a  href='member_form.php'><button class='button primary small'>회원 생성</button></a> </center>
</div>
<? include("footer.php") ?>
