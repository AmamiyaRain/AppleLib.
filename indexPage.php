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
    include_once ('leftSide.php')
    ?>


    <div style="margin-left: 30px">
        <?php
        if (!isset($_SESSION['temp']))
            $_SESSION['temp'] = false;
        if (!isset($_SESSION['tempClear']))
            $_SESSION['tempClear'] = false;
        if (isset($_GET['page'])) {
            $sum       = 0;
            $tempJudge = false;

            if (isset($_SESSION['book_list'])) {
                $bookList  = $_SESSION['book_list'];
                $tempJudge = true;
            }
            if ($tempJudge&&$_SESSION['isLogin']) {
                echo "<div class='pure-g'style='width: 60%;margin: auto;padding-top: 50px'>";
                foreach ((array)$bookList as $value) {
                    echo "<div class='pure-u-1-5' style=''>";
                    echo "<img class='pure-img'style='width: 100%;height: 100%' src='img/{$value['book_pic']}'>";
                    echo "</div>";
                    echo "<div class='pure-u-4-5' style='padding-top: 15px;text-align: left'>";
                    echo "<div class='pure-u-1-3'>";
                    echo "<span style='font-size: 150%;font-weight: bolder'> 《{$value['book_name']}》<br><br> </span>";
                    echo "<span style='font-size: 120%;font-weight: bolder;color: #626262'> &nbsp;&nbsp;{$value['book_writer']} </span>";
                    echo "</div>";
                    echo "<div class='pure-u-1-3'>";
                    echo "<button class='pure-button' onclick='window.location.href=\"./class&functions/updatecart.php?id={$value['book_id']}&num=-1\"'>-</button>";
                    echo '<button class="pure-button " style="pointer-events: none">' . $value['num'] . '</button>';
                    echo "<button class='pure-button' onclick='window.location.href=\"./class&functions/updatecart.php?id={$value['book_id']}&num=1\"'>+</button>";
                    echo "</div>";
                    echo "<div class='pure-u-1-3'>";
                    echo "<span style='font-size: 150%;font-weight: bolder'>RMB " . ($value['book_value'] * $value['num']) . "</span><br><br>";
                    if ($_SESSION['tempClear'] != null) {
                        if ($_SESSION['tempClear']) {
                            echo "<script>swal('成功删除一件商品!','','success')</script>";
                            $_SESSION['tempClear'] = !$_SESSION['tempClear'];
                        }
                    }
                    echo "<a class='pure-button' href='./class&functions/clear.php?id={$value['book_id']}' style='color: #626262;font-size: 80%'>删除</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "<hr style='border: solid #e5e5e5 1px;margin-top: 30px;margin-bottom: 30px;width: 100%'>";
                    $sum += $value['book_value'] * $value['num'];
                }
                echo "<div class='pure-u-1-3'>";
                echo "<span>&nbsp;</span>";
                echo "</div>";
                echo "<div class='pure-u-2-3'>";
                echo "<div class='pure-u-1-2' style='text-align: left'>";
                echo "<span style='font-size: 100%' > 小计 </span>";
                echo "</div>";
                echo "<div class='pure-u-1-2' style='text-align: right'>";
                echo "<span style='font-size: 100%'>RMB $sum</span><br><br>";
                echo "</div>";
                echo "<div class='pure-u-1-2' style='text-align: left'>";
                echo "<span style='font-size: 100%' > 运费 </span>";
                echo "</div>";
                echo "<div class='pure-u-1-2' style='text-align: right'>";
                echo "<span style='font-size: 100%'>RMB 0</span><br>";
                echo "</div>";
                echo "<hr style='border: solid #e5e5e5 1px;margin-top: 30px;margin-bottom: 30px;width: 100%'>";
                echo "<div class='pure-u-1-2' style='text-align: left'>";
                echo "<span style='font-size: 150%;font-weight: bolder' > 总计 </span>";
                echo "</div>";
                echo "<div class='pure-u-1-2' style='text-align: right'>";
                echo "<span style='font-size: 150%;font-weight: bolder'>RMB $sum</span><br><br>";
                echo "</div>";
                echo "<div class='pure-u-1-2' style='text-align: left'>";
                echo "<span style='font-size: 100%' > 每月分期付款 </span>";
                echo "</div>";
                echo "<div class='pure-u-1-2' style='text-align: right'>";
                echo "<span style='font-size: 100%'>每月RMB " . (round ($sum / 24)) . "(0%费率 24个月)</span><br><br><br>";
                echo "</div>";
                echo "<div class='pure-u-1-1' style='text-align: right'>";
                if (isset($_SESSION['orderTemp'])) {
                    if ($_SESSION['orderTemp']) {
                        echo "<script>swal('订单已生成','','success')</script>";
                        $_SESSION['orderTemp'] = !$_SESSION['orderTemp'];
                    }
                }
                echo "<a href='./class&functions/insertOrder.php' class='pure-button pure-button-primary' style='font-size: 150%;width: 300px'>结账</a>";
                echo "</div>";
                echo "</div>";
            } else {
                if (isset($_SESSION['orderTemp'])) {
                    if ($_SESSION['orderTemp']) {
                        echo "<script>swal('订单已生成','','success')</script>";
                        $_SESSION['orderTemp'] = !$_SESSION['orderTemp'];
                    }
                }
                echo "<div class='pure-u-1-1' style='margin-top: 100px;margin-bottom: 1000px;font-size: 350%;color: #9a9a9a;text-align: center'>您的购物袋是空的。</div>";
            }
        } //reg

        ?>
    </div>
    <div style="width:100%;text-align: center;background-color: #f6f6f6;margin-top: 100px">
        <a class="pure-menu-heading" href="index.php" style="font-size: 150%;font-weight: bolder">APPLE LIBRARY ©️</a>
    </div>
</div>


</body>
</html>