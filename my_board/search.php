<?php
/**
 * Created by PhpStorm.
 * User: JongYoon
 * Date: 2015-07-17
 * Time: 오전 3:16
 */
    $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : null;
    $page = isset($_GET['page']) ? $_GET['page'] : null;
    $url = "list.php?page=".$page."&keyword=".$keyword;
    $mode = isset($_POST['mode']) ? $_POST['mode'] : null;
    if($mode ==="search"){
        echo "<script>location.replace('$url')</script>";
    }

?>

