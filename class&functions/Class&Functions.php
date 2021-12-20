<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>$Title$</title>
    <link rel="stylesheet" href="../css/my.css">
    <link rel="stylesheet" href="../css/icon.css">


    <style>
        td {
            font-weight: bold;
        }

        th {
            font-weight: bold;
        }
        .a:link {
            text-decoration: none;
            color: #069;
        }

        .a:visited {
            color: #00f;
        }

        .a:hover {
            color: #f60
        }

        .a:active {
            color: #c09
        }
    </style>
    <script type="text/javascript" src="../script/myScript.js"></script>
</head>
<body>
<?php
require_once ('Configs.php');

class Connection
{
//mysql链接属性
    var $link;

//mysql表单名称
    var $table;

    /**
     * @return mixed
     */
    public function getLink ()
    {
        return $this -> link;
    }

//构造函数
    public function __construct ( $table )
    {
        $this -> table = $table;
        //调用链接函数
        $this -> connect ();
        session_start ();
    }

//改变目前操作的表名
    public function setTable ( $table )
    {
        $this -> table = $table;
    }


//连接函数
    public function connect ()
    {
        //DB_NAME 更改操作表单
        $this -> link = mysqli_connect (HOST, HOSTNAME, PWD) or die(mysqli_error ($this -> link));
        mysqli_select_db ($this -> link, DB_NAME) or die(mysqli_error ($this -> link));
        mysqli_set_charset ($this -> link, DB_CHAR);
    }


//返回result内行数（用于判断是否为空，可靠性极高）
    public function getCount ( $result )
    {
        //返回result内行数
        return mysqli_num_rows ($result);
    }

    //按条件查询
    public function search ( $type, $where )
    {
        $sql = "SELECT * FROM $this->table WHERE `$type`='$where'";

        return mysqli_query ($this -> link, $sql);
    }

    //查询表内所有数据
    public function searchEveryThing ()
    {
        $sql = "SELECT * FROM $this->table";
        return mysqli_query ($this -> link, $sql);
    }

    //第一题右侧列表菜单打印
    public function printByCondition ( $result, $type, $where )
    {
        ?>
        <ul class="pure-menu-list">
            <li class="pure-menu-item">
                <?php
                echo "<li class='pure-menu-item pure-menu-has-children pure-menu-allow-hover'>";

                echo "<a href='indexType.php?type={$where}' id='menuLink1' class='pure-menu-link' >$where</a>";
                //打印搜索结果内shopname
                  echo "<ul class='pure-menu-children'>";
                while ($arr = mysqli_fetch_array ($result)) {
                    echo "<li class='pure-menu-item '>";
                    echo "<a href='./indexID.php?id={$arr['book_id']}' class='pure-menu-link'>$arr[$type]</a>";
                    echo "</li>";
                }
                echo "</ul>";
                echo "</li>";

                ?>
            </li>
        </ul>
        <?php
    }

    public function printByConditionAdmin ( $result, $type, $where )
    {
        ?>
        <ul class="pure-menu-list">
            <li class="pure-menu-item">
                <?php
                echo "<li class='pure-menu-item pure-menu-has-children pure-menu-allow-hover'>";

                echo "<a href='adminType.php?type={$where}' id='menuLink1' class='pure-menu-link' >$where</a>";
                //打印搜索结果内shopname
                echo "<ul class='pure-menu-children'>";
                while ($arr = mysqli_fetch_array ($result)) {
                    echo "<li class='pure-menu-item '>";
                    echo "<a href='./adminID.php?id={$arr['book_id']}' class='pure-menu-link'>$arr[$type]</a>";
                    echo "</li>";
                }
                echo "</ul>";
                echo "</li>";

                ?>
            </li>
        </ul>
        <?php
    }


    public function printByConditionRightSide ( $result )
    {
        //以表格+div块来打印 一行两件商品四个块
        while ($arr = mysqli_fetch_array ($result)) {
            echo "<div class='pure-u-1-4' style='text-align: center;height: 450px;margin-top: 30px' >";
            echo "<div class='pure-u-1-1'  style='height:80%;text-align: center'>";
            echo "<a href='./indexID.php?id={$arr['book_id']}'><img src='./img/$arr[book_pic]'  style='text-align:center;width: 300px;height: 300px;margin: 20px 0' alt=''></a>";
            echo "</div>";
            echo "<a href='./indexID.php?id={$arr['book_id']}' class='pure-menu-link'>";
            echo "<div class='pure-u-1-1' style='height: 20%'>";
            echo "<span  style='font-size: 150%;color: #626262;width: 100%'>" .'《'. $arr['book_name'] .'》'. '</span>'.'</br>.</br>';
            echo '<span style="font-size: 150%;color: #626262;width: 100%">' . ' RMB ' . $arr['book_value'] . '</span>';
            echo "</div>";
            echo '</a>';
            echo "</div>";
        }
    }


