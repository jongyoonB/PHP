<html>
    <head>
        <title>Li스트</title>
        <style>
            table{
                width: 1200px;
                border-collapse: collapse;

            }
            tr.bg{
                background-color: lightgray;
            }
            th{
                background-color: blanchedalmond;
                width: 150px;
            }
            td, th{
                border : 1px solid;
                text-align: center;
            }
            a{
                text-decoration: none;
                color: black;
            }
            p{
                text-align: center;
            }

            form{
                text-align: center;
            }
        </style>

    </head>

    <body>
        <h2 align="center">글 Li스트</h2>
        <table align="center">
            <th>글 번호</th>
            <th>제목</th>
            <th>작성자</th>
            <th>조회수</th>
            <th>작성 일자</th>
            <tr>
                <?php


                    include "/conf/DB_CON.php";

                    $per_page = 5;
                    $current_p = isset($_GET['page']) ? $_GET['page'] : null;
                    $keyword = isset($_GET['keyword']) ? $_GET['keyword']  :  null;

                    $conn = DB_conn(DB_NAME);

                    if($keyword){
                        $sql = "select * from " . TABLE_NAME . " where subject like '%" . $keyword . "%' or contents like '%" . $keyword . "%'";
                        $num_page=get_row($sql);
                        if($num_page==0){
                            echo "<script> alert('검색 결과가 없어양!')</script>";
                            $num_page=1;
                        }
                        else{
                            echo "<script> alert('검색 결과는 ".$num_page."개양!')</script>";
                        }
                        $sql .=" limit " . (($current_p - 1) * $per_page) . "," . $per_page;
                        //echo $sql;
                    }
                    else {
                        $sql = "select * from " . TABLE_NAME;
                        $num_page=get_row($sql);
                        $sql .=" limit " . (($current_p - 1) * $per_page) . "," . $per_page;
                    }
                    $result = transmit_query($sql);


                    $num_page = ($num_page % $per_page ==0) ? floor($num_page / $per_page) : floor($num_page / $per_page) +1;

                    $start_p = ($current_p % 10 !=0) ? floor($current_p / 10)*10 +1 : floor(($current_p-1) / 10)*10 + 1;
                    $end_p = ($start_p+9 < $num_page) ? $start_p + 9 : $num_page;

                    if($current_p > $num_page){
                        //echo "<script>location.replace('list.php?page=1')</script>";
                    }

                    /*$count = ($current_p)-5;
                    for($Index_i = 0 ; $Index_i < $current_p ; $Index_i ++){
                        $count += 5;
                    }
                    if($current_p!=1){
                        $count --;
                    }*/

                    while($row = mysql_fetch_array($result)){
                        $pid = $row['board_id'];
                        echo "<tr>";
                        echo "<td>$pid</td>";
                        echo "<td><a href = view.php?page=".$current_p."&pid=".$pid."&keyword=$keyword>".$row['subject']."</a></td>";
                        echo "<td>$row[user_name]</td>";
                        echo "<td>$row[hits]</td>";
                        echo "<td>$row[reg_date]</td>";
                        echo "</tr>";
                        //$count ++;
                    }

                ?>

        </table>

        <form action="search.php?page=1" method="post">
            <br>검색 : <input type="text" name="keyword">
            <input type="hidden" name = "mode" value="search">
            <input type="submit" name = "search" value="검색">
            &nbsp&nbsp&nbsp&nbsp<a href = write.php?page=<?php echo $current_p ?>>글 쓰기</a><br><br>

            <?php

                //echo "<br>".$start_p."<br>";
                //echo $end_p."<br>";

                $url = $_SERVER['PHP_SELF']."?page=";

                if($start_p == 1){
                    echo "☜ ";
                }
                else{
                    echo "<a href = ".$url.($start_p-10).">☜ </a>";
                }

                if($current_p==1){
                    echo "◀ ";
                }
                else{
                    echo "<a href = ".$url.($current_p-1).">◀ </a>";
                }
                if(!$keyword) {

                    for ($Index_i = $start_p; $Index_i <= $end_p; $Index_i++) {
                        echo "<a href = ".$url.$Index_i.">&nbsp$Index_i&nbsp</a>";
                    }
                }

                else{
                    for ($Index_i = $start_p; $Index_i <= $end_p; $Index_i++) {
                        echo "<a href = ".$url.$Index_i."&keyword=".$keyword.">&nbsp$Index_i&nbsp</a>";
                    }
                }

                if($current_p==$num_page){
                    echo " ▶";
                }
                else{
                    echo "<a href = ".$url.($current_p+1)."> ▶</a>";
                }

                if($end_p+1>$num_page){
                    echo " ☞";
                }
                else{
                    echo "<a href = ".$url.($end_p+1)."> ☞</a>";
                }

            ?>
            <script>
                function out(){
                    <?php
                        session_start();
                        session_destroy();

                    ?>
                    alert("LOGOUT 됬어양!");
                    location.replace("login.php");
                }
            </script>
            <br><br><input type = "button" id="logout" onclick="out()" value="LOGOUT">
        </form>


    </body>
</html>
