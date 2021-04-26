<script>
	function onReset() 
    {
        var confirmFlag = confirm("손님 정보가 모두 사라집니다. 계속하시겠습니까?");

        if (confirmFlag) 
        {
            document.clientReset.submit();
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

			alert("패키지");
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

			alert("재고");
            document.stock_insert_form.submit();
		}
	}
</script>
<section>
	<div id="admin_box">
		<h3 id = member_title>관리자 모드 > 손님 관리</h3>
	    <ul id="client_list">
		<li>
			<span class="col1">id</span>
			<span class="col2">이름</span>
			<span class="col3">전화번호</span>
			<span class="col4">패키지</span>
			<span class="col5">시작시간</span>
			<span class="col6">종료시간</span>
			<span class="col7">가격</span>
			<span class="col8">수정</span>
			<span class="col9">삭제</span>
		</li>	


		<?php
		$con = mysqli_connect("localhost", "root", "8077", "healing_tent");
		$sql    = "SELECT c.id, c.name, c.phone_number, c.start_time, c.end_time, c.profit, p.name as pkgName FROM client as c, package as p where c.package_id = p.id;";
		$result = mysqli_query($con, $sql);

		$con = mysqli_connect("localhost", "root", "8077", "healing_tent");
		$sql = "select * from package";

		while($row = mysqli_fetch_array($result))
		{
			$clientId = $row["id"];
			$clientName = $row["name"];
			$clientPhone = $row["phone_number"];
			$clientPackage = $row["pkgName"];
			$clientStart = $row["start_time"];
			$clientEnd = $row["end_time"];
			$clientPrice = $row["profit"];
		?>
		<li>
			<form method="post" action="client_update.php?id=<?=$clientId?>">
			<span class="col1"><?=$clientId?></span>
			<span class="col2"><input type="text" name="name" value="<?=$clientName?>" style="width:60px;"></span>
			<span class="col3"><input type="text" name="phone" value="<?=$clientPhone?>" style="width:100px;"></span>
			<span class="col4"><select name ="package" style="width:180px; height:30px;">
                    <?php
					$pkgResult = mysqli_query($con, $sql);
					while ($row1 = mysqli_fetch_array($pkgResult)) 
					{
						$name = $row1["name"];
						if ( $name == $clientPackage)
						{
                    ?>
                            <option value="<?=$name?>" selected><?=$name?></option> 
                    <?php
						} else {
					?>
							<option value="<?=$name?>"><?=$name?></option>
					<?php 
						}
					}
                    ?> 
						</select></span>
			<span class="col5"><?=$clientStart?></span>
			<span class="col6"><?=$clientEnd?></span>
			<span class="col7"><input type="number" name="price" value="<?=$clientPrice?>" style="width:70px;" step="1000"></span>
			<span class="col8"><button type="submit">수정</button></span>
			<span class="col9"><button type="button" onclick="location.href='client_delete.php?id=<?=$clientId?>'">삭제</button></span>
			</form>
		</li>
<?php
   }
?>

		<form name="clientReset" action="client_reset.php">
			<div class="button">
				<span><button type="button" onclick="onReset()">초기화</button></span>
			</div>
		</form>
		</ul>

		
		<h3 id = "package_title">
			관리자 모드 > 패키지 관리
		</h3>
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
			<span class="col7"><button type="button" onclick="location.href='package_delete.php?id=<?=$pkgId?>'">삭제</button></span>
			</form>
		</li>
<?php
   }
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



		<h3 id = "stock_title">
			관리자 모드 > 재고 관리
		</h3>
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
			<form method="post" action="stock_update.php?id=<?=$stockId?>">
			<span class="col1"><?=$stockId?></span>
			<span class="col2"><input type="text" name="stock_name" value="<?=$stockName?>" style="width:200px;"></span>
			<span class="col3"><input type="number" name="stock_quantity" value="<?=$stockQuantity?>" style="width:80px;"></span>
			<span class="col4"><button type="submit">수정</button></span>
			<span class="col5"><button type="button" onclick="location.href='stock_delete.php?id=<?=$stockId?>'">삭제</button></span>
			</form>
		</li>
<?php
   }
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
	</div> <!-- main_content -->
</section> 