    public function printByConditionRightSideAdmin ( $result )
    {
        //以表格+div块来打印 一行两件商品四个块
        while ($arr = mysqli_fetch_array ($result)) {
            echo "<div class='pure-u-1-4' style='text-align: center;height: 450px;margin-top: 30px;margin-bottom: 30px' >";
            echo "<div class='pure-u-1-1'  style='height:80%;text-align: center'>";
            echo "<a href='./adminID.php?id={$arr['book_id']}'><img src='./img/$arr[book_pic]'  style='text-align:center;width: 300px;height: 300px;margin: 20px 0' alt=''></a>";
            echo "<div style='margin-left: -240px;margin-top:-340px'><a href='./class&functions/delete.php?id={$arr['book_id']}' class='Circle icono-cross' style='width:40px;height:40px;background: rgb(202, 60, 60);color: white'></a></div>";
            echo "</div>";
            echo "<div class='pure-u-1-1' style='height: 20%'>";
            echo "<form class='pure-form' action='#' method='post'>";
            echo "<input  name='adminName'type='text' style='font-size: 150%;color: #626262;width: 75%;height: 45px;text-align: center' value='《{$arr['book_name']}》'></br>";
            echo "<input  name='adminID'type='text' style='visibility: hidden;height: 0' value='{$arr['book_id']}'></br>";
            echo "<input  name='adminValue'type='text' style='font-size: 150%;color: #626262;width: 75%;height:45px;margin-top: -13px;text-align: center' value='RMB {$arr['book_value']}'><br><br>";
            echo "<div style='margin-left: 245px;margin-top:-170px'><input type='submit' name='adminChangeSub'href='#' class=' material-icons' style='cursor:pointer;border:none;width:35px;height:35px;background: rgb(86,202,60);color: white;border-radius: 50%' value='done'></div>";
            echo "</form>";
            echo "</div>";
            echo "</div>";

        }
    }
    //翻页函数
    public function page ( $nowPage, $result )
    {
        $temp = mysqli_fetch_all ($result);
        //当前页面
        $totalData  = $this -> getCount ($result);//总记录数
        $pageSize   = 3;//每页显示的数量
        $count_page = ceil ($totalData / $pageSize);//总页数
        //每页第一条记录
        $start = ($nowPage - 1) * $pageSize + 1;
        //判断非法情况
        if ($start > $totalData)
            return false;
        if ($start < 0)
            return false;
        //每页最后一条记录
        $end = $start + $pageSize - 1;
        //按要求输出
        echo "<table class='pure-table' style='width: 100%;margin: 25px auto auto;'>";
        echo "<captain style='color:#595959;font-weight: bolder;font-size: 200%'> 商品信息 </captain>";
        echo "<tr style='color:dimgray;font-size: 130%'><th>商品ID</th><th style='width: 40%'>商品名称</th><th>商品类别</th><th>添加日期</th></tr>";
        for ($i = $start; $i <= $end && $i <= $totalData; $i++) {
            echo "<tr><td>{$temp[$i-1][0]}</td><td><a class='a' href='Item.php?id={$temp[$i-1][0]}'>{$temp[$i-1][1]}</td><td>{$temp[$i-1][2]}</td><td>{$temp[$i-1][7]}</td></tr>";
        }
        //补空格美化
        if ($nowPage * $pageSize > $totalData) {
            for ($i = 0; $i < $nowPage * $pageSize - $totalData; $i++)
                echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
        }
        echo "</table>";

        //下方边栏打印 采用div块级+按钮布局
        //打印有几条记录
        echo "<div class='pure-g' style='margin-top: 20px'>";
        echo "<div class='pure-u-1-4' style='font-size: 80%;color: #9a9a9a;font-weight: bold;margin-top: 2px'>";
        echo "共{$totalData}条记录";
        echo "</div>";
        //打印有几页数据
        echo "<div class='pure-u-1-4' style='font-size: 80%;color: #9a9a9a;font-weight: bold;margin-top: 2px'>";
        echo "第{$nowPage}页/总{$count_page}页";
        echo "</div>";
        //首页按钮
        echo "<div class='pure-u-1-8'>";
        if ($nowPage != 1)
            echo "<a href='Question_2_Main_Page.php?page=1' class='pure-button' style='width: 100%'>首页</a>";
        else
            echo "<a href='#' class='pure-button pure-button-disabled'style='width: 100%'>首页</a>";
        echo "</div>";
        //上一页按钮
        echo "<div class='pure-u-1-8'>";
        if ($nowPage != 1)
            echo "<a href='Question_2_Main_Page.php?page=".($nowPage-1)."' class='pure-button'style='width: 100%'>上一页</a>";
        else
            echo "<a href='#' class='pure-button pure-button-disabled'style='width: 100%'>上一页</a>";
        echo "</div>";
        //下一页按钮
        echo "<div class='pure-u-1-8'>";
        if ($nowPage != $count_page)
            echo "<a href='Question_2_Main_Page.php?page=".($nowPage+1)."' class='pure-button'style='width: 100%'>下一页</a>";
        else
            echo "<a href='#' class='pure-button pure-button-disabled'style='width: 100%'>下一页</a>";
        echo "</div>";
        //尾页按钮
        echo "<div class='pure-u-1-8'>";
        if ($nowPage != $count_page)
            echo "<a href='Question_2_Main_Page.php?page=".($count_page)."' class='pure-button'style='width: 100%'>尾页</a>";
        else
            echo "<a href='#' class='pure-button pure-button-disabled'style='width: 100%'>尾页</a>";
        echo "</div>";
        echo "</div>";
    }
    public function insert ( $array )
    {
        //合并键生成列名字符串
        $keys       = implode (',', array_keys ($array));
        //合并值生成值名字符串
        $vals       = "'" . implode ("','", array_values ($array)) . "'";
        //生成sql命令
        $sqlCommand = "insert into {$this->table}({$keys})value({$vals})";
        //发送
        mysqli_query ($this -> link, $sqlCommand);
        //返回结果
        return mysqli_affected_rows ($this -> link);
    }

    public function judge ( $type, $target )
    {
        //生成选择字符串
        $sql = "select {$type} from {$this->table} where {$type}='$target'";
        //如果返回值的解析结果为空 则无重复项 可注册 返回true
        if (mysqli_fetch_row (mysqli_query ($this -> link, $sql)) == null)
            return true;
        return false;
    }
}

?>
</body>
</html>