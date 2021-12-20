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
error_reporting(E_ALL^E_NOTICE);
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
        if (isset($_GET['id'])) {
            echo "<div style='margin-bottom: 600px'>";
            $id = $_GET['id'];
            //按id搜索商品
            $result = $connection -> search ('book_id', $id);
            $row    = mysqli_fetch_row ($result);
            //打印 写的略烦琐 主要是为了好看（老师可千万别因为我样式写的多扣分。。。
            echo "<div class='pure-g'style='width: 60%;margin: auto;padding-top: 50px'>";
            echo "<div class='pure-u-1-2' style=''>";
            echo "<img class='pure-img'style='width: 500px;height: 500px;margin-right: 30px' src='img/{$row[6]}'>";
            echo "</div>";
            echo "<div class='pure-u-1-2' style='padding-top: 15px;text-align: left'>";
            echo "<span style='font-size: 250%;font-weight: bolder'>购买 《$row[1]》</span>";
            echo "<hr style='border: solid #e5e5e5 1px;margin-top: 30px;margin-bottom: 30px;width: 100%'>";
            echo "<span style='font-size: 150%;font-weight: bolder'>$row[3]</span>";
            echo "<hr style='border: solid #e5e5e5 1px;margin-top: 30px;margin-bottom: 30px;width: 100%'>";
            echo "<p style='font-size: 100%;text-indent: 25px;line-height: 30px'>$row[5]</p>";
            echo "<hr style='border: solid #e5e5e5 1px;margin-top: 30px;margin-bottom: 30px;width: 100%'>";
            echo "<span style='font-size: 250%;font-weight: bolder'>RMB $row[4]<br><br></span>";
            if ($_SESSION['temp'] != null) {
                if ($_SESSION['temp']) {
                    echo "<script>swal('成功添加一件商品！','','success')</script>";
                    $_SESSION['temp'] = !$_SESSION['temp'];
                }
            }
            if(isset($_SESSION['tempJudgeAddCart'])){
                if(!$_SESSION['tempJudgeAddCart']){
                    echo "<script>swal('请先登录!','','warning')</script>";
                    $_SESSION['tempJudgeAddCart']=!$_SESSION['tempJudgeAddCart'];
                }
            }
            echo "<a class=' pure-button pure-button-primary' href='./class&functions/addcart.php?id={$row[0]}' style='font-size: 150%'>添加购物车</a>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
    <div style="width:100%;text-align: center;background-color: #f6f6f6;margin-top: 100px">
        <a class="pure-menu-heading" href="index.php" style="font-size: 150%;font-weight: bolder">APPLE LIBRARY ©️</a>
    </div>
</div>


</body>
</html>