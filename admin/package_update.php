<?php

$id = $_GET["id"];
$name =  $_POST["pkg_name"];
$time = $_POST["pkg_time"];
$weekday_price = $_POST["pkg_weekday"];
$weekend_price = $_POST["pkg_weekend"];

$con = mysqli_connect("localhost", "root", "8077", "healing_tent");
$sql = "update package SET name='$name', time=$time, weekday_price = $weekday_price, weekend_price = $weekend_price where id = $id;";
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
