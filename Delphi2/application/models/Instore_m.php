<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instore_m extends CI_Model{

  // get active service id and name under the company
  public function get_services($c_id){
    $this->db->select('s_id, name');
    $this->db->from('service');
    $this->db->where('c_id',$c_id);
    $this->db->where('state', 0);
    $result = $this->db->get()->result();
    return $result;

  }

  // retrieve theme selected by company
  public function get_theme($c_id){
    $this->db->select("theme");
    $this->db->from("company");
    $this->db->where("c_id",$c_id);;

    return $this->db->get()->result();
  }

/* All the people in the Queue */
  public function get_inline($s_id){
    $this->db->select('u_id');
    $this->db->from('user');
    $this->db->where('s_id',$s_id);
    $this->db->where('state',0);
    return $this->db->get()->result();
  }

  public function get_service_name($s_id){
    $this->db->select('name');
    $this->db->from('service');
    $this->db->where('s_id',$s_id);
    $this->db->limit(1);
    return $this->db->get()->result();
  }

  public function ewt(){

  }

}
