<?php

$clientId = $_GET["id"];
$clientName =  $_POST["name"];
$clientPhone = $_POST["phone"];
$clientPackage = $_POST["package"];

$con = mysqli_connect("localhost", "root", "8077", "healing_tent");
$sql = "update client as c, package as p SET c.name='$clientName', c.phone_number='$clientPhone', c.package_id = p.id where c.id = $clientId and p.package_name = '$clientPackage'";
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
