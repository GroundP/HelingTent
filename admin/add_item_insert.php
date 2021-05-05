<?php

$addItemName =  $_POST["add_item_name"];
$addItemStock =  $_POST["add_item_add_stock"];
$addItemPrice =  $_POST["add_item_price"];
$quantity = $_POST["add_item_stock_quantity"];

$con = mysqli_connect("localhost", "root", "8077", "healing_tent");
$sql = "select id from stock where name='$addItemStock'";

$result = mysqli_query($con, $sql);
$arr = mysqli_fetch_array($result);
$stockId = $arr["id"];

$sql = "insert into add_items (name, price, stock_id, stock_quantity) VALUES 
        ('$addItemName', $addItemPrice, $stockId, $quantity)";
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
    location.href = 'add_item.php';
</script>
";
