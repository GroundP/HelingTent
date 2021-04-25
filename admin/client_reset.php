<?php

$con = mysqli_connect("localhost", "root", "8077", "healing_tent");
$sql = "delete from client;";
$result1 = mysqli_query($con, $sql);
$sql = "ALTER TABLE client AUTO_INCREMENT=0;";
$result2 = mysqli_query($con, $sql);

if ( !$result1 || !$result2  )
{
    $res = mysqli_error($con);
    $msg = "실패했습니다.(".$res.")";
}
else
{
    $msg = "초기화 되었습니다!";
}

echo "<script>alert('{$msg}');</script>";
echo "
<script>
    location.href = 'index.php';
</script>
";