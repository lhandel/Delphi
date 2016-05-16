<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_m extends CI_Model{

//check if adminname exists in the database
public function check_admin_id($a_id){
  $this->db->select('a_id');
  $this->db->from('admin');
  $this->db->where('a_id',$a_id);
  return $this->db->get()->result();
}
}
