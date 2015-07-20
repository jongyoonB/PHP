<?php



include "/conf/DB_CON.php";
$info['mode'] = isset($_POST['mode']) ? $_POST['mode'] : null;
$url = "list.php?page=1";
if($info['mode'] === "write"){
    echo "<script> alert('글 썼어양!')</script>";
    $info['id'] = isset($_POST['id']) ? $_POST['id'] : null;
    $info['name'] = isset($_POST['name']) ? $_POST['name'] : null;
    $info['subject'] = isset($_POST['subject']) ? $_POST['subject'] : null;
    $info['contents'] = isset($_POST['contents']) ? $_POST['contents'] : null;
    $info['date'] = date("Y-m-d H:i:s");
    //var_dump($info);

    $conn = DB_conn(DB_NAME);

    $ddl = "insert into ".TABLE_NAME."(user_id, user_name, subject, contents, reg_date)";
    $ddl .= " values('$info[id]','$info[name]', '$info[subject]', '$info[contents]', '$info[date]')";
    echo $ddl."<br>";
    $result = transmit_query($ddl);
    echo "<script>location.href = '$url'</script>";
}

?>




<html>
    <head>
        <title>글써용</title>
        <meta charset="utf-8">
        <script>
            function click(url){
                    location.href = 'url';
            }
        </script>
    </head>

    <body>
        <p><h2 align="middle">글을 써 보아YO</h2></p>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            I&nbsp&nbsp&nbspD   : <input type = "text" name = "id" value="" maxlength="10"><br><br>
            이름 : <input type = "text" name = "name" value="" maxlength="5"><br><br>
            제목 : <input type = "text" name = "subject" value="" maxlength="20"><br><br><br>
            내용 : <br><textarea name = "contents" rows ="10" cols = "28"></textarea><br>
            <input type = "hidden" name = "mode" value="write">
            <input type = "submit" name = "write" value="글 쓰기">
            <input type = "button" id = "cancel" onclick="click(<?php echo $url ?>)" value = "취소">
        </form>
    </body>
</html>
