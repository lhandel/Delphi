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

    public function deleteAdmin($a_id)
    {
      $this->db->UPDATE('user');
      $this->db->SET('a_id',NULL);
      $this->db->WHERE('a_id',$a_id);
      return $this->db->get()->result();

      $this->db->DELETE('admin');
      $this->db->WHERE('a_id',$a_id);
      return $this->db->get()->result();
    }

    function save($a_id){

        $this->db->SELECT('admin_name');
        $this->db->FROM('admin');
        $this->db->WHERE('s_id',$s_id);
        return $this->db->get()->result();

    }



}
