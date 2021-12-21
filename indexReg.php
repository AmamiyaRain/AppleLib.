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
        if (isset($_GET['reg'])) {
            ?>
            <div class="pure-g  animate__animated animate__fadeIn" style="margin: auto;width: 70%;margin-bottom: 800px">
                <form name="fm1" method="post" action="indexReg.php?reg=true" class="pure-form">
                    <div class="pure-u-1-1"
                         style="font-size: 250%;text-align: center;margin-top: 30px ;margin-bottom: 10px">
                        创建您的 Apple ID
                    </div>
                    <div class="pure-u-1-1" style="font-size: 100%;color: #9a9a9a;text-align: center;margin: 10px 0">
                        只需一个 Apple ID，您即可访问 Apple 所有内容。
                    </div>
                    <div class="pure-u-1-1" style="text-align: center;margin: 10px 0">
                        <input type="text" name="name"
                               style="width: 400px;height: 50px"
                               placeholder="姓名">
                    </div>
                    <div class="pure-u-1-1" style="text-align: center;margin: 10px 0">
                        <input type="email" name="email" style="width: 400px;height: 50px" placeholder="User@temp.com">
                    </div>
                    <div class="pure-u-1-1" style="text-align: center;margin: 5px 0;font-size: 100%;color: #9a9a9a;">
                        <span style="margin-left: -220px">这将是您的新 Apple ID。<span>
                    </div>
                    <div class="pure-u-1-1" style="text-align: center;margin: 10px 0">
                        <input type="password" name="psd" style="width: 400px;height: 50px" placeholder="密码">
                    </div>
                    <div class="pure-u-1-1" style="text-align: center;margin: 10px 0">
                        <input type="password" name="psd_C" style="width: 400px;height: 50px"
                               placeholder="确认密码">
                    </div>
                    <div class="pure-u-1-1" style="text-align: center;margin: 10px 0">
                        <input class="pure-button pure-button-primary" type="submit" name="subb" value="注册"
                               style="width: 400px;height: 50px">
                    </div>

                </form>
            </div>
            <?php
            if (isset($_POST['subb'])) {
                //判断是否输入了所有表单元素
                if ($_POST['name'] == null || $_POST['psd'] == null || $_POST['email'] == null) {
                    echo "<script>swal('请输入所有元素！','','error')</script>";
                    return;
                }
                //生成Connection对象
                $arr = [ 'name' => $_POST['name'], 'psd' => $_POST['psd'], 'email' => $_POST['email'],'avatar'=>'test.jpg','isAdmin'=>0 ];
                var_dump ($arr);
                //如果密码相等则进行下一步
                if (strcmp ($_POST['psd'], $_POST['psd_C']) == 0) {
                    //若无重复email项
                    $connection -> setTable ("users");
                    if ($connection -> judge ('email', $_POST['email'])) {
                        //则插入账户
                        $connection -> insert ($arr);
                        echo "<script>swal('注册成功！','','success')</script>";
                    } else
                        //否则弹出提示
                        echo "<script>swal('本邮箱地址已被注册！','','error')</script>";
                } //若密码不相等弹出提示
                else
                    echo "<script>swal('两次密码输入不相同，请重新输入。','','error')</script>";
            }


            ?>

            <?php
        }
        ?>
    </div>
    <div style="width:100%;text-align: center;background-color: #f6f6f6;margin-top: 100px">
        <a class="pure-menu-heading" href="index.php" style="font-size: 150%;font-weight: bolder">APPLE LIBRARY ©️</a>
    </div>
</div>


</body>
</html>