<?php
class PostDTO {
    private $post_id;
    private $user_id;
    private $content;

    // コンストラクタ
    public function __construct($post_id = null, $user_id = '', $content = '') {
        $this->post_id = $post_id;
        $this->user_id = $user_id;
        $this->content = $content;
    }

    // getter / setter
    public function getPostId() { return $this->post_id; }
    public function setPostId($post_id) { $this->post_id = $post_id; }

    public function getUserId() { return $this->user_id; }
    public function setUserId($user_id) { $this->user_id = $user_id; }

    public function getContent() { return $this->content; }
    public function setContent($content) { $this->content = $content; }
}
?>