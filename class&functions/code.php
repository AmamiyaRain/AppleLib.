<?php
session_start ();
// 验证码的宽度
$width = 180;
// 验证码的高度
$height = 50;
// 创建画布
$canvas = imagecreatetruecolor ($width, $height);
// 分配颜色
$backgroundColor = imagecolorallocate ($canvas, 255,
                                       255, 255);
// 填充颜色
imagefill ($canvas, 0, 0, $backgroundColor);
// 准备文本
$letter = 'ABCDEFGHJKMNOPQRSTUVWXYZabcdefghjkmnopqrstuvwxyz';
// 准备文本的长度
$letterLength = strlen ($letter);
//定义验证码的长度
$codeLength = 4;
// 字体大小
$fontSize = 20;  // 字体大小
// 字体样式  (复制字体到文件夹内）
$path     = '../font/msyh.ttf';
$fontFile = realpath ($path);//获取字体的绝对路径
//绘制文字
//居中计算
$center_x = ($width - ($fontSize * $codeLength)) / 2;
$center_y = ($height - $fontSize) / 2;
$string   = '';
for ($i = 0; $i < $codeLength; $i++) {
    $randNum = mt_rand (1, 100000000); // 生成随机数
    //用随机数对长度取余，生成letter范围内（不会超过长度）的随机索引
    $index = $randNum % $letterLength;
    $x     = ($i * $fontSize) + $center_x; // 文字绘制的坐标 x
    $y     = $fontSize + $center_y; // 文字绘制的坐标 y的初值=0
    $angle = mt_rand (-$fontSize, $fontSize); // 角度在字号正负数范围内随机
    // 字体颜色
    $fontColor = imagecolorallocate ($canvas, 120, 120, 120);
// 绘制到图像中
    imagettftext ($canvas, $fontSize, $angle, $x, $y, $fontColor, $fontFile, $letter[$index]);
    $string .= $letter[$index];
}
if (isset($_SESSION['yzm']))
    $_SESSION['preyzm'] = $_SESSION['yzm'];
$_SESSION['yzm'] = strtoupper ($string);


ob_clean ();
// 设置响应头(为了告诉浏览器这是图片)
header ('Content-type: image/jpeg');
// 输出
imagejpeg ($canvas);
// 释放资源
imagedestroy ($canvas);




