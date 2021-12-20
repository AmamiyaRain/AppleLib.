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
$sql    = "select * from myDataBase.book_product where  book_id='$id'";
$result = mysqli_query ($connection -> getLink (), $sql);
if (mysqli_num_rows ($result) == 0) {
    die('no item');
} else {
    $book = mysqli_fetch_assoc ($result);
}
if (!$_SESSION['isLogin']) {
    $_SESSION['tempJudgeAddCart'] = false;
    header ("location:../indexID.php?id={$book['book_id']}");
} else {
    $book['num'] = 1;
    if (isset($_SESSION['book_list'][$book['book_id']])) {
        $_SESSION['book_list'][$book['book_id']]['num'] += 1;
    } else {
        $_SESSION['book_list'][$book['book_id']] = $book;
    }
    $_SESSION['temp'] = true;
    header ("location:../indexID.php?id={$book['book_id']}");
}
?>
</body>
</html>