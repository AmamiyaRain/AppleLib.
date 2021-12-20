<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Responsive Side Menu &ndash; Layout Examples &ndash; Pure</title>
    <link rel="stylesheet" href="./css/my.css">
    <link rel="stylesheet" href="./css/styles.css">
    <script type="text/javascript" src="./script/myScript.js"></script>
    <script type="text/javascript" src="./script/sweet.js"></script>
    <link rel="stylesheet" href="./css/icon.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">

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



        $connection -> setTable ('users');
        $tempResult = $connection -> searchEveryThing ();
        $connection -> setTable ('book_product');


        if (mysqli_num_rows ($tempResult) != 0) {
            while ($row = mysqli_fetch_assoc ($tempResult)) {
                echo "<div class='pure-u-1-3'>";
                echo "<div class='pure-g'style='width: 60%;margin: auto;padding-top: 50px'>";
                echo "<div class='pure-u-1-1'>";
                echo "<a href='./class&functions/adminUserTemp.php?id={$row['user_id']}'><img src='./avatar/{$row['avatar']}' style='width: 100px;height: 100px;border-radius: 50%'><div style='margin-top: -63px;margin-left: 130px'></a><span style='font-weight: bolder;font-size: 150%'>{$row['name']}</span></div>";
                echo "<div style='margin-left: 100%;margin-top: -37px'><a href='./class&functions/deleteOrder.php?id={$row['user_id']}' class='Circle icono-cross' style='width:40px;height:40px;background: rgb(202, 60, 60);color: white'></a></div>";
                echo "<br>";
                echo "<br>";

                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<div class='pure-u-1-1' style='margin-top: 100px;margin-bottom: 1000px;font-size: 350%;color: #9a9a9a;text-align: center'>暂无用户。</div>";
        }
        //reg

        ?>
    </div>
    <div style="width:100%;text-align: center;background-color: #f6f6f6;margin-top: 100px">
        <a class="pure-menu-heading" href="index.php" style="margin-top:1300px;font-size: 150%;font-weight: bolder">APPLE LIBRARY ©️</a>
    </div>
</div>


</body>
</html>