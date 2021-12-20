<!doctype html>
<html lang="en" class="no-js">
<head>
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
    if (isset($_SESSION['isLoginAdmin']))
        include_once ('adminLeftSide.php');
    else
        include_once ('leftSide.php')
    ?>

    <div style="margin-left: 30px">
        <div class="pure-g" style="margin: auto;width: 70%;margin-bottom: 800px">
            <?php
            echo "<div class='pure-u-1-2'>";
            echo "<div class='pure-u-1-1' style='margin-top: 100px;margin-bottom: 30px'><img style='width: 250px;height: 250px;border-radius:50%' src='./avatar/{$_SESSION['nowUser']['userAvatar']}'>";
            ?>
            <form name="fm1" method="post" action="uploadDemo.php" enctype="multipart/form-data" class="pure-form">
                <div style="margin-left: 180px;margin-top: -50px">
                    <input type="file" name="upload" id="file-5" class="inputfile inputfile-4"
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
                echo "<div class='pure-u-1-1' style='margin-top: 0px;margin-bottom: 30px'>";
                echo "<span style='font-size: 250%;font-weight: bolder'>{$_SESSION['nowUser']['userName']}，</span><span style='font-size: 250%'>你好。</span>";
                echo "</div>";
                echo "<div class='pure-u-1-1' style='margin-bottom: 30px'>";
                echo "<span style='font-size: 150%;color: #9a9a9a'>{$_SESSION['nowUser']['userEmail']}</span>";
                echo "</div>";
                echo "</div>";
                echo "<div class='pure-u-1-2'>";
                ?>
                <div style="margin-top: 110px">
                    <div class="pure-u-1-1" style="text-align: center;margin: 10px 0">
                        <input type="text" name="name"
                               style="width: 400px;height: 50px"
                               placeholder="更改姓名" value="<?php echo $_SESSION['nowUser']['userName'] ?>">
                    </div>
                    <div class="pure-u-1-1"
                         style="text-align: center;margin-top: 5px;margin-bottom:50px;font-size: 100%;color: #9a9a9a;">
                        <span style="margin-left: -220px">这里是我们对您的称呼。<span>
                    </div>
                    <div class="pure-u-1-1" style="text-align: center;margin: 10px 0">
                        <input type="password" name="psd" style="width: 400px;height: 50px" placeholder="更改密码"
                               value="<?php echo $_SESSION['nowUser']['userPsd'] ?>">
                    </div>
                    <div class="pure-u-1-1" style="text-align: center;margin: 10px 0">
                        <input type="password" name="psd_C" style="width: 400px;height: 50px"
                               placeholder="确认密码" value="<?php echo $_SESSION['nowUser']['userPsd'] ?>">
                    </div>
                    <div class="pure-u-1-1"
                         style="text-align: center;margin-top: 5px;margin-bottom:50px;font-size: 100%;color: #9a9a9a;">
                        <span style="margin-left: -240px">请妥善保管您的密码。<span>
                    </div>
                    <div class="pure-u-1-1" style="text-align: center;margin: 10px 0">
                        <input class="pure-button pure-button-primary" type="submit" name="bt" value="更新信息"
                               style="width: 400px;height: 50px">
                    </div>
                </div>
                <?php
                echo "</div>";
                if (isset($_SESSION['tempUploadSuccess'])) {
                    if ($_SESSION['tempUploadSuccess']) {
                        echo "<script>swal('修改成功','','success')</script>";
                        $_SESSION['tempUploadSuccess'] = !$_SESSION['tempUploadSuccess'];
                    }
                }
                if (isset($_SESSION['tempUploadWrongPsd'])) {
                    if ($_SESSION['tempUploadWrongPsd']) {
                        echo "<script>swal('密码不一致','','error')</script>";
                        $_SESSION['tempUploadWrongPsd'] = !$_SESSION['tempUploadWrongPsd'];
                    }
                }

                ?>
        </div>
        <div style="width:100%;text-align: center;background-color: #f6f6f6;margin-top: 100px">
            <a class="pure-menu-heading" href="index.php" style="font-size: 150%;font-weight: bolder">APPLE LIBRARY
                                                                                                      ©️</a>
        </div>
    </div>


</body>

</html>