<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>$Title$</title>
</head>
<body>
<?php
session_start ();
require_once ('./Class&Functions.php');
$connection = new Connection('orderList');

$id     = $_GET['id'];
$sql    = "DELETE FROM myDataBase.orderList WHERE `orderList`.`num` = $id";
$result = mysqli_query ($connection -> getLink (), $sql);
$_SESSION["adminDeleteOrder"]=true;
header ("location:../adminOrder.php");

?>
</body>
</html>