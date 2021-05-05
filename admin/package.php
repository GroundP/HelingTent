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
	function confirm_delete(id, name)
	{
		var msg = "삭제하시겠습니까? (" +  name + ")";
		var confirmFlag = confirm(msg);

        if (confirmFlag) 
        {
			location.href='package_delete.php?id=' + id;
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
        <h3 id="package_title">관리자 모드 > 패키지 관리</h3>
		<ul id="package_list">
		<li class="title">
			<span class="col1">ID</span>
			<span class="col2">패키지 이름</span>
			<span class="col3">시간</span>
			<span class="col4">주중 가격</span>
			<span class="col5">주말 가격</span>
			<span class="col6">수정</span>
			<span class="col7">삭제</span>
		</li>
<?php
$con = mysqli_connect("localhost", "root", "8077", "healing_tent");
$sql    = "select * from package;";
$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_array($result))
{
	$pkgId = $row["id"];
	$pkgName = $row["name"];
	$pkgTime = $row["time"];
	$pkgWeekdayPrice = $row["weekday_price"];
	$pkgWeekendPrice = $row["weekend_price"];
?>
		<li>
			<form method="post" action="package_update.php?id=<?=$pkgId?>">
			<span class="col1"><?=$pkgId?></span>
			<span class="col2"><input type="text" name="pkg_name" value="<?=$pkgName?>" style="width:200px;"></span>
			<span class="col3"><input type="number" name="pkg_time" value="<?=$pkgTime?>" style="width:40px;"></span>
			<span class="col4"><input type="number" name="pkg_weekday" value="<?=$pkgWeekdayPrice?>" style="width:70px;" step="1000"></span>
			<span class="col5"><input type="number" name="pkg_weekend" value="<?=$pkgWeekendPrice?>" style="width:70px;" step="1000"></span>
			<span class="col6"><button type="submit">수정</button></span>
			<span class="col7"><button type="button" onclick="confirm_delete(<?=$pkgId?>, '<?=$pkgName?>')">삭제</button></span>
			</form>
		</li>
<?php
   }
   mysqli_close($con);
?>
		<li class="add_format">
			<form method="post" name="pkg_insert_form" action="package_insert.php">
			<span class="col1"></span>
			<span class="col2"><input type="text" name="add_pkg_name" placeholder="패키지 이름" style="width:200px;"></span>
			<span class="col3"><input type="number" name="add_pkg_time" value=4 style="width:40px;"></span>
			<span class="col4"><input type="number" name="add_pkg_weekday" value=10000 style="width:70px;" step="1000"></span>
			<span class="col5"><input type="number" name="add_pkg_weekend" value=20000 style="width:70px;" step="1000"></span>
			<span class="col6"><button type="submit" style="width:140px;" onclick="check_input(true)">추가</button></span>
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

