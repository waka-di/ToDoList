<?php
class PostDTO {
    private $post_id;
    private $user_id;
    private $content;
    private $post_date;

    // コンストラクタ
    public function __construct($post_id = null, $user_id = '', $content = '', $post_date = '') {
        $this->post_id = $post_id;
        $this->user_id = $user_id;
        $this->content = $content;
        $this->post_date = $post_date;
    }

    // getter / setter
    public function getPostId() { return $this->post_id; }
    public function setPostId($post_id) { $this->post_id = $post_id; }

    public function getUserId() { return $this->user_id; }
    public function setUserId($user_id) { $this->user_id = $user_id; }

    public function getContent() { return $this->content; }
    public function setContent($mail) { $this->content = $content; }

    public function getPostDate() { return $this->post_date; }
    public function setPostDate($post_date) { $this->post_date = $post_date; }
}
?>