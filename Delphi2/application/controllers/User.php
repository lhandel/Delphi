<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function index()
	{
		$this->load->model('user_m');

		if(!isset($_GET['u'])){
		  die('You need a user id!');
		}else{

			$u_id_res = $this-> user_m -> verify_u_id($_GET['u']);
					if($u_id_res==false)
						die('You need a valid user id!');

			$u_id = $u_id_res[0]->u_id;
			$user_state = $this-> user_m -> verify_link($u_id);
			$state = $user_state[0]->state;
						if ($state > 1)
						die('Your link has expired.');

			$data['p_id'] = $_GET['u'];
			$queue_no = $this-> user_m -> queue_number($u_id);
			$data['queue_no'] = $queue_no[0]->q_no;
			$phone_no = $this-> user_m -> get_phone_number($u_id);
			$data['phone_no'] = $phone_no[0]->phone_no;

			$this->load->view('user/start', $data);
			//redirect(site_url("index.php/user/start"));

			}
		}
}
