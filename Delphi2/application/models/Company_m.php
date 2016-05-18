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




    public function checkLogin()
    {
      if($this->session->userdata('c_id')==false){
        header("Location: ".site_url(""));
      }
      return true;
    }

    public function set_theme($c_id,$theme)
    {
      $this->db->where('c_id',$c_id);
      $this->db->update('company',array('theme'=>$theme));
    }
}
