<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Company_m extends CI_Model{

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

    public function get_company_name($c_id)
    {
      $this->db->select('company_name');
      $this->db->from('company');
      $this->db->where('c_id',$c_id);
      $data = $this->db->get()->row();
      return $data->company_name;
    }
}
