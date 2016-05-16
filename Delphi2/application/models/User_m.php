<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model{

  public function queue_number($uid)
  {

  $this->db->select('q_no');
  $this->db->from('user');
  $this->db->where('u_id', $uid);

  return $this->db->get()->result();

  }

  public function get_phone_number($uid)
  {

  $this->db->select('phone_no');
  $this->db->from('user');
  $this->db->where('u_id', $uid);

  return $this->db->get()->result();

  }
  public function verify_u_id($pid)
  {

  $this->db->select('u_id');
  $this->db->from('user');
  $this->db->where('public_id', $pid);

  return $this->db->get()->result();

  }
  public function verify_link($uid){

  $this->db->select('state');
  $this->db->from('user');
  $this->db->where('u_id', $uid);

  return $this->db->get()->result();

  }

  public function update_state($pid){

//    $this->db->set('state',2);
    $this->db->where('public_id', $pid);
    $this->db->set('state',2);
    $this->db->update('user');


    return true;
  }
}
