<section>
	<div id="admin_box">
		<h3 id = member_title>관리자 모드 > 손님 관리</h3>
	    <ul id="client_list">
		<li>
			<span class="col1">이름</span>
			<span class="col2">전화번호</span>
			<span class="col3">패키지</span>
			<span class="col4">시작시간</span>
			<span class="col5">종료시간</span>
			<span class="col6">가격</span>
			<span class="col7">수정</span>
			<span class="col8">삭제</span>
		</li>	


<?php
$con = mysqli_connect("localhost", "root", "8077", "healing_tent");
$sql    = "SELECT c.name, c.phone_number, c.start_time, c.end_time, c.profit, p.package_name FROM client as c, package as p where c.package_id = p.id;";
$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_array($result))
{
	$aClientName = $row["name"];
	$aClientPhone = $row["phone_number"];
	$aClientPackage = $row["package_name"];
	$aClientStart = $row["start_time"];
	$aClientEnd = $row["end_time"];
	$aClientPrice = $row["profit"];
?>
		<li>
			<form name="admin_form" method="post" action="admin_modify.php?id=<?=$userid?>">
			<span class="col1"><?=$aClientName?></span>
			<span class="col2"><?=$aClientPhone?></a></span>
			<span class="col3"><?=$aClientPackage?></span>
			<span class="col4"><?=$aClientStart?></span>
			<span class="col5"><?=$aClientEnd?></span>
			<span class="col6"><?=$aClientPrice?></span>
			<span class="col7"><button type="submit">수정</button></span>
			<span class="col8"><button type="button" onclick="location.href='admin_member_delete.php?num=<?=$num?>'">삭제</button></span>
		</li>
<?php
   }
?>
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
		<form method="post" action="admin_board_delete.php">
<?php
$con = mysqli_connect("localhost", "root", "8077", "healing_tent");
$sql    = "select * from stock;";
$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_array($result))
{
	$aStockId = $row["id"];
	$aStockName = $row["item"];
	$aStockQuantity = $row["quantity"];
?>
		<li>
			<span class="col1"><?=$aStockId?></span>
			<span class="col2"><?=$aStockName?></span>
			<span class="col3"><?=$aStockQuantity?></span>
			<span class="col4"><button type="submit">수정</button></span>
			<span class="col5"><button type="button" onclick="location.href='admin_member_delete.php?num=<?=$num?>'">삭제</button></span>
		</li>
<?php
   }
?>	
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
		<form method="post" action="admin_board_delete.php">
<?php
$con = mysqli_connect("localhost", "root", "8077", "healing_tent");
$sql    = "select * from package;";
$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_array($result))
{
	$aPkgId = $row["id"];
	$aPkgNames = $row["package_name"];
	$aPkgTime = $row["time"];
	$aPkgWeekdayPrice = $row["weekday_price"];
	$aPkgWeekendPrice = $row["weekend_price"];
?>
		<li>
			<span class="col1"><?=$aPkgId?></span>
			<span class="col2"><?=$aPkgNames?></span>
			<span class="col3"><?=$aPkgTime?></span>
			<span class="col4"><?=$aPkgWeekdayPrice?></span>
			<span class="col5"><?=$aPkgWeekendPrice?></span>
			<span class="col6"><button type="submit">수정</button></span>
			<span class="col7"><button type="button" onclick="location.href='admin_member_delete.php?num=<?=$num?>'">삭제</button></span>
		</li>
<?php
   }
?>	
		</ul>
			<div class="buttons">
				<img style="cursor:pointer" src="../img/button_save.gif" onclick="check_input()">&nbsp;
				<img id="reset_button" style="cursor:pointer" src="../img/button_reset.gif"
					onclick="reset_form()">
			</div>
		</form>
	</div> <!-- main_content -->
</section> 


