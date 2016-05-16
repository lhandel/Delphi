<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_m extends CI_Model{

  protected $_table_name = 'service';
  protected $_primary_key = 's_id';

  public function getServices($c_id)
  {
      // Select all the values
      $this->db->select('s_id');
      $this->db->select('name');
      $this->db->select('r_time');
      $this->db->select('(SELECT COUNT(u_id) FROM user WHERE state=0 AND s_id=service.s_id) as queue_count');
      $this->db->select('(SELECT COUNT(DISTINCT a_id) FROM user WHERE state=1 AND s_id=service.s_id) as handler');

      // From tabel
      $this->db->from('service');

      // Where this
      $this->db->where('c_id',$c_id);
      $this->db->where('state',0);

      // return the result
      $result = $this->db->get()->result();

      /*
        Get the EWT for each service
      */
      // Load the model
      $this->load->model('instore_m');

      // create a temporary array to return
      $return = array();

      // Loop all services and get the ewt
      foreach($result as $row){
        $row->ewt = $this->instore_m->ewt($row->s_id);
        $return[] = $row;
      }
      // return the array as an object
      return (object)$return;

  }

  public function deleteService($s_id)
  {
    $this->reset($s_id);
    $this->save(array(
        'state' => 1
    ),$s_id);
  }

  public function reset($s_id)
  {
    $this->db->where('s_id',$s_id);
    $this->db->where('(state=0 OR state=1)');
    $this->db->order_by('time_in ASC');
    $this->db->update('user',array(
      'state'=>4
    ));
  }
  public function next($s_id)
  {
    if($s_id!=0){

      $this->db->where('s_id',$s_id);
      $this->db->where('state',1);
      $this->db->order_by('time_in ASC');
      $this->db->limit(1);
      $this->db->update('user',array(
        'state' => 3,
        'time_out'  => time()
      ));

      $a_id = ($this->session->userdata('a_id')==true)? $this->session->userdata('a_id') : 1;
      $this->db->where('s_id',$s_id);
      $this->db->where('state',0);
      $this->db->order_by('time_in ASC');
      $this->db->limit(1);
      $this->db->update('user',array(
        'state' => 1,
        'a_id'  => $a_id,
        'time_start' => time()
      ));
      return true;
    }else{
      return false;
    }
  }
  public function getService($s_id)
  {
    // Select all the values
    $this->db->select('service.*');
    $this->db->select('(SELECT COUNT(DISTINCT a_id) FROM user WHERE state=1 AND s_id=service.s_id) as handler');
    $this->db->select('(SELECT COUNT(u_id) FROM user WHERE s_id=service.s_id AND state=0) as queue_count');
    $this->db->select('(SELECT q_no FROM user WHERE s_id=service.s_id AND state=1 ORDER BY u_id LIMIT 1) as current');

    $this->db->from('service');

    $this->db->where('s_id',intval($s_id));

    // return the result
    $return = $this->db->get()->row();

    $this->load->model('instore_m');
    $return->ewt = $this->instore_m->ewt($return->s_id);

    return $return;
  }
}
