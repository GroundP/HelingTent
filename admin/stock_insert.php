<?php

$name =  $_POST["add_stock_name"];
$quantity = $_POST["add_stock_quantity"];

$con = mysqli_connect("localhost", "root", "8077", "healing_tent");
$sql = "insert into stock (name, quantity) VALUES ('$name', $quantity)";
$result = mysqli_query($con, $sql);

if ( !$result )
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
    location.href = 'stock.php';
</script>
";
