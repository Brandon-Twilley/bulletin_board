<?php
include('../../functions.php');
$thread_count = 0;
$post_count = 0;

$thread_count_file = 'thread_count.txt';
$post_count_file = 'post_count.txt';

if (file_exists($thread_count_file)) {
    $thread_count = (int)file_get_contents($thread_count_file);
}
if (file_exists($post_count_file)) {
    $post_count = (int)file_get_contents($post_count_file);
}

file_put_contents($post_count_file, $post_count);
file_put_contents($thread_count_file, $thread_count);

function post_thread($name, $subject, $post, $board){

    if($name == ''){
        $name = 'anonymous';
    }
    if($subject == '') {
        $subject = 'nil';
    }

    $thread_count = 0;
    $timestamp = date('Y-m-d G:i:s');


    $thread_count_file = 'thread_count.txt';

    if (file_exists($thread_count_file)) {
        $thread_count = (int)file_get_contents($thread_count_file);
        $thread_count++;
    }
        //DETERMINE THE NUMBER OF THREADS AND THE NUMBER OF

        //CONNECT TO MYSQL DATABASE AND POST THREAD TO MYSQL
    $conn = new mysqli(DBHOST, DBUSR, DBPW, DBNAME);
    if ($conn->connect_error) {
        die("Connection failed: ".$conn->connect_error);
    }
    $sql = 'INSERT INTO '.$board.'(title, number, name, description, post_count, timestamp) VALUES ("'.$subject.'", "'.$thread_count.'", "'.$name.'", "'.$post.'", "'.$post_count.'", "'.$timestamp.'")';
    $result = $conn->query($sql);

        //CREATE TEMPORARY TABLES FOR REPLIES TO THE THREAD.
    $sql_replies = 'CREATE TABLE '.$board.'_'.$thread_count.' ( mess_id int(10) unsigned key, name varchar(100), message_text varchar(10000), time timestamp)';
    $result = $conn->query($sql_replies);


    $conn->close();
    file_put_contents($thread_count_file, $thread_count);

}

    post_thread($_POST['name'], $_POST['sub'] , $_POST['com'], 'pol');

    header('Location: localhost:8888/boards/pol/');
    exit();
?>