<?
include "../header.php";
include "../config.php";
include "../util.php";
?>

<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from study";
    $result = mysqli_query($conn, $query);
    ?>
    <h3>스터디/세션 목록</h3>

    <table class="table table-striped table-bordered">
        <colgroup>
            <col style="width: 10%">
            <col style="width: 15%">
            <col style="width: 15%">
            <col style="width: 10%">
            <col style="width: 15%">
        </colgroup> 
        <tr>
            <th>제목</th>
            <th>학기</th>
            <th>카테고리</th>
            <th>분류</th>
        </tr>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>{$row['title']}</td>";
            echo "<td>{$row['semester']}</td>";
            echo "<td>{$row['category']}</td>";
            echo "<td>{$row['type']}</td>";
            echo "<td width='17%'> 
                <a href='study_view.php?id={$row['study_id']}'><button class='button primary small'>상세 정보</button></a>
                </td>"; 
            echo "</tr>";
        }
        ?>
    </table>
    <center><a href='study_form.php'><button class='button primary small'>스터디 개설</button></a> </center>
</div>
<? include("footer.php") ?>
