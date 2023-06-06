
<?

// todo : 도서 정보(반납일자 포함), 삭제, 대출 (or 반납)

include "../header.php";
include "../config.php";
include "../util.php";

$conn = dbconnect($host, $dbid, $dbpass, $dbname);


if (array_key_exists("book_id", $_GET)) {
    $id = $_GET["book_id"];
    $query =  "select * from book where book_id = $id";
    $result = mysqli_query($conn, $query);
    $book = mysqli_fetch_array($result);

    if(!$book) {
        msg("존재하지 않는 도서입니다.");
    }
    $member_query = "select member_id, name, date from borrowing natural join member where book_id = $id";
    $borrow = mysqli_query($conn, $member_query);
    $borrow_information = mysqli_fetch_array($borrow);
    $return_date = date('y-m-d', strtotime($borrow_information['date'].'+2 weeks'));

}

?>
    <div class="container">
            <h3>도서 정보
                <?
                echo "<span style='font-size: small;'><a href='book_form.php?book_id={$book['book_id']}'><button class='button primary small'>수정</button></a></span>
                <span style='font-size: small;'><button onclick='javascript:deleteConfirm({$book['book_id']})' class='button danger small'>삭제</button></span>
                ";
                ?>
            </h3>
            <p>
                <label for="title">제목</label>
                <textarea readonly id = "title" name="title"><?=$book['title']?></textarea>
            </p>
            <p>
                <label for="author">저자</label>
                <textarea readonly id = "author" name="author"><?=$book['author']?></textarea>
            </p>
            <p>
                <label for="ISBN">ISBN</label>
                <textarea readonly id = "ISBN" name="ISBN"><?=$book['ISBN']?></textarea>
            </p>
            <p>
                <label for="publisher">출판사</label>
                <textarea readonly id = "publisher" name="publisher" ><?=$book['publisher']?></textarea>
            </p>
            <p>
                <label for="edition">판수</label>
                <textarea readonly id = "edition" name="edition" ><?=$book['edition']?></textarea>
            </p>
            <p>
                <label for="number_of_borrows">대출 횟수</label>
                <textarea readonly id = "number_of_borrows" name="number_of_borrows" ><?=$book['number_of_borrows']?></textarea>
            </p>
            <? 
            if ($borrow_information) {
                echo "<p>
                    <label for='date'>대출일자</label>
                    <textarea readonly id = 'date' name='date'>{$borrow_information['date']}</textarea>
                    </p>";

                echo "<p>
                    <label for='return_date'>반납일자</label>
                    <textarea readonly id = 'return_date' name='return_date'>$return_date</textarea>
                    </p>";

                echo "<p>
                <label for='member'>대출 회원</label>
                <textarea readonly id = 'member' name='member'>{$borrow_information['name']}</textarea>
                </p>";
            }
            ?>
    </div>
    <div class="container"  style="max-width: 400px;">
        <? 
        //대출 중인 책일 경우, 반납 버튼을 보여주고, 그렇지 않다면 대출 버튼을 보여준다.
        if ($borrow_information) {
            echo "<p align='center'><button class='button primary small' onclick='javascript:return returnConfirm($id);'>반납</button></p>";
        } else {
            echo "<form name='borrowing_insert' action='borrowing_insert.php?book_id=$id' method='post' class='fullwidth'>
                    <p>
                        <label for='member_id'>학번</label>
                        <input type='number' placeholder='학번 입력' name='member_id' id='member_id'/>
                    </p>
                    <p align='center'><button class='button primary small' onclick='javascript:return validate();'>대출</button></p>
                </form>";
        }
        ?>
    </div>

        <script>
            function validate() {
                if(document.getElementById('member_id').value == "") {
                    alert ('학번을 입력해주십시오'); return false;
                }
                return true;
            }
            function deleteConfirm(id) {
                if (confirm("정말 삭제하시겠습니까?") == true){
                    window.location = "book_delete.php?book_id=" + id;
                }else{
                    return;
                }
            }
            function returnConfirm(id) {
                if (confirm("도서를 반납하시겠습니까?") == true){
                    return window.location = "borrowing_delete.php?book_id=" + id;
                }else {
                    return;
                }
            }
        </script> 
<? include("footer.php") ?>