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
			$ewt = $this-> user_m -> ewt($_GET['u']);
			$data['s_id'] = $ewt['s_id'];


			$queue_count = $this->user_m->queue_counter($data['s_id']);
			$data['queue_count'] = $queue_count[0]->queue_count;

			$this->load->view('user/start', $data);
			}
		}

		public function quit()
		{
			$this->load->model('user_m');
			if(isset($_GET['u'])){
			    // Putting updated information to varaible sql

			    $sql = $this-> user_m ->update_state($_GET['u']);

			    // run the query and update mysql database
			    if ($sql == true) {
											$this->load->view('user/success');
			    } else {
								//not sure if works
			          echo "Error updating record: " . $mysql->error;
			    }

			}
		}
		public function u_ewt(){

			header("Content-type: application/json; charset=ut8");

			$this->load->model('user_m');

			$data = $this-> user_m -> ewt($_GET['u']);

			$s_id = $data['s_id'];
			$u_id = $data['u_id'];
			$flag = $data['r_sms'];

			$ewt = $this-> user_m -> ewt_for_user2($s_id,$u_id);
	    $better_ewt = $ewt['ewt']-(time()-$ewt['timer']);

	    if($better_ewt<0){
	      $better_ewt = 0;
	    }

	    $data = array(

	      "title"   =>  "ok",
	      "content" =>  ceil($better_ewt/60),
	      "inline" => $data['inline'],
	      "flag" => $flag,
	      "state" => $data['state']
	    );
			echo json_encode($data);

		}


}
