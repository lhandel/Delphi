<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{

		$this->load->view('login');
	}

  public function settings()
  {
    echo 'settings';
  }

  public function  AdminMangement()
  {
    # code...
    echo 'admin';
  }
}
