
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
$conn = DB_conn(DB_NAME);
$sql = "select * from ".TABLE_NAME." where board_id = "."$pid";
$result = transmit_query($sql);
$row = mysql_fetch_array($result);


$info['mode'] = isset($_POST['mode']) ? $_POST['mode'] : null;
$info['subject'] = isset($row['subject']) ? $row['subject'] : null;
$info['contents'] = isset($row['contents']) ? $row['contents'] : null;
$url = "view.php?page=".$page."&pid=".$pid;

if($info['mode'] === "modify"){

    $info['id'] = isset($row['user_id']) ? $row['user_id'] : null;
    $info['name'] = isset($row['user_name']) ? $row['user_name'] : null;
    $info['subject'] = isset($_POST['subject']) ? $_POST['subject'] : null;
    $info['contents'] = isset($_POST['contents']) ? $_POST['contents'] : null;
    $info['date'] = date("Y-m-d H:i:s");
    //var_dump($info);

    if(!strlen($info['subject']) == 0) {
        $ddl = "update " . TABLE_NAME . " set subject ='" . $info['subject'] . "' , contents = '" . $info['contents'] . "', reg_date = '" . $info['date'] . "' where board_id = " . $pid;
        //echo $ddl."<br>";
        $result = transmit_query($ddl);
        echo "<script> alert('수정 했어양!')</script>";
    }
    else{
        echo "<script> alert('제목은 없으면 안되양!')</script>";
    }
    echo "<script>location.replace('$url')</script>";

}
?>


<html>
<head>
    <title>글써용</title>


</head>

<body>
    <p><h2>글을 고쳐 보아U</h2></p>

    <form action="<?php echo $_SERVER['PHP_SELF']."?page=".$page."&pid=".$pid ?>" method="post">
        제&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp목 : <input type = "text" name = "subject" value="<?php echo $info['subject'] ?>" maxlength="20"><br><br>
        수정일자 : <?php echo date("y-m-d") ?><br><br>
        내용 : <br><textarea name = "contents" rows ="10" cols = "33"><?php echo $info['contents'] ?></textarea><br>
        <input type = "hidden" name = "mode" value="modify">
        <input type = "submit" name = "modify" value="글 수정">
        <input type = "button" id = "cancel" onclick="click_bt('<?php echo $url ?>')" value = "취소">
    </form>


    <script>
        function click_bt(url){
            alert('취소 했어양');
            location.replace(url);

        }
    </script>
</body>
</html>

