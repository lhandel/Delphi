<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


	public function index()
	{

    $data['phonenr']  = '0708948514';
    $data['moreinfo']  = array(1,2,3,4);

    $this->load->model('user_m');
    $data['user']  = $this->user_m->getUser($_GET['u_id']);
    $data['someother'] = $this->user_m->getUser(1);



		$this->load->view('login',$data);
	}
  
}
