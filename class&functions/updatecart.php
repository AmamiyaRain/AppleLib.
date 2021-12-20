<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>$Title$</title>
</head>
<body>
<?php
session_start ();
$id = $_GET['id'];
$num = $_GET['num'];
$_SESSION['book_list'][$id]['num']+=$num;
if($_SESSION['book_list'][$id]['num']<1){
    $_SESSION['book_list'][$id]['num']=1;
}
header("location:../indexPage.php?page='cart'")
?>
</body>
</html>