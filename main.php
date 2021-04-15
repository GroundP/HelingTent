<script>
    function checkDisable(form, bTime) 
    {
        if (bTime) 
        {
            if (form.chk_add_time.checked == true)
                form.add_time.disabled = false;
            else
                form.add_time.disabled = true;
        } 
        else 
        {
            if (form.chk_add_item.checked == true)
                form.add_item.disabled = false;
            else
                form.add_item.disabled = true;
        }
    }

    function check_input() {
        if (!document.client_form.name.value) {
            alert("이름을 입력하세요!");
            document.client_form.name.focus();
            return;
        }
        if (!document.client_form.phone.value) {
            alert("연락처를 입력하세요!");
            document.client_form.phone.focus();
            return;
        }
        if (!document.client_form.package.value) {
            alert("패키지를 입력하세요!");
            document.client_form.package.focus();
            return;
        }

        var confirmFlag = confirm("예약하시겠습니까?");

        if (confirmFlag) {
            document.client_form.submit();
        } else {
            return;
        }
    }
</script>
<div id="board_box">
    <form name="client_form" method="post" action="client_insert.php" enctype="multipart/form-data">
        <ul id="board_form">
            <li>
                <span class="col1">이름 : </span>
                <span class="col2"><input name="name" type="text"></span>
            </li>
            <li>
                <span class="col1">연락처 : </span>
                <span class="col2"><input id = "phone" name="phone" type="tel" placeholder="010-1234-5678" pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}" required></span>
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
                        echo "DB 테이블(client)이 생성 전이거나 데이터가 존재하지 않습니다!";
                    else {
                        while ($row = mysqli_fetch_array($result)) {
                            $package_name = $row["package_name"];
                    ?>
                            <option value="<?= $package_name ?>" 
                    <?php
                        }
                            }
                    ?> 
                    </datalist>
            </li>
            <li>
                <span class="col1">추가 시간 : </span>
                <span class="col2"><input name="add_time" type="number" min="1" max="10" value="0" disabled></span>
                <span class="col3"><input type="checkbox" name="chk_add_time" onclick="checkDisable(this.form, true)"></span>
            </li>
            <li>
                <span class="col1">추가 물품 : </span>
                <span class="col2"><input list="add_item" name="add_item" disabled></span>
                <span class="col3"><input type="checkbox" name="chk_add_item" onclick="checkDisable(this.form, false)"></span>
                    <datalist id="add_item">
                    <?php
                    $con = mysqli_connect("localhost", "root", "8077", "healing_tent");
                    $sql = "select * from stock";
                    $result = mysqli_query($con, $sql);

                    if (!$result)
                        echo "DB 테이블(client)이 생성 전이거나 데이터가 존재하지 않습니다!";
                    else {
                        while ($row = mysqli_fetch_array($result)) {
                            $item_name = $row["item"];
                    ?>
                            <option value="<?= $item_name ?>" 
                    <?php
                        }
                    }
                    ?> 
                    </datalist>
            </li>
            <li id="text_area">
                <span class="col1">요청사항 : </span>
                <span class="col2">
                    <textarea name="Request"></textarea>
                </span>
            </li>
        </ul>
        <ul class="buttons">
            <li><button type="button" onclick="check_input()">완료</button></li>
        </ul>
    </form>
</div> <!-- board_box -->