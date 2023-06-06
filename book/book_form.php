<?
include "../header.php";
include "../config.php";
include "../util.php";

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "추가";
$action = "book_insert.php";

if (array_key_exists("book_id", $_GET)) {
    $id = $_GET["book_id"];
    $query =  "select * from book where book_id = $id";
    $result = mysqli_query($conn, $query);
    $book = mysqli_fetch_array($result);
    if(!$book) {
        msg("존재하지 않는 도서입니다.");
    }
    $mode = "수정";
    $action = "book_modify.php?book_id=$id"; 
}
?>

    <div class="container">
        <form name="book_form" action="<?=$action?>" method="post" class="fullwidth">
            <h3>도서 <?=$mode?></h3>
            <p>
                <label for="title">제목</label>
                <input type="text" placeholder="제목 입력" id = "title" name="title" value="<?=$book['title']?>"/>
            </p>
            <p>
                <label for="author">저자</label>
                <input type="text" placeholder="저자 입력" id = "author" name="author" value="<?=$book['author']?>"/>
            </p>
            <p>
                <label for="ISBN">ISBN</label>
                <input type="text" placeholder="ISBN 입력" id = "ISBN" name="ISBN" value="<?=$book['ISBN']?>"/>
            </p>
            <p>
                <label for="publisher">출판사</label>
                <input type="text" placeholder="출판사 입력" id = "publisher" name="publisher" value="<?=$book['publisher']?>"/>
            </p>
            <p>
                <label for="edition">판수</label>
                <input type="text" placeholder="판수 입력" id = "edition" name="edition" value="<?=$book['edition']?>"/>
            </p>


            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("title").value == "") {
                        alert ("제목을 입력해주십시오"); return false;
                    }
                    else if(document.getElementById("author").value == "") {
                        alert ("작가를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("ISBN").value == "") {
                        alert ("ISBN를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("publisher").value == "") {
                        alert ("출판사 정보를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("edition").value == "") {
                        alert ("판수를 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>