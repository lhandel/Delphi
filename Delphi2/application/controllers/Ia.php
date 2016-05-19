<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ia extends CI_Controller{

  function index()
  {
    $data['theme'] = $this->use_theme($this->session->userdata('c_id'));
    $this->company_m->checkLogin();
    $this->load->view('ia',$data);
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
    }else if ($theme === "blue") {
      return "class = 'blue'";
    }else if ($theme === "roseg") {
      return "class = 'roseg'";
    }else if ($theme === "sunset") {
      return "class = 'sunset'";
    }else if ($theme === "heartbreak") {
      return "class = 'heartbreak'";
    }
    else return "";
  }

}
