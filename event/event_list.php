<?
include "../header.php";
include "../config.php";
include "../util.php";
?>

<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from event";
    if (array_key_exists("search_keyword", $_POST)) {
        $search_keyword = $_POST["search_keyword"];
        $query .= " where name like '%$search_keyword%'";
    }
    $result = mysqli_query($conn, $query);
    ?>
    <h3>행사 목록
        <form action="event_list.php" method="post">
            <input type="text" name="search_keyword" placeholder="행사 검색">
        </form>

    </h3>

    <table class="table table-striped table-bordered">
        <colgroup>
            <col style="width: 10%">
            <col style="width: 15%">
            <col style="width: 15%">
            <col style="width: 10%">
            <col style="width: 15%">
        </colgroup> 
        <tr>
            <th>행사명</th>
            <th>분류</th>
            <th>행사일자</th>
            <th>세부 사항</th>
        </tr>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['type']}</td>";
            echo "<td>{$row['date']}</td>";
            echo "<td>{$row['details']}</td>";
            echo "<td width='17%'> 
                <a href='event_view.php?event_id={$row['event_id']}'><button class='button primary small'>상세 정보</button></a>
                </td>"; 
            echo "</tr>";
        }
        ?>
    </table>
    <center><a href='event_form.php'><button class='button primary small'>행사 개설</button></a> </center>
</div>
<? include("footer.php") ?>
