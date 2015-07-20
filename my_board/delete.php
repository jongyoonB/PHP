<?php
/**
 * Created by PhpStorm.
 * User: JongYoon
 * Date: 2015-07-16
 * Time: 오후 6:30
 */
include "/conf/DB_CON.php";

$pid = isset($_GET['pid']) ? $_GET['pid'] : null;
$page = isset($_GET['page']) ? $_GET['page'] : null;

$info['mode'] = isset($_POST['mode']) ? $_POST['mode'] : null;

if($info['mode'] === "delete") {
    echo "<script> alert('지웠어양!')</script>";
    $conn = DB_conn(DB_NAME);
    $sql = "delete from " . TABLE_NAME . " where board_id = ". $pid;
    //echo $sql."<br>";
    $result = transmit_query($sql);
    $url = "list.php?page=".$page;
    //echo $url."<br>";
    echo "<script>location.replace('$url')</script>";
}

?>


<html>
    <head>
        <title>지웡!</title>
    </head>

    <body>
        진짜 삭제할꺼양?
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <input type = "hidden" name = "mode" value="delete">
            <input type = "submit" name = "delete" value="삭제">
            <input type = "button" onClick="click_bt()" value="취소">
        </form>


    <script>
        function click_bt(){
            alert('취소 했어양!');
            location.replace("view.php?page=<?php echo $page ?>&pid=<?php echo $pid ?>");
        }
    </script>
    </body>
</html>