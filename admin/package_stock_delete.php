<?php

$pkgId = $_GET["id"];
$stock = $_POST["stockList"];

if ( strpos($stock, "(") !== false)
{
    $posNum = mb_strpos($stock, "(");
    $stockName = mb_substr($stock, 0, $posNum, 'utf-8');
}
else
{
    $stockName = $stock;
}

$con = mysqli_connect("localhost", "root", "8077", "healing_tent");
$sql = "select * from stock where name = '$stockName'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$stockId = $row["id"];

$sql = "delete from package_stock where package_id = $pkgId and stock_id = $stockId";
$result = mysqli_query($con, $sql);

if ( !$result )
{
    $res = mysqli_error($con);
    $msg = "실패했습니다.(".$res.")";
}
else
{
    $msg = "삭제되었습니다!";
}

mysqli_close($con);

echo "<script>alert('{$msg}');</script>";
echo "
<script>
    location.href = 'package_stock.php';
</script>
";