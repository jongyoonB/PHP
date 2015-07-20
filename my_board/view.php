<?php
/**
 * Created by PhpStorm.
 * User: JongYoon
 * Date: 2015-07-16
 * Time: 오후 6:30
 */
    session_start();
    $ID = isset($_SESSION['ID']) ? $_SESSION['ID'] : null;

    include "/conf/DB_CON.php";
    $pid = isset($_GET['pid']) ? $_GET['pid'] : null;
    $page = isset($_GET['page']) ? $_GET['page'] : null;
    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : null;

    $conn = DB_conn(DB_NAME);
    $sql = "select * from ".TABLE_NAME." where board_id = "."$pid";
    //echo $sql;
    $result = transmit_query($sql);
    $row = mysql_fetch_array($result);

    $info['num'] = isset($row['board_id']) ? $row['board_id'] : null;
    $info['subject'] = isset($row['subject']) ? $row['subject'] : null;
    $info['name'] = isset($row['user_name']) ? $row['user_name'] : null;
    $info['date'] = isset($row['reg_date']) ? $row['reg_date'] : null;
    $info['contents'] = isset($row['contents']) ? $row['contents'] : null;
    $info['hits'] = isset($row['hits']) ? $row['hits']+1 : null;
    //var_dump($info);

    $sql = "update ".TABLE_NAME." set hits = '".$info['hits']."' where board_id =".$pid ;
    $result = transmit_query($sql);
?>

<html>
    <head>
        <title>글 내YONG</title>
        <style>
            table{
                width: 1000px;
                border-collapse: collapse;
            }
            tr.bg{
                background-color: lightgray;
            }
            th{
                width: 250px;
            }
            td, th{
                border : 1px solid;
                text-align: center;
            }
            td {
                background: url("http://img2.ruliweb.daum.net/mypi/gup/a/3/35/o/34948076721.jpg") no-repeat;
                background-size: cover;
                font-size: 30px;
                color: #3b30ff;
            }
            a{
                text-decoration: none;
                color: black;
            }
            p{
                text-align: center;
            }
        </style>
    </head>

    <body>
        <table align="center">
            <tr class="bg">
                <th>글번호 : <?php echo $info['num'] ?></th>
                <th>조회수 : <?php echo $info['hits'] ?></th>
                <th>작성자 : <?php echo $info['name'] ?></th>
                <th>작성 일자 : <?php echo $info['date'] ?></th>
            </tr>

            <tr class="bg">
                <th colspan="4"><?php echo $info['subject']?></th>
            </tr>

            <tr>
                <td colspan="4" height="600px"><?php echo $info['contents'] ?></td>
            </tr>
        </table>

        <p>
            <a href = "list.php?page=<?php echo $page ?>&keyword=<?php echo $keyword?>">글 목록&nbsp&nbsp</a>
            <?php
                if($ID){
                    if($ID === "tester"){
                        echo "<a href = modify.php?page=".$page."&pid=".$pid.">글 수정&nbsp&nbsp</a>";
                        echo "<a href = delete.php?page=".$page."&pid=".$pid.">글 삭제</a>";
                    }

                }
            ?>
        </p>
    </body>
</html>
