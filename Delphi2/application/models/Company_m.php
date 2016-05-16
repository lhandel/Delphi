<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Company_m extends CI_Model{

  public function get_admins($c_id=1)
  {
    $c_id = intval($c_id);

    if($c_id!=0){
      $this->db->select('a_id');
      $this->db->select('admin_name');
      $this->db->from('admin');
      $this->db->where('c_id',$c_id);
      return $this->db->get()->result();

    }else{
      return false;
    }

  }






}
