<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends MY_Model{

  public function getUsers()
  {
    $query = $this->db->query("SELECT * FROM user");
    return $query->result();
  }

  public function getUser($id)
  {
    $query = $this->db->query("SELECT * FROM user WHERE u_id=$id");
    return $query->result();
  }

}
