<script>
  function check_input() {
      if (!document.client_form.name.value)
      {
          alert("이름을 입력하세요!");
          document.client_form.name.focus();
          return;
      }
      if (!document.client_form.phone.value)
      {
          alert("연락처를 입력하세요!");
          document.client_form.phone.focus();
          return;
      }
      if (!document.client_form.package.value)
      {
          alert("패키지를 입력하세요!");
          document.client_form.package.focus();
          return;
      }
      document.client_form.submit();
   }
</script>
<form  name="client_form" method="post" action="client_insert.php" enctype="multipart/form-data">
    <ul id="client_form">
        <li>
            <span class="col1">이름 : </span>
            <span class="col2"><input name="name" type="text"></span>
        </li>		
        <li>
            <span class="col1">연락처 : </span>
            <span class="col2"><input name="phone" type="tel" placeholder="010-1234-5678" pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}" required></span>
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
            <input type="checkbox" name="addTime" value="addTime" checked>추가 시간 : 
            <span class="col2"><input name="subject" type="number" min="1" max="10" value="0"></span>
        </li>
        <li>
            <input type="checkbox" name="add_time" value="add_time" checked>추가 물품 : 
            <input list="add_item" name="add_item">
            <datalist id="add_item">
<?php
    $con = mysqli_connect("localhost", "root", "8077", "healing_tent");
    $sql = "select * from stock";
    $result = mysqli_query($con, $sql);

    if (!$result)
        echo "DB 테이블(client)이 생성 전이거나 데이터가 존재하지 않습니다!";
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