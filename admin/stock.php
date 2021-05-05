<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>힐링텐트 관리자</title>
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
    <h3 id = "stock_title">관리자 모드 > 재고 관리</h3>
		<ul id="stock_list">
		<li class="title">
			<span class="col1">ID</span>
			<span class="col2">재고 이름</span>
			<span class="col3">수량</span>
			<span class="col4">수정</span>
			<span class="col5">삭제</span>
		</li>
<?php
$con = mysqli_connect("localhost", "root", "8077", "healing_tent");
$sql    = "select * from stock;";
$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_array($result))
{
	$stockId = $row["id"];
	$stockName = $row["name"];
	$stockQuantity = $row["quantity"];
?>
		<li>
			<form method="post" name="stock_form<?=$stockId?>" action="stock_update.php?id=<?=$stockId?>">
			<span class="col1"><?=$stockId?></span>
			<span class="col2"><input type="text" name="stock_name" value="<?=$stockName?>" style="width:200px;"></span>
			<span class="col3"><input type="number" name="stock_quantity" value="<?=$stockQuantity?>" style="width:80px;"></span>
			<span class="col4"><button type="submit">수정</button></span>
			<span class="col5"><button type="button" onclick="confirm_delete(<?=$stockId?>, '<?=$stockName?>')">삭제</button></span>
			</form>
		</li>
<?php
   }
   mysqli_close($con);
?>	

		<li class="add_format">
			<form method="post" name="stock_insert_form" action="stock_insert.php">
			<span class="col1"></span>
			<span class="col2"><input type="text" name="add_stock_name" placeholder="재고 이름" style="width:200px;"></span>
			<span class="col3"><input type="number" name="add_stock_quantity" value=100 style="width:80px;"></span>
			<span class="col4"><button type="add_button" style="width:140px;" onclick="check_input(false)">추가</button></span>
			</form>
		</li>
		</ul>
    </div>
</section>
<footer>
    <?php include "../footer.php";?>
</footer>
</body>
</html>

