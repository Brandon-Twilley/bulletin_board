<?php

    DEFINE('DBUSR', 'secretluver');
    DEFINE('DBPW', 'ib4trojans');
    DEFINE('DBHOST', 'localhost');
    DEFINE('DBNAME', 'msgbrd');

    if($dbc = mysql_connect(DBHOST, DBUSR, DBPW)) {
        if(!mysql_select_db(DBNAME)) {
            trigger_error("Could not select database" .mysql_error());
            echo 'Could not select database';
            exit();
        }
    } else {
        trigger_error("Could not connect to MySQL");
        echo 'Could not connect to MySQL';
        exit();
    }

    function escape_data($data) {
        if (function_exists('mysql_real_escape_string')) {
            global $dbc;
            $data = mysql_real_escape_string(trim($data), $dbc);
            $data = strip_tags($data);

        } else {
            $data = mysql_escape_string(trim($data));
            $data = strip_tags($data);
        }

        return $data;
    }
?>