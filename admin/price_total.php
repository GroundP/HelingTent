<?php

$con = mysqli_connect("localhost", "root", "8077", "healing_tent");
$sql = "select sum(profit) as total from client";

$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$total = $row["total"];
mysqli_close($con);

if ( !$result )
{
    $res = mysqli_error($con);
    $msg = "실패했습니다.(".$res.")";
}
else
{
    $msg = "매출은 ".$total."원 입니다!";
}

echo "<script>alert('{$msg}');</script>";
echo "
<script>
    location.href = 'client.php';
</script>
";