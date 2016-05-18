<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ia extends CI_Controller{

  function index()
  {
    	$this->company_m->checkLogin();
    $this->load->view('ia');
  }

}
