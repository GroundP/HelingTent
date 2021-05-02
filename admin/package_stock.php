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
function confirm_delete(id, name, name2)
	{
		var stockOptions = document.getElementById("stockList");
		var stockName = stockOptions.options[stockOptions.selectedIndex].value;
		
		var msg = "삭제하시겠습니까? (" +  name + ", " + stockName + ")";
		var confirmFlag = confirm(msg);

        if (confirmFlag) 
        {
			location.href='package_stock_delete.php?id=' + id;
        } 
        else 
        {
            return;
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
    <h3 id = "stock_title">
			관리자 모드 > 패키지 | 재고 관리
		</h3>
		<ul id="stock_list">
		<li class="title">
			<span class="col1">ID</span>
			<span class="col2">패키지 이름</span>
			<span class="col3">재고 리스트</span>
			<span class="col4">개수</span>
			<span class="col5">삭제</span>
		</li>
<?php
$con = mysqli_connect("localhost", "root", "8077", "healing_tent");
$sql  = "select distinct(ps.package_id), p.name from package_stock as ps, package as p where ps.package_id = p.id";
$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_array($result))
{
	$pkgId = $row["package_id"];
	$pkgName = $row["name"];
?>
		<li>
			<form method="post">
			<span class="col1"><?=$pkgId?></span>
			<span class="col2"><?=$pkgName?></span>
			<span class="col3"><select id="stockList" name ="stockList" style="width:180px; height:30px;">
                    <?php
					$sql2  = "SELECT ps.stock_quantity, s.name FROM package_stock as ps LEFT JOIN stock as s ON ps.stock_id = s.id where ps.package_id=$pkgId";
					$Result2 = mysqli_query($con, $sql2);
					while ($row2 = mysqli_fetch_array($Result2)) 
					{
						$name = $row2["name"];
						$quantity = $row2["stock_quantity"];
						$display_name = $quantity == 1 ? $name : $name."($quantity)";
						?>
						<option value="<?=$display_name?>"><?=$display_name?></option> 
					<?php 
					}
                    ?> 
						</select>
                    </span>
			<span class="col4"></span>
			<span class="col5"><button type="submit" onclick="confirm_delete(<?=$pkgId?>, '<?=$pkgName?>', '<?=$display_name?>')">삭제</button></span>
			</form>
		</li>
<?php
   }
?>	

		<li class="add_format">
			<form method="post" name="stock_insert_form" action="package_stock_insert.php">
			<span class="col1"></span>
            <span class="col2"><select name ="add_package" style="width:200px; height:30px;">
                    <?php
					$sql2  = "select name from package";
					$pkgResult = mysqli_query($con, $sql2);
					while ($row1 = mysqli_fetch_array($pkgResult)) 
					{
						$name = $row1["name"];
					?>
                            <option value="<?=$name?>"><?=$name?></option> 
                    <?php
					}
                    ?> 
						</select>
                    </span>
            <span class="col3"><select name ="add_stock" style="width:180px; height:30px;">
                    <?php
					$sql3  = "SELECT * FROM stock";
					$Result3 = mysqli_query($con, $sql3);
					while ($row3 = mysqli_fetch_array($Result3)) 
					{
						$name = $row3["name"];
                    ?>
						<option value="<?=$name?>"><?=$name?></option> 
					<?php 
					}
                    ?> 
						</select>
                    </span>
			<span class="col4"><input type="number" name="add_quantity" value=1 min=1 max=10 style="width:50px;"></span>
			<span class="col5"><button type="submit">추가</button></span>
			</form>
		</li>
        <?php
           mysqli_close($con);
        ?>
		</ul>
    </div>
</section>
<footer>
    <?php include "../footer.php";?>
</footer>
</body>
</html>

