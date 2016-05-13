<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_m extends CI_Model{

  // get all matching company id and password
  public function get_company_login($c_id,$password){
    $this->db->select('c_id');
    $this->db->from('company');
    $this->db->where('c_id',$c_id);
    $this->db->where('password',$password);
    return  $this->db->get()->result();
  }

} 
