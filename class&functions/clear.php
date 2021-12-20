<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>$Title$</title>
</head>
<body>
<?php
session_start ();
$id=$_GET['id'];
if(isset($id)){
    unset($_SESSION['book_list'][$id]);
    $_SESSION['tempClear']=true;
}else{
    unset($_SESSION['book_list']);
}
header("location:../indexPage.php?page='cart'")
?>
</body>
</html>