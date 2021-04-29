<?php

$name =  $_POST["add_pkg_name"];
$time = $_POST["add_pkg_time"];
$weekday_price = $_POST["add_pkg_weekday"];
$weekend_price = $_POST["add_pkg_weekend"];

$con = mysqli_connect("localhost", "root", "8077", "healing_tent");
$sql = "insert into package (name, time, weekday_price, weekend_price) VALUES ('$name', $time, $weekday_price, $weekend_price)";
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
    location.href = 'package.php';
</script>
";
