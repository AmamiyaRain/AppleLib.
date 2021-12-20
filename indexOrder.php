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
        $sum       = 0;
        $tempJudge = false;

        if (isset($_SESSION['nowUser']['userEmail'])) {
            $connection -> setTable ('orderList');
            $tempResult = $connection -> search ('appleID', $_SESSION['nowUser']['userEmail']);
            $connection -> setTable ('book_product');
        }
        if (isset($tempResult) && mysqli_num_rows ($tempResult) != 0) {
            while ($row = mysqli_fetch_assoc ($tempResult)) {
                $bookList = json_decode ($row['detail'], true);
                echo "<div class='pure-g'style='width: 60%;margin: auto;padding-top: 50px'>";
                foreach ((array)$bookList as $value) {
                    echo "<div class='pure-u-1-5' style=''>";
                    echo "<img class='pure-img'style='width: 80%;height: 80%' src='img/{$value['book_pic']}'>";
                    echo "</div>";
                    echo "<div class='pure-u-4-5' style='padding-top: 15px;text-align: left'>";
                    echo "<div class='pure-u-1-3'>";
                    echo "<span style='font-size: 120%;font-weight: bolder'> 《{$value['book_name']}》<br><br> </span>";
                    echo "<span style='font-size: 100%;font-weight: bolder;color: #626262'> &nbsp;&nbsp;{$value['book_writer']} </span>";
                    echo "</div>";
                    echo "<div class='pure-u-1-3'>";
                    echo "<button class='pure-button' style='pointer-events: none'>&nbsp;</button>";
                    echo '<button class="pure-button " style="pointer-events: none">' . $value['num'] . '</button>';
                    echo "<button class='pure-button' style='pointer-events: none'>&nbsp;</button>";
                    echo "</div>";
                    echo "<div class='pure-u-1-3'>";
                    echo "<span style='font-size: 120%;font-weight: bolder'>RMB " . ($value['book_value'] * $value['num']) . "</span><br><br>";
                    if ($_SESSION['tempClear'] != null) {
                        if ($_SESSION['tempClear']) {
                            echo "<script>swal('成功删除一件商品!','','success')</script>";
                            $_SESSION['tempClear'] = !$_SESSION['tempClear'];
                        }
                    }
                    echo "</div>";
                    echo "</div>";
                    echo "<hr style='border: solid #e5e5e5 1px;margin-top: 30px;margin-bottom: 30px;width: 100%'>";
                    $sum += $value['book_value'] * $value['num'];
                }

//                echo "<div class='pure-u-1-1'>";
//                echo "<span>{$row['num']} {$row['orderDate']}</span>";
//                echo "</div>";
                echo "<div class='pure-u-1-3'>";
                echo "<span>&nbsp;</span>";
                echo "</div>";
                echo "<div class='pure-u-2-3'>";
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
                echo "<span style='font-size: 100%'>每月RMB " . (round ($sum / 24)) . "(0%费率 24个月)</span><br>";
                echo "</div>";
                echo "<hr style='border: solid #e5e5e5 1px;margin-top: 30px;margin-bottom: 30px;width: 100%'>";
                echo "<div class='pure-u-1-2' style='text-align: left'>";
                echo "<span style='font-size: 100%' > 订单序号 </span>";
                echo "</div>";
                echo "<div class='pure-u-1-2' style='text-align: right'>";
                echo "<span style='font-size: 100%'>{$row['num']}</span><br><br>";
                echo "</div>";
                echo "<div class='pure-u-1-2' style='text-align: left'>";
                echo "<span style='font-size: 100%' > 订单日期 </span>";
                echo "</div>";
                echo "<div class='pure-u-1-2' style='text-align: right'>";
                echo "<span style='font-size: 100%'>{$row['orderDate']}</span><br><br>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "<hr style='border: solid #e5e5e5 2px;margin-top: 30px;margin-bottom: 30px;width: 80%'>";
            }
        } else {
            echo "<div class='pure-u-1-1' style='margin-top: 100px;margin-bottom: 1000px;font-size: 350%;color: #9a9a9a;text-align: center'>您暂无订单。</div>";
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