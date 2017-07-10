<?php
//views of this site

include('functions.php');


    $concurrent_threads = 60;
    $concurrent_posts = 500;

    $topic_array = get_board_data();


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
    title_box('HAIL TO THE KING, BABY', '/home/o2360877.png');

    bulletin('What is [INSERT BULLETIN BOARD NAME]?', $desc, '');
    $res = '';
    for ($i = 0; $i < count($topic_array)-1; $i++) {
        $res = $res.'<li class="boards">'.$topic_array[$i]->link().'</li>';
    }
    bulletin('Boards', $res, 'column-count: 3');

    ?>
</div>
<?php
    footer()
?>
<br class="clear-bug">
</body>
</html>
