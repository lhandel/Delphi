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

}
