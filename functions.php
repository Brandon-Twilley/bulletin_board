<?php
//views of this site
include('config.php');
include('structs.php');

const THREAD_COUNT = 10;


function get_board_data(){
    $conn = new mysqli(DBHOST, DBUSR, DBPW, DBNAME);
    if ($conn->connect_error) {
        die("Connection failed: ".$conn->connect_error);
    }
    $sql = "SELECT topic_id, topic, url, banner_url, header_desc FROM topics";
    $result = $conn->query($sql);
    $topic_array = array();
    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $a = new boards();
            $a->topic = $row["topic"];
            $a->topic_id = $row["topic_id"];
            $a->url = $row["url"];
            $a->banner_url = $row["banner_url"];
            $a->header_desc = $row["header_desc"];
            //$a->threads = $row["threads"];

            array_push($topic_array, $a);
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    
    return $topic_array;
}

$desc = '[BULLETIN BOARD NAME] is a bulletin board that was made for php, mysql, javascript, jquery, html, and css practice.  NOW GET OUT NORMIES REEEEEEEEE';

function bulletin($title, $text, $style) {

    $entire = '
    <div id="bd">
        <div class="box-outer" id="announce">
            <div class="box-inner">
                <div class="boxbar">
                    <h2>'.$title.'</h2>
                </div>
                <div class="boxcontent" style="'.$style.'">
                    <div id="wot-cnt"><p>'.$text.'</p></div>
                </div>
            </div>
        </div>
    </div>';

    echo $entire;
}

function upper_bar() {
    $upper = '
<div class="upper-bar">
    <div class="pages">Previous [ <a class="selected">1</a> / <a href="/Δ/2.html">2</a> ]
        <form action="/Δ/2.html" method="get">
            <input type="submit" class="btn" value="Next">
        </form> | <a href="/Δ/catalog.html">Catalog</a>

        <form id="search" onsubmit="return rmdoc();" class="search">
            <input type="submit" id="searchbtn" class="btn" value="Send">
            <input type="text" class="searchbox" size="64">
        </form>
    </div>
</div>';
    echo $upper;
}

function title_box($text, $image_link) {
    $return = '
        <section class="description box col col-12">
            <div class="col col-12" style="text-align:center; padding-top:15px;padding-bottom:15px; margin-bottom: 2em;">
                <h4> '.$text.'</h4>
                
                <div id="logo-fp">
                    <img alt="4chan" src="'.$image_link.'" width="240">
                </div>
            </div>
        </section>';

    echo $return;
}

function post($name, $time, $number, $text)
{
    $resp = '
<div id="p131938256" class="post reply">
    <div class="postInfo desktop" id="pi131938256">
        <span class="nameBlock">
            <span class="name">  [-  '.$name.'  -]  </span>
        </span> 
        <span class="dateTime" data-utc="1498862741">  [- '.$time.' -]  </span>
        <span class="postNum desktop">
            
            <a href="thread/131930131#q131938256">[- No.  '.$number.'  -]</a>
                
        </span>
    </div>
    <blockquote class="postMessage" id="m131938256">
        '.$text.'
    </blockquote>
</div>
<br>';

    echo $resp;
}

function post_form() {
    $resp = '
    <form name="post" action="post.php" method="post">
        <table class="postForm hideMobile" id="postForm">
            <tbody>
                <tr data-type="Name">
                    <td>Name</td>
                    <td>
                        <input name="name" type="text" tabindex="1">
                    </td>
                </tr>
                <tr data-type="Subject">
                    <td>Subject</td>
                    <td>
                        <input name="sub" type="text" tabindex="3">
                        <input type="submit" value="Post" tabindex="6">
                    </td>
                </tr>
                <tr data-type="Comment">
                    <td>Comment</td>
                    <td>
                        <textarea name="com" cols="48" rows="4" wrap="soft" tabindex="4" ></textarea>
                    </td>
                </tr>
             </tbody>
        </table>
    </form>

    ';

    echo $resp;
}

function reply_form($thread) {
    $resp = '
    <form name="post" action="reply.php?thread='.$thread.'" method="post">
        <table class="postForm hideMobile" id="postForm">
            <tbody>
                <tr data-type="Name">
                    <td>Name</td>
                    <td>
                        <input name="name" type="text" tabindex="1">
                    </td>
                </tr>
                <tr data-type="Subject">
                    <td>Subject</td>
                    <td>
                        <input name="sub" type="text" tabindex="3">
                        <input type="submit" value="Post" tabindex="6">
                    </td>
                </tr>
                <tr data-type="Comment">
                    <td>Comment</td>
                    <td>
                        <textarea name="com" cols="48" rows="4" wrap="soft" tabindex="4" ></textarea>
                    </td>
                </tr>
             </tbody>
        </table>
    </form>

    ';

    echo $resp;
}

function thread_prev($title, $post_count, $text, $name, $link) {
    $resp = '
    <div class="thread">
        <a href="'.$link.'">
            <img width="150" height="150">
        </a>
        <div class="meta">'.$name.'<br>Replies: '.$post_count.'
            <a href="#" class="postMenuBtn" title="Thread Menu" data-post-menu="132841343">▶</a>
        </div>
        <div class="teaser"><b>'.$title .'</b>: '.$text.'</div>
    </div>
    ';
    
    echo $resp;
}

function footer(){
    $footer = '
<div id="ft">
    <ul>
        <li class="element"><a href="//www.4chan.org/">Home</a></li>
        <li class="element"><a href="//www.4chan.org/4channews.php">News</a></li>
        <li class="element"><a href="http://blog.4chan.org/">Blog</a></li>
        <li class="element"><a href="//www.4chan.org/faq">FAQ</a></li>
        <li class="element"><a href="//www.4chan.org/rules">Rules</a></li>
        <li class="element"><a href="https://www.4chan.org/pass">Support [brand]</a></li>
        <li class="element"><a href="//www.4chan.org/advertise">Advertise</a></li>
        <li class="element"><a href="//www.4chan.org/press">Press</a></li>
        <li class="element"><a href="//www.4chan.org/japanese">日本語</a></li>
    </ul>

    <br class="clear-bug">
    <div id="copyright"><a href="/faq#what4chan">About</a> • <a href="/feedback">Feedback</a> • <a href="/legal">Legal</a> • <a href="/contact">Contact</a><br><br><br>
        Copyright © 2003-2017 {insert brand here} LLC. All rights reserved.
    </div>
</div>';

    echo $footer;
}

function get_threads($board){
    //CONNECT TO MYSQL DATABASE AND POST THREAD TO MYSQL
    $conn = new mysqli(DBHOST, DBUSR, DBPW, DBNAME);
    if ($conn->connect_error) {
        die("Connection failed: ".$conn->connect_error);
    }
    $sql = 'SELECT  title, number, name, description, post_count, timestamp FROM '.$board;
    $result = $conn->query($sql);
    
    $threads = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $a = new thread();
            $a->title = $row["title"];
            $a->number = $row["number"];
            $a->name = $row["name"];
            $a->description= $row["description"];
            $a->post_count = $row["post_count"];
            $a->timestamp = $row["timestamp"];

            array_push($threads, $a);
        }
    }
    $conn->close();
    
    return $threads;
}
?>