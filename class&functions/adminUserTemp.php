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
$connection = new Connection('users');

$id     = $_GET['id'];
$result=$connection->search ('user_id',"$id");
$result = mysqli_fetch_assoc ($result);

$_SESSION['nowUser']['userName']  = $result['name'];
$_SESSION['nowUser']['userEmail'] = $result['email'];
$_SESSION['nowUser']['userAvatar'] = $result['avatar'];
$_SESSION['nowUser']['userPsd'] = $result['psd'];
$_SESSION['nowUser']['userType'] = $result['isAdmin'];

header ("location:../indexUser.php");

?>
</body>
</html>