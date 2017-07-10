<?php
include('../../functions.php');

$BOARD_NUMBER = 3;


?>

<html>
<head>
    <title>Sample Board</title>
    <link rel="stylesheet" href="/style/style.css">
    <link rel="stylesheet" type="text/css" href="/css/home.css">
</head>
<!--
    BEGINNING OF NEW WEBPAGE
-->
<body>

    <div id="doc">
<?php


    $boards = get_board_data();
    $board = $boards[$BOARD_NUMBER];
    title_box('/'.$board->url.' -> '.$board->topic, $board->banner_url);

    echo '<br><hr><br><div id="thread-container">';

    if(!isset($_GET['thread'])) {
        post_form();

        echo '<hr><br>';

        //START POSTING THREAD HEADERS:
        $a = get_threads('tech');

        for($i = 0;$i<count($a); $i++) {

            thread_prev($a[$i]->title, $a[$i]->post_count, $a[$i]->description, $a[$i]->name,'?thread='.$a[$i]->number);
        }
    } else {
        $a = get_threads('tech');
        reply_form($_GET['thread']);
        echo '<br>';


        for($i = 0;$i < count($a); $i++) {
            if ($a[$i]->number == $_GET['thread']) {
                post($a[$i]->name, $a[$i]->timestamp, $a[$i]->number , $a[$i]->description);
                
                $conn = new mysqli(DBHOST, DBUSR, DBPW, DBNAME);
                $sql = 'SELECT mess_id, name, message_text, time FROM tech_'.$_GET['thread'];
                $results = $conn->query($sql);
                
                $conn->close();
                
                if($results->num_rows > 0) {
                    while($row = $results->fetch_assoc()) {
                        post($row['name'], $row['time'], $row['mess_id'], $row['message_text']);
                    }
                }
                
            }
        }
    }



    echo'</div>';

    //END POSTING THREAD HEADERS.

?>
    </div>
</div>
<?php
    footer();
?>
</body>
</html>