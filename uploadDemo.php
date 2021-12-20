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

function upload ( $file, $upload_dir = './avatar/', $allowSize = 0, $allowType = [] )
{
    $connection = new Connection('users');
    //get info

    $files = $_FILES[$file];

    //upload right way
    $filename = $files['name'];
    var_dump ($filename);
    if(strlen ($filename)==0)
    {
        $_SESSION['nowUser']['userName'] = $_POST['name'];
        if ($_POST['psd'] == $_POST['psd_C']) {
            $command                       = "UPDATE myDataBase.users SET `name`='{$_SESSION['nowUser']['userName']}',`psd`='{$_POST['psd']}' WHERE email='{$_SESSION['nowUser']['userEmail']}'";
            $_SESSION['tempUploadSuccess'] = true;
        } else {
            $_SESSION['tempUploadWrongPsd'] = true;
        }
        mysqli_query ($connection -> link, $command);
        return false;
    }
    //generate random name
    $filename = mt_rand (1000, 9999) . '_' . $filename;
    //get .txt or something
    $ext        = pathinfo ($files['name'], PATHINFO_EXTENSION);
    $saveTo     = $upload_dir . $filename;
    $upload_dir = rtrim ($upload_dir, '/') . '/';
    $_SESSION['nowUser']['userAvatar'] = $filename;
    $_SESSION['nowUser']['userName']   = $_POST['name'];
    if ($_POST['psd'] == $_POST['psd_C']) {
        $command                       = "UPDATE myDataBase.users SET `name`='{$_SESSION['nowUser']['userName']}',`psd`='{$_POST['psd']}',`avatar`='{$_SESSION['nowUser']['userAvatar']}' WHERE email='{$_SESSION['nowUser']['userEmail']}'";
        $_SESSION['tempUploadSuccess'] = true;

    } else {
        $_SESSION['tempUploadWrongPsd'] = true;

    }
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

header ("location:indexUser.php");
?>
<!--<img src="--><? //=$a?><!--">-->
</body>
</html>