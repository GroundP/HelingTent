<?php
$id = $_GET["id"];
$name =  $_POST["stock_name"];
$qunatity = $_POST["stock_quantity"];

$con = mysqli_connect("localhost", "root", "8077", "healing_tent");
$sql = "update stock SET name='$name', quantity=$qunatity where id = $id";
$result = mysqli_query($con, $sql);

if ( !$result )
{
    $res = mysqli_error($con);
    $msg = "실패했습니다.(".$res.")";
}
else
{
    $msg = "성공했습니다!";
}

echo "<script>alert('{$msg}');</script>";
echo "
<script>
    location.href = 'index.php';
</script>
";
