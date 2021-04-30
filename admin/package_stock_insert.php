<?php

$package =  $_POST["add_package"];
$stock = $_POST["add_stock"];
$quantity = $_POST["add_quantity"];

$con = mysqli_connect("localhost", "root", "8077", "healing_tent");

//echo $package."<br>";
//echo $stock."<br>";
//echo $quantity."<br>";
//echo $con."<br>";

$sql = "select id from package where name='$package'";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_array($res);
$packageId = $row["id"];

$sql = "select id from stock where name='$stock'";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_array($res);
$stockId = $row["id"];

$sql = "insert into package_stock (package_id, stock_id, stock_quantity) VALUES ($packageId, $stockId, $quantity)";
$result = mysqli_query($con, $sql);
if ( !$result || empty($packageId) || empty($stockId) )
{
    echo mysqli_error($con);
    exit;

    //$err = mysqli_error($con);
    //$msg = "실패했습니다.(".$err.")";
}
else
{
    $msg = "추가되었습니다!";
}

mysqli_close($con);

echo "<script>alert('{$msg}');</script>";
echo "
<script>
    location.href = 'package_stock.php';
</script>
";
