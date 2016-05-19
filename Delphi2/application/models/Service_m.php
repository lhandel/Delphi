<?php
/*-------------------
State table:
State 0 = wating,
State 1 = on-going,
State 2 = quit,
State 3 = done,
State 4 = cleared.
--------------------*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Service_m extends CI_Model{

  protected $_table_name = 'service';
  protected $_primary_key = 's_id';

  //Get services for list.php
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
  //delete Service
  public function deleteService($s_id)
  {
    $this->reset($s_id);
    $this->save(array(
        'state' => 1
    ),$s_id);
  }
  //reset queue
  public function reset($s_id)
  {
    $this->db->where('s_id',$s_id);
    $this->db->where('(state=0 OR state=1)');
    $this->db->order_by('time_in ASC');
    $this->db->update('user',array(
      'state'=>4
    ));
  }
  //create new service
  function new_service($name)
	{
		$c_id= $this->session->userdata('c_id');

    $data = array(
            'name' => $name,
            'c_id' => $c_id,
            'r_time' => 5
          );

    $this->db->insert('service', $data);
  }
  //next in line
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
  //skip person in queue
  public function skip()
  {
      // get the admin id
      $a_id = ($this->session->userdata('a_id')==true)? $this->session->userdata('a_id') : 1;

      $this->db->where('a_id',$a_id);
      $this->db->where('state',1);
      $this->db->order_by('time_in ASC');
      $this->db->limit(1);
      $this->db->update('user',array(
        'state' => 2
      ));

  }
  //Get services for service.php
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


  public function save($data, $id = NULL)
	{

		// Insert
		if ($id === NULL) {
			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			$this->db->set($data);
			$this->db->insert($this->_table_name);
			$id = $this->db->insert_id();
		}
		// Update
		else {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->set($data);
			$this->db->where($this->_primary_key, $id);
			$this->db->update($this->_table_name);
		}

		return $id;
	}

}
