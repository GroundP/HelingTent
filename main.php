<form  name="board_form" method="post" action="board_insert.php" enctype="multipart/form-data">
    <ul id="board_form">
        <li>
            <span class="col1">이름 : </span>
            <span class="col2"><input name="name" type="text"></span>
        </li>		
        <li>
            <span class="col1">연락처 : </span>
            <span class="col2"><input name="subject" type="tel" placeholder="010-1234-5678" pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}" required></span>
        </li>
        <li>
            <span class="col1">인원수 : </span>
            <span class="col2"><input name="people" type="number" min="1" max="10" value="2"></span>
        </li>
        <li>
            <span class="col1">패키지 : </span>
            <input list="package" name="package">
		<datalist id="package">
<?php
    $con = mysqli_connect("localhost", "root", "8077", "healing_tent");
    $sql = "select * from package";
    $result = mysqli_query($con, $sql);

    if (!$result)
        echo "게시판 DB 테이블(board)이 생성 전이거나 아직 게시글이 없습니다!";
    else
    {
        while( $row = mysqli_fetch_array($result) )
        {
            $package_name = $row["package_name"];
?>
            <option value="<?=$package_name?>"aaa</option>
<?php
        }
    }
?>
		</datalist>
        </li>
        <li>
            <input type="checkbox" name="addTime" value="추가 시간" checked>
            <span class="col1">추가 대여시간 : </span>
            <span class="col2"><input name="subject" type="number" min="1" max="10" value="0"></span>
        </li>
        <li>
            <span class="col1">추가 물품 : </span>
            <input type="checkbox" name="add_time" value="추가 시간" checked>
            <input list="add_item" name="add_item">
            <datalist id="add_item">
<?php
    $con = mysqli_connect("localhost", "root", "8077", "healing_tent");
    $sql = "select * from stock";
    $result = mysqli_query($con, $sql);

    if (!$result)
        echo "게시판 DB 테이블(board)이 생성 전이거나 아직 게시글이 없습니다!";
    else
    {
        while( $row = mysqli_fetch_array($result) )
        {
            $item_name = $row["item"];
?>
            <option value="<?=$item_name?>"
<?php
        }
    }
?>
		</datalist>
            <span class="col2"><input name="subject" type="number" min="1" max="10" value="0"></span>
        </li>
        <li id="text_area">	
            <span class="col1">요청사항 : </span>
            <span class="col2">
                <textarea name="content"></textarea>
            </span>
        </li>
        </ul>
    <ul class="buttons">
        <li><button type="button" onclick="check_input()">완료</button></li>
    </ul>
</form>