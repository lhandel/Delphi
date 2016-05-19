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

  function send_survey($s_id,$link){
    $this->db->select('phone_no');
    $this->db->from('user');
    $this->db->where('s_id',$s_id);
    $this->db->where('state', 3);
    $this->db->where("phone_no!=''");
    $this->db->order_by('u_id DESC');
    $this->db->limit(1);
    $result = $this->db->get()->row();
    $this->sendSMS($this->makesurveysms($result->phone_no,$link));
  }
  function checkReminder($s_id){

      $this->db->select('r_time');
      $this->db->from('service');
      $this->db->where('s_id',$s_id);
      $reminder_time = $this->db->get()->row()->r_time; //NICK said he is sure

      if ($reminder_time==0) {
        $reminder_time=5;
      }

      $this->db->select('phone_no');
      $this->db->select('u_id');
      $this->db->from('user');
      $this->db->where('s_id',$s_id);
      $this->db->where('r_sms', 0); // if the user has gotten an SMS
      $this->db->where('state', 0);
      $this->db->where("phone_no!=''");
      $this->db->order_by('u_id ASC');
      $this->db->limit(5);
      $result = $this->db->get()->result();
      $this->load->model('user_m');


      $query = $this->db->query("SELECT
                                  AVG(time_out-time_start)
                              as ewt
                               FROM user WHERE s_id=$s_id AND state=3 AND time_out!=0 LIMIT 10");

      $ongoing=intval($query->row()->ewt);
      //var_dump($ongoing);

      foreach ($result as $p_and_u) {

        $data_pn=$p_and_u->phone_no;
        $u_id=$p_and_u->u_id;

        $ewt_data = $this->user_m->ewt_for_user($s_id,$u_id);// FIX this later

        $this->db->select('u_id');
        $this->db->from('user');
        $this->db->where('s_id',$s_id);
        $this->db->where('u_id <',$u_id);
        $this->db->where('state',0);

        $numb_users =$this->db->count_all_results();
        //$numb_users = $user_in_front->num_rows();

        $diff=$ewt_data->ewt-$ongoing;


        if (($reminder_time > $diff && $ewt_data->ewt!=0) || $numb_users ==1) {
          $this->sendSMS($this->makeReminder($data_pn));

          $this->db->where('u_id',$u_id);
          $this->db->where('s_id',$s_id);
          $this->db->update('user',array('r_sms' => 1));
        }
      }
  }

    private function sendSMS ($sms) {
      // Set your 46elks API username and API password here
      // You can find them at https://dashboard.46elks.com/
      //Comment out 2 lines below to disable SMS when testing
      $username = 'u92c0d266fed48b8ca18a4d2f795eb1fd';
      $password = 'D80F6925A0D8DD4732734486222D884A';
      $context = stream_context_create(array(
        'http' => array(
          'method' => 'POST',
          'header'  => "Authorization: Basic ".
                       base64_encode($username.':'.$password). "\r\n".
                       "Content-type: application/x-www-form-urlencoded\r\n",
          'content' => http_build_query($sms),
          'timeout' => 10
      )));
      $response = file_get_contents(
        'https://api.46elks.com/a1/SMS', false, $context );
      if (!strstr($http_response_header[0],"200 OK"))
        return $http_response_header[0];

      return $response;
    }

  private function makeReminder($phone_no){
    $temp = (string)$phone_no;
    $temp1 = substr($temp,1);
    $num = '+46'.$temp1;
    return array(
    'from' => 'Queue',
    'to' => $num,
    'message' => "It is almost your turn, please return to the store."
    );
  }

  private function makesurveysms($phone_no,$link){
    $temp = (string)$phone_no;
    $temp1 = substr($temp,1);
    $num = '+46'.$temp1;
    return array(
    'from' => 'Queue',
    'to' => $num,
    'message' => "We are glad to help you. Please rate our service:".$link
    );
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
