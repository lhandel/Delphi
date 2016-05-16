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

  public function ewt($s_id){
    $query = $this->db->query("SELECT
                            (
                                AVG(time_out-time_start)*
                                (SELECT COUNT(u_id) FROM user WHERE s_id=$s_id AND (state=0 OR state=1))

                            )
                            as ewt,
                            (SELECT COUNT(DISTINCT a_id) FROM user WHERE state=1 AND s_id=$s_id) as handlers
                             FROM user WHERE s_id=$s_id AND (state=3 OR state=2)  AND time_out!=0 LIMIT 10");

   $data =  $query->row();

   if($data->ewt==NULL)
    return 0;
   if($data->handlers==0)
     return ceil($data->ewt/60);
   else
     return ceil(($data->ewt/$data->handlers)/60);

  /*  $ewt = get_result("SELECT
                            (
                                AVG(time_out-time_start)*
                                (SELECT COUNT(u_id) FROM user WHERE s_id=$s_id AND (state=0 OR state=1))

                            )
                            as ewt,
                            (SELECT COUNT(DISTINCT a_id) FROM user WHERE state=1 AND s_id=$s_id) as handlers
                             FROM user WHERE s_id=$s_id AND (state=3 OR state=2)  AND time_out!=0 LIMIT 10");
    $data = $ewt->fetch_assoc();

    if($data['handlers']==0)
      return ceil($data['ewt']/60);
    else
      return ceil(($data['ewt']/$data['handlers'])/60); */
  }

}
