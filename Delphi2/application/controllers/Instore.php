<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instore extends CI_Controller{



  public function index()
  {
//    $c_id = $this->session->userdata('c_id');
    $c_id = 1;
    $data['services'] =$this->get_services($c_id);
    $data['theme'] = $this->use_theme($c_id);
    $data['margin'] = $this->set_margin($this->get_services($c_id));
    $this->load->view('instore/index_i',$data);

  }

  // display for index page
  private function set_margin($result){
    if(sizeof($result)==4){
          return 'remove_margin_top';
    }
    else return '';
  }

  // get theme selected by company
  private function use_theme($c_id){
    $c_id = intval($c_id);
    $this->load->model('instore_m');
    $theme = $this->instore_m->get_theme($c_id); // get theme from database

    // send theme with html
    if ($theme === "dark"){
      return "class = 'dark'";
    }else if ($theme === "red"){
      return "class = 'red'";
    }
    else return "";
  }

  // get a list of services currently offered by the company
  // return array of service id and service name
  private function get_services($c_id){
    $c_id = intval($c_id);
    $this->load->model('instore_m');
    $result = $this-> instore_m ->get_services($c_id);
    return $result;
  }
}
