<?
include "../header.php";
include "../config.php";
include "../util.php";
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from book where book_id not in (select book_id from borrowing)";
    $result = mysqli_query($conn, $query);
    ?>
    <h3>대출 가능 도서 목록</h3>

    <table class="table table-striped table-bordered">
        <colgroup>
            <col style="width: 10%">
            <col style="width: 15%">
            <col style="width: 15%">
            <col style="width: 10%">
            <col style="width: 15%">
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
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>{$row['title']}</td>";
            echo "<td>{$row['author']}</td>";
            echo "<td>{$row['ISBN']}</td>";
            echo "<td>{$row['number_of_borrows']}</td>";
            echo "<td>{$row['publisher']}</td>";
            echo "<td>{$row['edition']}</td>";
            echo "<td width='17%'> 
                <a href='book_view.php?book_id={$row['book_id']}'><button class='button primary small'>상세 정보</button></a>
                </td>"; 
            echo "</tr>";
        }
        ?>
    </table>
</div>
<div class="container">
    <?
    $query = "select * from book where book_id in (select book_id from borrowing)";
    $result = mysqli_query($conn, $query);
    ?>
    <h3>대출 중인 도서 목록</h3>

    <table class="table table-striped table-bordered">
        <colgroup>
            <col style="width: 10%">
            <col style="width: 15%">
            <col style="width: 15%">
            <col style="width: 10%">
            <col style="width: 15%">
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
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>{$row['title']}</td>";
            echo "<td>{$row['author']}</td>";
            echo "<td>{$row['ISBN']}</td>";
            echo "<td>{$row['number_of_borrows']}</td>";
            echo "<td>{$row['publisher']}</td>";
            echo "<td>{$row['edition']}</td>";
            echo "<td width='17%'> 
                <a href='book_view.php?book_id={$row['book_id']}'><button class='button primary small'>상세 정보</button></a>
                </td>"; 
            echo "</tr>";
        }
        ?>
    </table>
    <center><a href='book_form.php'><button class='button primary small'>도서 추가</button></a> </center>
</div>
<? include("footer.php") ?>
