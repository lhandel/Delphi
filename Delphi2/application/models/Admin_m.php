<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_m extends CI_Model{

  //check if adminname exists in the database
  public function check_admin_id($a_id){
    $this->db->select('a_id');
    $this->db->from('admin');
    $this->db->where('a_id',$a_id);
    return $this->db->get()->row();
  }

  public function checkLogin()
  {
    if($this->session->userdata('c_id')==false){
      header("Location: ".site_url(""));
    }
    if($this->session->userdata('a_id')==false){
      header("Location: ".site_url("index.php/admin/login"));
    }
    return true;
  }

  //Edit admin name
  function a_edit($a_id, $admin_name)
  {
    $data = array(
             'admin_name' => $admin_name
          );

    $this->db->where('a_id',$a_id);
    $this->db->update('admin', $data);
  }
  //Creat new admin
  function new_admin($admin_name)
	{
		$c_id= $this->session->userdata('c_id');

    $data = array(
            'admin_name' => $admin_name,
            'c_id' => $c_id
          );

    $this->db->insert('admin', $data);
  }
  //Get admin
  public function get_admins($c_id)
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
  //Delete admin
  public function deleteAdmin($a_id)
  {
      $data = array(
               'a_id' => NULL
            );

      $this->db->where('a_id',$a_id);
      $this->db->update('user', $data);


      $this->db->where('a_id',$a_id);
      $this->db->delete('admin');
  }

}
