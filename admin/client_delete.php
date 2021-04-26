<?php

$clientId = $_GET["id"];

$con = mysqli_connect("localhost", "root", "8077", "healing_tent");
$sql = "SELECT client.package_id FROM client LEFT JOIN package ON package_id = package.id where client.id = $clientId";
    
$result1 = mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
if ( !$result1 )
{
    echo mysqli_error($con);
    exit;
}

$row = mysqli_fetch_array($result1);
if ( empty($row['package_id']) )
{
    echo "문제가 발생했습니다(package id)";
    exit;
}
$package_id = $row['package_id'];

$sql = "select * from package_stock as p LEFT JOIN stock as s ON p.stock_id = s.id where p.package_id = $package_id";
$result2 = mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행

while($row = mysqli_fetch_array($result2))
{
    if ( empty($row["id"]) )
        break;

    $stock_id = $row["stock_id"];
    $stock_quantity = $row["stock_quantity"];
    $sql = "update stock set quantity = quantity + $stock_quantity where id = $stock_id";

    mysqli_query($con, $sql);
}

$sql = "delete from client where id = $clientId";
$result3 = mysqli_query($con, $sql);

if ( !$result1 || !$result2 || !$result3)
{
    $res = mysqli_error($con);
    $msg = "실패했습니다.(".$res.")";
}
else
{
    $msg = "삭제되었습니다!";
}

echo "<script>alert('{$msg}');</script>";
echo "
<script>
    location.href = 'index.php';
</script>
";