<?php

$id = $_GET["id"];

$con = mysqli_connect("localhost", "root", "8077", "healing_tent");
$sql = "delete from stock where id = $id";
$result = mysqli_query($con, $sql);

if ( !$result )
{
    $res = mysqli_error($con);
    $msg = "실패했습니다.(".$res.")";
}
else
{
    $msg = "삭제되었습니다!";
}

mysqli_close($con);

echo "<script>alert('{$msg}');</script>";
echo "
<script>
    location.href = 'stock.php';
</script>
";