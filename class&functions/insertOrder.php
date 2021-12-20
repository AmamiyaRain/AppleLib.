<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>$Title$</title>
</head>
<body>
<?php
session_start ();
$_SESSION['orderTemp'] = true;
require_once ('./Class&Functions.php');
$connection = new Connection('orderList');

//$jsonStr=json_encode ($_SESSION['book_list']);
$jsonStr = json_encode ($_SESSION['book_list']);
$jsonStr = addslashes ($jsonStr);
$arr     = [ 'appleID' => $_SESSION['nowUser']['userEmail'], 'detail' => $jsonStr ];
unset($_SESSION['book_list']);
$connection -> insert ($arr);
header ("location:../indexPage.php?page=true")
?>
</body>
</html>