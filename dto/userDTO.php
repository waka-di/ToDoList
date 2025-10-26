<?php
class User {
    private $user_id;
    private $user_name;
    private $mail;
    private $password;

    // コンストラクタ
    public function __construct($user_id = null, $user_name = '', $mail = '', $password = '') {
        $this->user_id = $user_id;
        $this->user_name = $user_name;
        $this->mail = $mail;
        $this->password = $password;
    }

    // getter / setter
    public function getUserId() { return $this->user_id; }
    public function setUserId($user_id) { $this->user_id = $user_id; }

    public function getUserName() { return $this->user_name; }
    public function setUserName($user_name) { $this->user_name = $user_name; }

    public function getMail() { return $this->mail; }
    public function setMail($mail) { $this->mail = $mail; }

    public function getPassword() { return $this->password; }
    public function setPassword($password) { $this->password = $password; }
}
?>