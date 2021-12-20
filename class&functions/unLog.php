<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>$Title$</title>
</head>
<body>
<?php
session_start ();
unset($_SESSION['isLogin']);
unset($_SESSION['nowUser']);
unset($_SESSION['book_list']);
$_SESSION['tempUnLogAlert']=true;
header("location:../indexLog.php?log='cart'")
?>
</body>
</html>