<?php
/**
 * Created by PhpStorm.
 * User: JongYoon
 * Date: 2015-07-16
 * Time: 오후 6:30
 */
    define("HOST", "localhost");
    define("USER", "root");
    define("PASSWD", "autoset");
    define ("DB_NAME", "yjp_test");
    define ("TABLE_NAME", "board");

    $conf_conn = DB_conn(DB_NAME);
    $conf_result =transmit_query("select * from ".TABLE_NAME);


    function DB_conn($arg_DB_NAME)
    {
        $conn = mysql_connect(HOST, USER, PASSWD);
        if (!$conn) {
            echo "DB Connect Failed";
            exit(-1);
        }
        $db_conn = mysql_select_db($arg_DB_NAME);
        if (!$conn) {
            echo "DB Select Failed";
            exit(-1);
        }

        return $conn;
    }

    function transmit_query($query){

        $result =  mysql_query($query);
        if(!$result){
            echo "Query Error";
        }
        else{
            return $result;
        }
    }

    function get_row($query){
        $result = transmit_query($query);
        if(!$result){
            echo "Query Error";
        }
        else{
            return mysql_num_rows($result);
        }
    }
?>
