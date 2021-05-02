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

    function check_input() 
    {
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

        if (document.client_form.package.value == "None") {
            alert("패키지를 선택하세요!");
            document.client_form.package.focus();
            return;
        }

        var confirmFlag = confirm("예약하시겠습니까?");

        if (confirmFlag) 
        {
            document.client_form.submit();
        } 
        else 
        {
            return;
        }
    }
</script>
<div id="board_box">
    <form name="client_form" method="post" action="client_insert.php" enctype="multipart/form-data">
        <ul id="board_form">
            <li>
                <span class="col1"><b>*이름 : </b></span>
                <span class="col2"><input name="name" type="text" maxlength="5"></span>
            </li>
            <li>
                <span class="col1"><b>*연락처 : </b></span>
                <span class="col2">
                <select name="phone1" style="width:50px; height:25px;">
                    <option value="010" selected>010</option>
                    <option value="010">011</option>
                    <option value="010">016</option>
                    <option value="010">017</option>
                    <option value="010">018</option>
                    <option value="010">019</option>
                </select> - 
                <input name="phone" type="text" maxlength="4" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" style="width:50px; height:25px;"> -
                <input name="phone" type="text" maxlength="4" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" style="width:50px; height:25px;"></span>
            </li>
            <li>
                <span class="col1"><b>*패키지 : </b></span>
                <span class="col2"><select name="package" id="package" style="width:505px; height:30px;">
                <option value="None">선택하세요</option>
                <?php
                date_default_timezone_set('Asia/Seoul');
                $day = date('w');
                $bWeekend = ($day == 0 || $day == 5 || $day == 6);

                $con = mysqli_connect("localhost", "root", "8077", "healing_tent");
                $sql = "select * from package";
                $result = mysqli_query($con, $sql);
                if (!$result)
                    echo "DB 테이블(client)이 생성 전이거나 데이터가 존재하지 않습니다!";
                else {
                    while ($row = mysqli_fetch_array($result)) 
                    {
                        $package_name = $row["name"];
                        $weekday_price = $row["weekday_price"];
                        $weekend_price = $row["weekend_price"];
                        $displayName = $bWeekend ? $package_name." - ".$weekend_price."원" 
                                                 : $package_name." - ".$weekday_price."원";
                ?>
                        <option value="<?= $package_name?>"><?= $displayName?></option>
                <?php
                    }
                }
                ?> 
                </select></span>
            </li>
            <li>
                <span class="col1"><b>추가 시간 : </b></span>
                <span class="col2"><input name="add_time" type="number" min="0" max="10" value="0"></span>
            </li>
            <li>
                <span class="col1"><b>추가 물품 : </b></span>
                <span class="col2"><select name="add_item" style="width:505px; height:30px;">
                <option value="None">선택하세요</option>
                    <?php
                    $con = mysqli_connect("localhost", "root", "8077", "healing_tent");
                    $sql = "select * from add_items";
                    $result = mysqli_query($con, $sql);
                    
                    if (!$result)
                        echo "DB 테이블(client)이 생성 전이거나 데이터가 존재하지 않습니다!";
                    else {
                        while ($row = mysqli_fetch_array($result)) {
                            $item_name = $row["name"];
                    ?>
                            <option value="<?= $item_name ?>"><?= $item_name?></option>
                    <?php
                        }
                    }
                    ?> 
                    </select></span>
            </li>
            <li id="text_area">
                <span class="col1"><b>요청사항 : </b></span>
                <span class="col2">
                    <textarea name="Request" style="resize: none;"></textarea>
                </span>
            </li>
        </ul>
        <ul class="buttons">
            <li><button type="button" onclick="check_input()">완료</button></li>
        </ul>
    </form>
</div> <!-- board_box -->