<?php
/**
 * Created by PhpStorm.
 * User: JongYoon
 * Date: 2015-07-17
 * Time: 오후 7:27
 */
    //session_set_cookie_params()
    session_start();
    include "/conf/DB_CON.php";
    $visited = isset($_SESSION['visited']) ? $_SESSION['visited'] : null;

    if(isset($_SESSION['login']) && $_SESSION['login']==true){
        echo "<script>alert('Already 로그인 되있어양!!')</script>";
        echo "<script>location.replace('list.php?page=1')</script>";
    }
    /*else{
        session_unset();
        //echo "<script>location.replace('login.php')</script>";
    }*/


    $ID = isset($_POST['ID']) ? $_POST['ID'] : null;
    $PASSWD = isset($_POST['PASSWD']) ? $_POST['PASSWD'] : null;

    //var_dump($ID);
    //echo "<BR>";
    //var_dump($PASSWD);
    if($ID && $PASSWD){
        $conn = DB_conn("login");
        $sql = "select ID from login where ID = '".$ID."'";
        //echo "ID:".$sql."<br>";
        $result = transmit_query($sql);
        $id_search = mysql_num_rows($result);
        //var_dump($id_search);
        if($id_search!=0){
            $sql = "select PASSWD from login where ID = '".$ID."'";
            //echo "PD:".$sql."<br>";
            $result = transmit_query($sql);
            $row = mysql_fetch_array($result);
            if($row['PASSWD'] === $PASSWD){
                $_SESSION['login']=true;
                echo "<script>alert('Login에 성공 했어양!')</script>";
                //세션으로 ID값 전송
                $_SESSION['ID'] = $ID;
                echo "<script>location.replace('list.php?page=1')</script>";
            }
            else{
                echo "<script>alert('비밀번호가 틀렸어양!!')</script>";
                session_destroy();
            }
        }
        else{
            echo "<script>alert('해당 아이디가 없다양!!')</script>";
            session_destroy();
        }

    }
    else{
        if($visited){
            //echo "<script>alert('둘다 입력하라양!!')</script>";
            session_destroy();
        }

    }

?>

<html>
    <head>
        <title>Login 해양!</title>
        <style>
            form {
                text-align: center;
            }
        </style>
    </head>

    <body>
        <h2 align="center">Login 창이에양!</h2>

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" autocomplete="off">
            <img src = "http://i.imgur.com/Dzgbp2r.jpg"><br><br>
            ID<input type = "text" name = "ID">
            PD<input type = "password" name = "PASSWD">
            <input type = "hidden" name = mode value = "login">
            <input type = "submit" name = "login" value = "LOGIN">

        </form>
    </body>
</html>
