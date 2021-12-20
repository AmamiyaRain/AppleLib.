<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>$Title$</title>
</head>
<body>
<?php
require_once ('class&functions/Class&Functions.php');
session_start ();


$a                             = upload ('upload');

function upload ( $file, $upload_dir = './img/', $allowSize = 0, $allowType = [] )
{
    $connection = new Connection('book_product');
    //get info

    $files = $_FILES[$file];

    //upload right way
    $filename = $files['name'];
    var_dump ($filename);
    if(strlen ($filename)==0)
    {
        $_SESSION['tempCreateSuccess'] = true;
        $command="INSERT INTO myDataBase.book_product( `book_name`, `book_type`, `book_writer`, `book_value`, `book_intro`, `book_pic`) VALUES ('{$_POST['adminIDChangeName']}','{$_POST['adminIDChangeType']}','{$_POST['adminIDChangeWriter']}','{$_POST['adminIDChangeValue']}','{$_POST['adminIDChangeIntro']}','c_1.jpg')";
        mysqli_query ($connection->link,$command);
        return false;
    }
    //generate random name
    $filename = mt_rand (1000, 9999) . '_' . $filename;
    //get .txt or something
    $ext        = pathinfo ($files['name'], PATHINFO_EXTENSION);
    $saveTo     = $upload_dir . $filename;
    $upload_dir = rtrim ($upload_dir, '/') . '/';


    $command="INSERT INTO myDataBase.book_product( `book_name`, `book_type`, `book_writer`, `book_value`, `book_intro`, `book_pic`) VALUES ('{$_POST['adminIDChangeName']}','{$_POST['adminIDChangeType']}','{$_POST['adminIDChangeWriter']}','{$_POST['adminIDChangeValue']}','{$_POST['adminIDChangeIntro']}','{$filename}')";
        $_SESSION['tempCreateSuccess'] = true;


    if (!file_exists ($upload_dir)) {
        $result = mkdir ($upload_dir, 0777, true);
        if (!$result) {
            return false;
        }
    }
    if ($files['error'] != 0) {
        return false;
    }
    //upload size
    //$allowSize=2048000;
    if ($allowSize > 0 && $files['size'] > $allowSize) {
        return false;
    }
//    $allowType=['image/jpeg','image/png','image/gif'];
    if (count ($allowType) > 0 && !in_array ($files['type'], $allowType)) {
        return false;
    }

    if (!is_uploaded_file ($files['tmp_name'])) {
        return false;
    }


    mysqli_query ($connection -> link, $command);
    move_uploaded_file ($files['tmp_name'], $saveTo);


    return $saveTo;

}

header ("location:adminCreate.php");
?>
<!--<img src="--><? //=$a?><!--">-->
</body>
</html>