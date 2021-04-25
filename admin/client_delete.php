<?php

$clientId = $_GET["id"];

$con = mysqli_connect("localhost", "root", "8077", "healing_tent");
$sql = "delete from client where id = $clientId";
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