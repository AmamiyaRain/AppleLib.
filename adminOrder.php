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
        $sum = 0;
        $add = 0;


        $connection -> setTable ('orderList');
        $tempResult = $connection -> searchEveryThing ();
        $connection -> setTable ('book_product');
        if (isset($_SESSION['adminDeleteOrder'])) {
            if ($_SESSION['adminDeleteOrder']) {
                echo "<script>swal('删除成功!','','success')</script>";
                $_SESSION['adminDeleteOrder'] = !$_SESSION['adminDeleteOrder'];
            }
        }

        if (mysqli_num_rows ($tempResult) != 0) {
            while ($row = mysqli_fetch_assoc ($tempResult)) {
                $bookList = json_decode ($row['detail'], true);
                echo "<div class='pure-u-1-3 animate__animated animate__fadeIn' >";
                $connection -> setTable ('users');
                $tempUsers = $connection -> search ('email', "{$row['appleID']}");
                $connection -> setTable ('book_product');
                $tempUsers = mysqli_fetch_assoc ($tempUsers);
                echo "<div class='pure-g'style='width: 60%;margin: auto;padding-top: 50px'>";

                echo "<div class='pure-u-1-1'>";

                echo "<img src='./avatar/{$tempUsers['avatar']}' style='width: 50px;height: 50px;border-radius: 50%'><div style='margin-top: -38px;margin-left: 60px'><span style='font-weight: bolder;font-size: 120%'>{$tempUsers['name']}</span></div>";
                echo "<div style='margin-left: 100%;margin-top: -37px'><a href='./class&functions/deleteOrder.php?id={$row['num']}' class='Circle icono-cross' style='width:40px;height:40px;background: rgb(202, 60, 60);color: white'></a></div>";
                echo "<br>";
                echo "<br>";
                foreach ((array)$bookList as $value) {
                    $sum += $value['book_value'];
                    $add += 1;
                }
                foreach ((array)$bookList as $value) {
                    echo "<div class='pure-u-1-1' style='text-align: center'>";
                    echo "<img style='width: 200px;height: 200px' src='img/{$value['book_pic']}'>";
                    echo "</div>";
                    echo "<div class='pure-u-1-1' style='padding-top: 15px;text-align: left'>";
                    echo "<div class='pure-u-1-1' style='text-align: center;'>";
                    echo "<span style='font-size: 120%;font-weight: bolder'> 《{$value['book_name']}》<br><br> </span>";
                    echo "<span style='font-size: 100%;font-weight: bolder;color: #626262'> 及另 {$add} 本书 </span>";
                    echo "</div>";
                    echo "</div>";
                    echo "<hr style='border: solid #e5e5e5 1px;margin-top: 30px;margin-bottom: 30px;width: 100%'>";
                    break;
                }


                echo "<div class='pure-u-1-3'>";
                echo "<span>&nbsp;</span>";
                echo "</div>";
                echo "<div class='pure-u-2-3'>";
                echo "<div class='pure-u-1-2' style='text-align: left'>";
                echo "<span style='font-size: 120%;font-weight: bolder' > 总计 </span>";
                echo "</div>";
                echo "<div class='pure-u-1-2' style='text-align: right'>";
                echo "<span style='font-size: 120%;font-weight: bolder'>RMB $sum</span><br><br>";
                echo "</div>";
                echo "<hr style='border: solid #e5e5e5 1px;margin-top: 0px;margin-bottom: 20px;width: 100%'>";
                echo "<div class='pure-u-1-2' style='text-align: left'>";
                echo "<span style='font-size: 80%' > 订单序号 </span>";
                echo "</div>";
                echo "<div class='pure-u-1-2' style='text-align: right'>";
                echo "<span style='font-size: 80%'>{$row['num']}</span><br><br>";
                echo "</div>";
                echo "<div class='pure-u-1-2' style='text-align: left'>";
                echo "<span style='font-size: 80%' > 订单日期 </span>";
                echo "</div>";
                echo "<div class='pure-u-1-2' style='text-align: right'>";
                echo "<span style='font-size: 80%'>{$row['orderDate']}</span><br><br>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<div class='pure-u-1-1' style='margin-top: 100px;margin-bottom: 1000px;font-size: 350%;color: #9a9a9a;text-align: center'>暂无订单。</div>";
        }
        //reg

        ?>
    </div>
    <div style="width:100%;text-align: center;background-color: #f6f6f6;margin-top: 100px">
        <a class="pure-menu-heading" href="index.php" style="font-size: 150%;font-weight: bolder">APPLE LIBRARY ©️</a>
    </div>
</div>


</body>
</html>