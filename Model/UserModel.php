<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class UserModel extends Database
{
  public function getUsers($limit)
  {
    return $this->select("SELECT * FROM users ORDER BY user_id ASC LIMIT ?", ["i", $limit]);
  }

  public function getUserById($id)
  {
    $result = $this->select("SELECT * FROM users WHERE user_id = ?", ["i", $id]);
    return (object)$result[0];
  }

  public function createUser($user)
  {
    $result = $this->insert("INSERT INTO users (username, user_email, user_status) VALUES (?, ?, ?)", ["ssi", $user->username, $user->user_email, $user->user_status]);
    return $result;
  }
}