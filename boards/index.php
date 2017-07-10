<?php
    include("../functions.php");

?>
<html xmlns="http://www.w3.org/1999/xhtml">
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
    <div id="brd">
    <?php

    $board_data = get_board_data();
    for($i = 0;$i<sizeof($board_data);$i++) {
        echo '<a href= "'.$board_data[$i]->url.'" >';
        bulletin($board_data[$i]->topic,$board_data[$i]->header_desc , '');
        echo '</a>';
    }

    ?>
    </div>
</div>
<?php
    footer();
?>
</body>
</html>