<?php
class Log {
    private $log_id;
    private $user_id;
    private $action;
    private $created_at;

    // Constructeur
    public function __construct($log_id, $user_id, $action, $created_at) {
        $this->log_id = $log_id;
        $this->user_id = $user_id;
        $this->action = $action;
        $this->created_at = $created_at;
    }

    // Getters
    public function getLogId() {
        return $this->log_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getAction() {
        return $this->action;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    // Setters
    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function setAction($action) {
        $this->action = $action;
    }

    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }
}

?>