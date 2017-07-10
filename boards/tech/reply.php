<?php
include('../../functions.php');


    function reply_thread($name, $subject, $post, $thread) {

        echo 'name: '.$name .' subject: '.$subject.' post: '.$post.' Thread: '.$thread;

        if($name == '') {
            $name = 'anonymous';
        }
        if($subject = '') {
            $subject = 'nil';
        }
        
        $post_count = 0;
        $post_count_file = 'post_count.txt';
        if (file_exists($post_count_file)) {
            $post_count = (int)file_get_contents($post_count_file);
            $post_count++;
        }
        
        $timestamp = date('Y-m-d G:i:s');
        $conn = new mysqli(DBHOST, DBUSR, DBPW, DBNAME);

        $sql = 'INSERT INTO tech_'.$thread.' (mess_id, name, message_text, time) VALUES ("'.$post_count.'", "'.$name.'", "'.$post.'", "'.$timestamp.'")';
        $result = $conn->query($sql);
        
        $conn->close();
        file_put_contents($post_count_file, $post_count);

    }

    reply_thread($_POST['name'], $_POST['sub'] , $_POST['com'], $_GET['thread']);
    header('Location: localhost:8888/boards/tech/?thread='.$_POST['thread']);
    exit();
?>