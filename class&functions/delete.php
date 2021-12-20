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
$connection = new Connection('book_product');

$id     = $_GET['id'];
$sql    = "DELETE FROM myDataBase.book_product WHERE `book_product`.`book_id` = $id";
$result = mysqli_query ($connection -> getLink (), $sql);
$_SESSION["adminDeleteBook"]=true;
header ("location:../admin.php");

?>
</body>
</html>