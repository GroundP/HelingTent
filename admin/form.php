<?php  

	$con = mysqli_connect("localhost", "root", "8077", "healing_tent");
	$sql    = "SELECT c.name, c.phone_number, c.start_time, c.end_time, c.profit, p.package_name FROM client as c, package as p where c.package_id = p.id;";
	$result = mysqli_query($con, $sql);

	$aClientNames = [];
	$aClientPhones = [];
	$aClientPackages = [];
	$aClientStart = [];
	$aClientEnd = [];
	$aClientPrice = [];
	while($row = mysqli_fetch_array($result))
	{
		$aClientNames[] = $row["name"];
		$aClientPhones[] = $row["phone_number"];
		$aClientStart[] = $row["start_time"];
		$aClientEnd[] = $row["end_time"];
		$aClientPrice[] = $row["profit"];
		$aClientPackages[] = $row["package_name"];
	}

	mysqli_close($con);

   	$con = mysqli_connect("localhost", "root", "8077", "healing_tent");
    $sql    = "select * from stock;";
    $result = mysqli_query($con, $sql);

	$aStockNames = [];
	$aStockId = [];
	$aStockQuantity = [];
    while($row = mysqli_fetch_array($result))
    {
		$aStockNames[] = $row["item"];
		$aStockId[] = $row["id"];
		$aStockQuantity[] = $row["quantity"];
    }

    mysqli_close($con);


	$con = mysqli_connect("localhost", "root", "8077", "healing_tent");
    $sql    = "select * from package;";
    $result = mysqli_query($con, $sql);

	$aPkgNames = [];
	$aPkgId = [];
	$aPkgWeekdayPrice = [];
	$aPkgWeekendPrice = [];
    while($row = mysqli_fetch_array($result))
    {
		$aPkgNames[] = $row["package_name"];
		$aPkgId[] = $row["id"];
		$aPkgWeekdayPrice[] = $row["weekday_price"];
		$aPkgWeekendPrice[] = $row["weekend_price"];
    }

    mysqli_close($con);
?>
<section>
	<div id="main_content">
		<div id="join_box">
		<form name="admin_form" method="post" action="admin_modify.php?id=<?=$userid?>">
		<h2 id = admin_box>관리자 모드 > 손님 관리</h2>
	    <ul id="member_list">
			<?php
			for($i = 0; $i < count($aClientNames); $i++)
			{
				?>
				<li>
				<div class="col1"><?=$aClientNames[$i]?></div>
				<div class="col2"><?=$aClientPhones[$i]?></div>
				<div class="col3"><?=$aClientPackages[$i]?></div>
				<div class="col4"><?=$aClientStart[$i]?></div>
				<div class="col5"><?=$aClientEnd[$i]?></div>
				<div class="col6"><?=$aClientPrice[$i]?></div>
				</li>
			<?php  
			}
			?>
	    </ul>
	
			<h2 id = admin_box>관리자 모드 > 재고 관리</h2>
	   		<ul id="member_list">
			<?php
			for($i = 0; $i < count($aStockId); $i++)
			{
				?>
				<div class="col1"><?=$aStockNames[$i]?></div>
				<div class="col2">
					<input type="text" name="stock" value="<?=$aStockQuantity[$i]?>">
				</div>
			<?php  
			}
			?>
	    	</ul>

			<h2 id = admin_box>관리자 모드 > 패키지 관리</h2>
	   		<ul id="member_list">
			<?php
			for($i = 0; $i < count($aPkgId); $i++)
			{
				?>
				<div class="col1"><?=$aPkgNames[$i]?></div>
				<div class="col2">
					<input type="text" name="weekday" value="<?=$aPkgWeekdayPrice[$i]?>">
				</div>
				<div class="col3">
					<input type="text" name="weekend" value="<?=$aPkgWeekendPrice[$i]?>">
				</div>
				</div>
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
		</div> <!-- join_box -->
	</div> <!-- main_content -->
</section> 


