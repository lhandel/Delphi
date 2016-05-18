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
      $data = array(
               'a_id' => NULL
            );

      $this->db->where('a_id',$a_id);
      $this->db->update('user', $data);

      $this->db->where('a_id',$a_id);
      $this->db->delete('admin');
    }

    function a_edit($a_id, $admin_name)
    {
      $data = array(
               'admin_name' => $admin_name
            );

      $this->db->where('a_id',$a_id);
      $this->db->update('admin', $data);
    }

    /*function new_admin($name)
    {
      $newdata = array(
                   'username'  => 'johndoe',
                   'email'     => 'johndoe@some-site.com',
                   'logged_in' => TRUE
               );

      $this->session->set_userdata($newdata);

      global $mysqli;
      $name=$mysqli->real_escape_string($name);
      $c_id = (isset($_SESSION['c_id']))? $_SESSION['c_id'] : 1;
      $mysqli->query("INSERT INTO service(name,c_id,r_time) VALUES('$name',$c_id,5)");
      $s_id= $mysqli->insert_id;
      return $s_id;
    }*/

}
