<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>APPLE LIB.</title>
    <link rel="stylesheet" href="./css/my.css">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/icon.css"><link rel="stylesheet" href="./css/animate.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <script type="text/javascript" src="./script/myScript.js"></script>
    <script type="text/javascript" src="./script/sweet.js"></script>

</head>
<body>
<?php
require_once ('class&functions/Class&Functions.php');
$connection = new Connection('book_product');
error_reporting(E_ALL^E_NOTICE);
?>

<div id="layout" style="height: 1000px">

    <a href="#menu" id="menuLink" class="menu-link">
        <span></span>
    </a>


    <?php
    include_once ('adminLeftSide.php')
    ?>

    <div style="margin-left: 30px">
        <?php

        if(isset($_SESSION['adminDeleteBook'])){
            if($_SESSION['adminDeleteBook']){
                echo "<script>swal('删除成功!','','success')</script>";
                $_SESSION['adminDeleteBook']=!$_SESSION['adminDeleteBook'];
            }
        }
        if(isset($_POST['adminChangeSub']))
        {
            $_SESSION['adminUpdateTemp']=true;
            $name=ltrim ($_POST['adminName'],'《');
            $name=rtrim ($name,'》');
            $value=ltrim ($_POST['adminValue'],'RMB');
            $sql="UPDATE myDataBase.book_product SET `book_name`='{$name}',`book_value`='$value' WHERE `book_id`={$_POST['adminID']}";
            mysqli_query ($connection->link,$sql);
        }
        if(isset($_SESSION['adminUpdateTemp'])){
            if($_SESSION['adminUpdateTemp']){
                echo "<script>swal('修改成功!','','success')</script>";
                $_SESSION['adminUpdateTemp']=!$_SESSION['adminUpdateTemp'];
            }
        }
        $resultAll = $connection -> searchEveryThing ();
        $connection -> printByConditionRightSideAdmin  ($resultAll);
        echo "<div class='pure-u-1-4' style='text-align: center;height: 450px;margin-top: 30px;margin-bottom: 30px' >";
        echo "<div class='pure-u-1-1'  style='height:80%;text-align: center'>";
        echo "<a href='./adminCreate.php'><img class='animate__animated animate__bounceInRight' src='./img/add.png'   style='filter: brightness(70%);text-align:center;width: 150px;height: 150px;margin: 100px 0' alt=''></a>";
        echo "</div>";
        echo "</form>";
        echo "</div>";
        echo "</div>";



        ?>
    </div>
    <div style="width:100%;text-align: center;background-color: #f6f6f6;margin-top: 100px">
        <a class="pure-menu-heading" href="index.php" style="font-size: 150%;font-weight: bolder">APPLE LIBRARY ©️</a>
    </div>
</div>


</body>
</html>