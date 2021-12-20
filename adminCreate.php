<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <title>Responsive Side Menu &ndash; Layout Examples &ndash; Pure</title>
    <link rel="stylesheet" href="./css/my.css">
    <link rel="stylesheet" href="./css/styles.css">
    <script type="text/javascript" src="./script/myScript.js"></script>
    <script type="text/javascript" src="./script/sweet.js"></script>
    <meta charset="utf-8">
    <title>APPLE LIB.</title>
    <link rel="stylesheet" href="./css/my.css">
    <link rel="stylesheet" href="./css/styles.css">
    <script type="text/javascript" src="./script/myScript.js"></script>
    <script type="text/javascript" src="./script/sweet.js"></script>
    <link rel="stylesheet" type="text/css" href="css/component.css"/>
    <script>(function (e, t, n) {
            var r = e.querySelectorAll("html")[0];
            r.className = r.className.replace(/(^|\s)no-js(\s|$)/, "$1js$2")
        })(document, window, 0);</script>

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

        if (isset($_SESSION['tempCreateSuccess'])) {
            if ($_SESSION['tempCreateSuccess']) {
                echo "<script>swal('添加成功!','','success')</script>";
                $_SESSION['tempCreateSuccess'] = !$_SESSION['tempCreateSuccess'];
            }
        }




        echo "<div style='margin-bottom: 600px'>";
        //按id搜索商品

        echo "<form method='post' action='uploadCreate.php' enctype='multipart/form-data' class='pure-form'>";
        echo "<div class='pure-g'style='width: 60%;margin: auto;padding-top: 50px'>";
        echo "<div class='pure-u-1-2' style='text-align: center'>";
        ?>
        <div style="margin-left: 0px;margin-top: 0">
            <input type="file" name="upload" id="file-5" class="inputfile inputfile-5"
                   data-multiple-caption="{count} files selected" multiple/>
            <label for="file-5" style="text-align: center">
                <figure>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                        <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
                    </svg>
                </figure>
            </label>
        </div>
        <?php
        echo "</div>";
        echo "<div class='pure-u-1-2' style='padding-top: 15px;text-align: left'>";
        echo "<input type='text' name='adminIDChangeName' placeholder='书名' style='font-size: 200%;font-weight: bolder;width: 500px' value=''></input>";
        echo "<hr style='border: solid #e5e5e5 1px;margin-top: 10px;margin-bottom: 10px;width: 100%'>";
        echo "<input type='text' name='adminIDChangeWriter' placeholder='作者' style='font-size: 200%;font-weight: bolder;width: 500px' value=''></input>";
        echo "<hr style='border: solid #e5e5e5 1px;margin-top: 10px;margin-bottom: 10px;width: 100%'>";
        echo "<input type='text' name='adminIDChangeType' placeholder='类型' style='font-size: 200%;font-weight: bolder;width: 500px' value=''></input>";
        echo "<hr style='border: solid #e5e5e5 1px;margin-top: 10px;margin-bottom: 10px;width: 100%'>";

        echo "<textarea name='adminIDChangeIntro'  placeholder='作品详述&#10;第一段&#10;第二段...' style='font-size: 100%;text-indent: 25px;line-height: 30px;width: 500px;height: 170px' ></textarea>";
        echo "<hr style='border: solid #e5e5e5 1px;margin-top: 10px;margin-bottom: 10px;width: 100%'>";
        echo "<input type='text' name='adminIDChangeValue' style='font-size: 200%;font-weight: bolder;width: 500px' placeholder='价格' value=''><br><br></input>";


        echo "<input name='adminIDChangeSub' type='submit' class=' pure-button pure-button-primary'  style='font-size: 150%;margin-top: -5px' value='添加本书'></input>";
        echo "</div>";
        echo "</div>";
        echo "</form>";

        ?>
    </div>
    <div style="width:100%;text-align: center;background-color: #f6f6f6;margin-top: 100px">
        <a class="pure-menu-heading" href="index.php" style="font-size: 150%;font-weight: bolder">APPLE LIBRARY ©️</a>
    </div>
</div>


</body>
</html>