<?php

$clientId = $_GET["id"];
$clientName =  $_POST["name"];
$clientPhone = $_POST["phone"];
$clientPackage = $_POST["package"];

echo $clientId."\n".$clientName."\n".$clientPhone;

$con = mysqli_connect("localhost", "root", "8077", "healing_tent");
$sql    = "update client SET name='$clientName', phone_number='$clientPhone' where id=$clientId";
$result = mysqli_query($con, $sql);

if ( !$result )
{
    echo "실패!";
    echo mysqli_error($con);
}
else
{
    echo "성공!";
}