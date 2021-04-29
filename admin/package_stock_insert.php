<?php

$package =  $_POST["add_package"];
$stock = $_POST["add_stock"];
$quantity = $_POST["add_quantity"];

$con = mysqli_connect("localhost", "root", "8077", "healing_tent");

$sql = "select id from package where name='".$package."'";
$res = mysqli_query($con, $sql);
$packageId = $res["id"];

$sql = "select id from stock where name='".$stock."'";
$res = mysqli_query($con, $sql);
$stockId = $res["id"];

$sql = "insert into package_stock VALUES ($packageId, $stockId, $qauntity)";
$result = mysqli_query($con, $sql);

if ( !$result || empty($packageId) || empty($stockId) )
{
    $res = mysqli_error($con);
    $msg = "실패했습니다.(".$res.")";
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
