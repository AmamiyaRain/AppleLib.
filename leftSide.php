<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>$Title$</title>
</head>
<body>
<?php
require_once ('class&functions/Class&Functions.php');
$connection = new Connection('book_product');

?>
<div class="pure-menu" style="position: fixed;margin-left: -150px;height: 100%;background-color: #f6f6f6">
    <a class="pure-menu-heading" href="index.php"
       style="font-size: 150%;font-weight: bolder;margin-top: 30px;margin-bottom: 20px">APPLE LIB.</a>
    <div class="pure-menu custom-restricted-width" style="font-size: 130%">
        <ul class="pure-menu-list">
            <?php
            $wenXueResult = $connection -> search ('book_type', '文学类');
            $connection -> printByCondition ($wenXueResult, 'book_name', '文学类');
            $wenXueResult = $connection -> search ('book_type', '童书类');
            $connection -> printByCondition ($wenXueResult, 'book_name', '童书类');
            $wenXueResult = $connection -> search ('book_type', '科普类');
            $connection -> printByCondition ($wenXueResult, 'book_name', '科普类');
            $wenXueResult = $connection -> search ('book_type', '生活类');
            $connection -> printByCondition ($wenXueResult, 'book_name', '生活类');
            ?>
        </ul>
        <ul class="pure-menu-list" style="position:absolute;bottom:100px;width: 180px">
            <ul class="pure-menu-item" style="width: 106px">
                <a href="indexPage.php?page='shopBag'" class="pure-menu-link" style="width: 130%">购物袋</a>
            </ul>

            <?php
            if (isset($_SESSION['isLogin'])) {
                if ($_SESSION['isLogin']) {
                    echo "<li class='pure-menu-item pure-menu-has-children pure-menu-allow-hover'>";
                    echo "<a href='indexUser.php' class='pure-menu-link' style='width: 130%'>{$_SESSION['nowUser']['userName']}</a>";
                    echo "<ul class='pure-menu-children'>";
                    echo "<li class='pure-menu-item '>";
                    echo "<a href='indexOrder.php' class='pure-menu-link'>&nbsp;&nbsp;订单&nbsp;&nbsp;</a>";
                    echo "</li>";
                    echo "<li class='pure-menu-item '>";
                    echo "<a href='./class&functions/unLog.php' class='pure-menu-link'>&nbsp;&nbsp;注销&nbsp;&nbsp;</a>";
                    echo "</li>";
                    echo "</ul>";
                    echo "</li>";
                }
            } else {
                ?>
                <ul class="pure-menu-item" style="width: 106px">
                    <a href="indexLog.php?log=true" class="pure-menu-link" style="width: 130%">登录</a>
                </ul>
                <?php
            }
            ?>
        </ul>
    </div>
</div>
</body>
</html>