<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>힐링텐트 admin</title>
<link rel="stylesheet" type="text/css" href="../css/common.css">
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<link rel="stylesheet" type="text/css" href="../css/member.css">
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
    </script>
</head>
<body>
<header>
    <?php include "admin_header.php";?>
</header>
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
   mysqli_close($con);
?>

    <form name="clientReset" action="client_reset.php">
        <div class="button">
            <span><button type="button" onclick="onReset()">초기화</button></span>
        </div>
    </form>
    </ul>
    </div>
</section>
<footer>
    <?php include "../footer.php";?>
</footer>
</body>
</html>

