<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Responsive Side Menu &ndash; Layout Examples &ndash; Pure</title>
    <link rel="stylesheet" href="./css/my.css">
    <link rel="stylesheet" href="./css/styles.css">
    <script type="text/javascript" src="./script/myScript.js"></script>
    <script type="text/javascript" src="./script/sweet.js"></script>

</head>
<body>
<?php
require_once ('class&functions/Class&Functions.php');
$connection = new Connection('book_product');
error_reporting (E_ALL ^ E_NOTICE);
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

        if(isset($_SESSION['adminIDUpdateTemp'])){
            if($_SESSION['adminIDUpdateTemp']){
                echo "<script>swal('修改成功!','','success')</script>";
                $_SESSION['adminIDUpdateTemp']=!$_SESSION['adminIDUpdateTemp'];
            }
        }

        if(isset($_POST['adminIDChangeSub']))
        {
            $_SESSION['adminIDUpdateTemp']=true;
            $name=ltrim ($_POST['adminIDChangeName'],'《');
            $name=rtrim ($name,'》');
            $value=ltrim ($_POST['adminIDChangeValue'],'RMB');
            $sql="UPDATE myDataBase.book_product SET `book_name`='{$name}',`book_value`='$value',`book_writer`='{$_POST['adminIDChangeWriter']}',`book_intro`='{$_POST['adminIDChangeIntro']}'  WHERE `book_id`={$_POST['adminIDChangeID']}";
            mysqli_query ($connection->link,$sql);
            ob_start ();
           echo "<script>window.location.href='adminID.php?id={$_POST['adminIDChangeID']}'</script>";
            unset($_POST['adminIDChangeSub']);
        }

        if (isset($_GET['id'])) {
            echo "<div style='margin-bottom: 600px'>";
            $id = $_GET['id'];
            //按id搜索商品
            $result = $connection -> search ('book_id', $id);
            $row    = mysqli_fetch_row ($result);

            echo "<form method='post' action='adminID.php' class='pure-form'>";
            echo "<div class='pure-g'style='width: 60%;margin: auto;padding-top: 50px'>";
            echo "<div class='pure-u-1-2' style=''>";
            echo "<img class='pure-img'style='width: 500px;height: 500px;margin-right: 30px' src='img/{$row[6]}'>";
            echo "</div>";
            echo "<div class='pure-u-1-2' style='padding-top: 15px;text-align: left'>";
            echo "<input type='text' name='adminIDChangeName' style='font-size: 250%;font-weight: bolder;width: 500px' value='《$row[1]》'></input>";
            echo "<hr style='border: solid #e5e5e5 1px;margin-top: 10px;margin-bottom: 10px;width: 100%'>";
            echo "<input type='text' name='adminIDChangeWriter' style='font-size: 150%;font-weight: bolder;width: 500px' value='$row[3]'></input>";
            echo "<hr style='border: solid #e5e5e5 1px;margin-top: 10px;margin-bottom: 10px;width: 100%'>";
            echo "<textarea name='adminIDChangeIntro'  style='font-size: 100%;text-indent: 25px;line-height: 30px;width: 500px;height: 170px' >$row[5]</textarea>";
            echo "<hr style='border: solid #e5e5e5 1px;margin-top: 10px;margin-bottom: 10px;width: 100%'>";
            echo "<input type='text' name='adminIDChangeValue' style='font-size: 250%;font-weight: bolder;width: 500px' value='RMB $row[4]'><br><br></input>";
            echo "<input type='text' name='adminIDChangeID' style='height: 0;visibility: hidden' value='$row[0]'><br><br></input>";

            echo "<input name='adminIDChangeSub' type='submit' class=' pure-button pure-button-primary'  style='font-size: 150%;margin-top: -50px' value='更新信息'></input>";
            echo "</div>";
            echo "</div>";
            echo "</form>";
        }
        ?>
    </div>
    <div style="width:100%;text-align: center;background-color: #f6f6f6;margin-top: 100px">
        <a class="pure-menu-heading" href="index.php" style="font-size: 150%;font-weight: bolder">APPLE LIBRARY ©️</a>
    </div>
</div>


</body>
</html>