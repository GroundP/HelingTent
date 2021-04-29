<?php

$id = $_GET["id"];
$name =  $_POST["name"];
$phone = $_POST["phone"];
$package = $_POST["package"];
$price = $_POST["price"];

$con = mysqli_connect("localhost", "root", "8077", "healing_tent");
$sql = "update client as c, package as p SET c.name='$name', c.phone_number='$phone', c.profit = $price, c.package_id = p.id where c.id = $id and p.name = '$package'";
$result = mysqli_query($con, $sql);

if ( !$result )
{
    $res = mysqli_error($con);
    $msg = "실패했습니다.(".$res.")";
}
else
{
    $msg = "수정되었습니다!";
}

mysqli_close($con);

echo "<script>alert('{$msg}');</script>";
echo "
<script>
    location.href = 'client.php';
</script>
";
