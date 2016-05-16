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
      $this->load->model('instore_m');
      $return = array();
      foreach($result as $row){
        $row->ewt = $this->instore_m->ewt($row->s_id);
        $return[] = $row;
      }
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
    return $this->db->get()->row();
  }
}
