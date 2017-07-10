<?php
class thread {
    public $title;
    public $number;
    public $name;
    public $description;
    public $post_count;
    public $timestamp;
    public $posts = array();
}

class post {
    public $user;
    public $number;
    public $text;
    public $time;
}

class boards {

    public $topic;
    public $topic_id;
    public $topic_short;
    public $banner_url;
    public $url;
    public $header_desc;
    public $threads = array();

    public function all() {
        echo 'topic_id: '.$this->topic_id.'<br>topic: '.$this->topic.'<br>url: '.$this->url;
    }
    function link() {
        $final = '<a href="localhost:8888/boards/'.$this->url.'">'.$this->topic.'</a>';

        return $final;
    }
}
?>