<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//header("Content-type: application/json; charset=ut8");

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

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

  $data =  $this->db->get()->row();
    if(isset(data->u_id))
      return $data->u_id;
    else
      return false;
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

  public function ewt($pid){


    $query = $this->db->query("SELECT u_id,s_id,r_sms,state,
                                      (SELECT COUNT(u_id) FROM user WHERE s_id=1 AND (state=0 OR state=1) AND u_id<u.u_id) as inline
                              FROM user u WHERE public_id='$pid'");

    foreach ($query->result() as $row)
    {
       $data_ewt['u_id'] = $row->u_id;
       $data_ewt['s_id'] = $row->s_id;
       $data_ewt['r_sms'] = $row->r_sms;
       $data_ewt['state'] = $row->state;

    }

    return $data_ewt;

  }

  public function ewt_for_user($u_id,$s_id)
   {
       $query = $this->db->query("SELECT
                             (
                                 AVG(time_out-time_start)*
                                 (
                                   (SELECT COUNT(u_id) FROM user WHERE s_id=$s_id AND u_id<$u_id AND (state=0 OR state=1))
                                 )
                             )
                             as ewt,
                             (SELECT time_start FROM user WHERE s_id=$s_id AND  state=1 ORDER BY time_start ASC LIMIT 1) as timer,
                             (SELECT COUNT(DISTINCT a_id) FROM user WHERE state=1 AND s_id=$s_id) as handlers
                              FROM user WHERE s_id=$s_id AND (state=3 OR state=2) AND time_out!=0 ORDER BY u_id DESC LIMIT 20");
    $data =  $query->row();
    $array =  (object)array
              (
                'ewt' => ($data->handlers==0)? $data->ewt : $data->ewt/$data->handlers,
                'timer' => $data->timer
              );
     return $array;
   }

  public function queue_counter($s_id){

    $this->db->select('(SELECT COUNT(u_id) FROM user WHERE state=0 AND s_id='.$s_id.') as queue_count');

    return $this->db->get()->result();


  }

  public function getUserFromPublicId($pid)
  {
      $query = $this->db->query("SELECT u_id,s_id,r_sms,state, (SELECT COUNT(u_id) FROM user WHERE s_id=1 AND (state=0 OR state=1) AND u_id<u.u_id) as inline FROM user u WHERE public_id='$pid'");
      return $query->row();
  }

}
