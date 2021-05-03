<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>힐링텐트 admin</title>
<link rel="shortcut icon" type="image/x-icon" href="../img/ht_ci.jpeg">
<link rel="stylesheet" type="text/css" href="../css/common.css">
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<link rel="stylesheet" type="text/css" href="../css/member.css">
<script>
	function confirm_delete(stockId, stockName)
	{
		var msg = "삭제하시겠습니까? (" +  stockName + ")";
		var confirmFlag = confirm(msg);

        if (confirmFlag) 
        {
			location.href='stock_delete.php?id=' + stockId;
        } 
        else 
        {
            return;
        }
	}
	
    function check_input(bPkg)
	{
		if ( bPkg )
		{
			if ( !document.pkg_insert_form.add_pkg_name.value )
			{
				alert("패키지 이름을 입력하세요!");
				document.pkg_insert_form.add_pkg_name.focus();
            	return;
			}

            document.pkg_insert_form.submit();
		}
		else
		{
			if ( !document.stock_insert_form.add_stock_name.value )
			{
				alert("재고 이름을 입력하세요!");
				document.stock_insert_form.add_stock_name.focus();
            	return;
			}

            document.stock_insert_form.submit();
		}
	}
</script>
</head>
<body>
<header>
    <?php include "admin_header.php";?>
</header>
<section>
	<div id="admin_box">
    <h3 id = "add_item_title">관리자 모드 > 추가물품 관리</h3>
		<ul id="add_item_list">
		<li class="title">
			<span class="col1">ID</span>
			<span class="col2">추가 물품</span>
			<span class="col3">재고 리스트</span>
			<span class="col4">가격</span>
			<span class="col5">개수</span>
			<span class="col6">삭제</span>
		</li>
<?php
$con = mysqli_connect("localhost", "root", "8077", "healing_tent");
$sql    = "select * from add_items";
$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_array($result))
{
	$itemId = $row["id"];
	$itemName = $row["name"];
	$itemPrice = $row["price"];
	$stockId = $row["stock_id"];
	$stockQuantity = $row["stock_quantity"];
?>
		<li>
			<form method="post" name="add_item_form<?=$stockId?>" action="stock_update.php?id=<?=$stockId?>">
			<span class="col1"><?=$itemId?></span>
			<span class="col2"><?=$itemName?></span>
            <?php
                $sql2 = "select name from stock where id=$stockId";
                $result2 = mysqli_query($con, $sql2);
                $row2 = mysqli_fetch_array($result2);
                $name = $row2["name"];
                $display_name = $stockQuantity == 1 ? $name : $name."($stockQuantity)";
            ?>
			<span class="col3"><?=$display_name?></span>
			<span class="col4"><?=$itemPrice?></span>
			<span class="col5"></span>
			<span class="col6"><button type="button" onclick="confirm_delete(<?=$stockId?>, '<?=$stockName?>')">삭제</button></span>
			</form>
		</li>
<?php
   }
?>	

		<li class="add_format">
			<form method="post" name="add_item_add_form" action="add_item_insert.php">
			<span class="col1"></span>
			<span class="col2"><input type="text" name="add_item_name" placeholder="추가물품 이름" style="width:200px;"></span>
			<span class="col3"><select name="add_item_add_stock" style="width:180px; height:30px;">
            <?php
                $sql3 = "select id, name from stock";
                $result3 = mysqli_query($con, $sql3);

                while($row3 = mysqli_fetch_array($result3))
                {
                    $name = $row3["name"];
                    $id = $row3["id"];
            ?>
                    <option value="$name"><?=$name?></option>
            <?php
                }
            ?>
            </select></span>
			<span class="col4"><input type="number" name="add_item_price" value=1000 style="width:80px;" step="1000"></span>
			<span class="col5"><input type="number" name="add_item_stock_quantity" value=1 style="width:30px;" max="9" min="1"></span>
			<span class="col6"><button type="add_button" onclick="check_input(false)">추가</button></span>
			</form>
		</li>
		</ul>
    </div>
<?php
   mysqli_close($con);
?>
</section>
<footer>
    <?php include "../footer.php";?>
</footer>
</body>
</html>