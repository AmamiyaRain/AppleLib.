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
        if (isset($_GET['log'])) {
            ?>
            <div class="pure-g animate__animated animate__fadeIn" style="margin: auto;width: 70%;margin-bottom: 800px" >
                <form name="fm1" method="post" action="indexLog.php?log=true" class="pure-form">
                    <div class="pure-u-1-1" style="margin-top: 50px;margin-bottom: 50px;">
                        <span style="font-size: 250%">请登录。</span>
                    </div>
                    <label>
                        <input type="email" name="email" placeholder="Apple ID"
                               style="margin-bottom: 20px;width: 400px;height: 50px">
                    </label><br>
                    <label>
                        <input type="password" name="psd" placeholder="密码"
                               style="margin-bottom: 20px;width: 400px;height: 50px">
                    </label><br>
                    <div class="pure-u-1-1"><p
                                style="width: 400px;color: #9a9a9a;line-height: 23px;margin-bottom: 20px;height: 50px">
                            你的 Apple ID 是你用来登录 iTunes、App Store 和 iCloud 的电子邮件地址。</p></div>
                    <div class="pure-u-1-1" style="width: 400px">
                        <div class="pure-u-1-2" style="text-align: left">

                            <input type="text" name="code" placeholder="验证码"
                                   style="margin-bottom: 20px;width: 180px;height: 50px">

                        </div>

                        <img src="./class&functions/code.php"/>

                    </div>
                    <br>
                    <input class="pure-button pure-button-primary" type="submit" name="sub" value="登录"
                           style="width: 400px;height: 50px;margin-bottom: 20px"><br>
                    <div class="pure-u-1-1"><a href="indexReg.php?reg=true"
                                               style="text-decoration: none;color: #26719D">没有
                                                                                            Apple
                                                                                            ID？立即创建一个。</a>
                    </div>
                </form>
            </div>
            <?php
            if (isset($_SESSION['tempUnLogAlert'])) {
                if ($_SESSION['tempUnLogAlert']) {
                    echo "<script>swal('注销成功!','','success')</script>";
                    $_SESSION['tempUnLogAlert'] = !$_SESSION['tempUnLogAlert'];
                }
            }


            if (isset($_POST['sub'])) {
                //判断是否输入了所有表单元素
                if ($_POST['email'] == null || $_POST['psd'] == null || $_POST['code'] == null) {
                    echo "<script>swal('请输入所有元素!','','error')</script>";
                    return;
                }
                if ($_SESSION['yzm'] != strtoupper ($_POST['code'])&&$_SESSION['preyzm']!=strtoupper ($_POST['code'])) {
                    echo "<script>swal('验证码错误!','','error')</script>";
                    return;
                }
                //生成Connection对象
                $connection -> setTable ("users");
                $result = $connection -> search ("email", "{$_POST['email']}");
                if (mysqli_num_rows ($result) == 0) {
                    echo "<script>swal('无用户!','','error')</script>";
                    return;
                }
                $value = mysqli_fetch_assoc ($result);
                if ($value['psd'] == $_POST['psd']) {
                    if ($value['isAdmin'] == 0) {
                        $_SESSION['isLogin']               = true;
                        $_SESSION['nowUser']['userName']   = $value['name'];
                        $_SESSION['nowUser']['userEmail']  = $value['email'];
                        $_SESSION['nowUser']['userAvatar'] = $value['avatar'];
                        $_SESSION['nowUser']['userPsd']    = $value['psd'];
                        $_SESSION['nowUser']['userType']   = $value['isAdmin'];
                        echo "<script>swal('登录成功!','','success')</script>";
                        echo "<script>setTimeout(function() {window.location.replace('index.php')
                    },1000)</script>";
                    }else{
                        $_SESSION['isLoginAdmin']               = true;
                        $_SESSION['nowAdmin']['userName']   = $value['name'];
                        $_SESSION['nowAdmin']['userEmail']  = $value['email'];
                        $_SESSION['nowAdmin']['userAvatar'] = $value['avatar'];
                        $_SESSION['nowAdmin']['userPsd']    = $value['psd'];
                        $_SESSION['nowAdmin']['userType']   = $value['isAdmin'];
                        echo "<script>swal('管理员登录成功!','','success')</script>";
                        echo "<script>setTimeout(function() {window.location.replace('admin.php')
                    },1000)</script>";
                    }

                } else {
                    echo "<script>swal('密码错误!','','error')</script>";
                    return;
                }
            }

        }
        ?>
    </div>
    <div style="width:100%;text-align: center;background-color: #f6f6f6;margin-top: 100px">
        <a class="pure-menu-heading" href="index.php" style="font-size: 150%;font-weight: bolder">APPLE LIBRARY ©️</a>
    </div>
</div>


</body>
</html>