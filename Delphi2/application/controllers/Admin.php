<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{
		//
		$this->listService();

	}
	//check session a_id
	public function checkLogin(){

		//Load model
		$this->load->model('admin_m');

		$sess=$this->session->userdata('a_id');
		// echo var_dump($sess);
		// echo var_dump($_GET['url']);
		// echo var_dump($_GET['s_id']);

		if($sess){
		  if (isset($_GET['url'])) {
		    redirect(site_url("index.php/admin/".$_GET['url']));
		  }else {
		    $s_id= $_GET['s_id'];
				redirect(site_url("index.php/admin/service.php?$s_id"));
		  }
		} else {
			$this->login();
		}
}
public function login(){
		// redirect(site_url("index.php/admin/login"));

		$this->load->model('admin_m');
		//session a_id is typed
		if(isset($_POST['a_id'])){
			$a_id = trim($_POST['a_id']);
			// Check in db if adminname exist
			$a_id = intval($a_id);
			//call model

			$result=$this->admin_m->check_admin_id($a_id);

			if ($result != 0 ) {	//admin does not exist
				$this->session->set_userdata('a_id',$a_id);
				if (isset($_GET['url'])) {
					echo var_dump($_GET['url']);
					redirect(site_url("index.php/admin/".$_GET['url']));
				}else {
					$s_id= $_GET['s_id'];
					redirect(site_url("index.php/admin/service.php?s_id=".$s_id));
				}
			}else	redirect(site_url("index.php/admin/login.php?$s_id&wrong=true"));
		}
		$this->load->view('admin/login');
}

/* All services in the admin dashboard */
	public function listService(){
		// Load the model
		$this->load->model('service_m');

		// Get the serivies
		$data['services']  = $this->service_m->getServices(1);  //  change to session!!!!

		// Load the view
		$this->load->view('admin/list',$data);
	}

/* Specific service */
	public function service()
	{

		// Load the model
		$this->load->model('service_m');

		if(isset($_GET['skip']))
		{
			$this->service_m->skip();
			$this->service_m->next($_GET['s_id']);
			redirect(site_url("index.php/admin/service?s_id=".$_GET['s_id'])); //redirect to specific service
		}
		if(isset($_GET['next']))
		{
			$this->service_m->next($_GET['s_id']);
			redirect(site_url("index.php/admin/service?s_id=".$_GET['s_id'])); //redirect to specific service
		}

		$data['service'] = $this->service_m->getService($_GET['s_id']); //gets the service
			// Load the view
			$this->load->view('admin/service',$data);
	}


  public function settings()
  {

		// Load the model
		$this->load->model('service_m');

		if (isset($_POST["rem"])) {
			$s_id= intval($_POST["s_id"]); //this service id
			$r_time= intval($_POST["content"]);// what you changed to in the textfield
			$this->service_m->save(array(
				'r_time'	=>  $r_time
			),$s_id);
			header("Location: ".site_url("index.php/admin/settings"));//send you back to the same page
		}
		//change service name
		if (isset($_POST["edit"])) {
			$s_id= intval($_POST["s_id"]);
			$this->service_m->save(array(
				'name'	=>  $_POST["content"]
			),$s_id);
			header("Location: ".site_url("index.php/admin/settings"));//send you back to the same page
		}
		if(isset($_GET["reset"]))
		{
			$s_id= intval($_GET["s_id"]);
			$this->service_m->reset($s_id);
			header("Location: ".site_url("index.php/admin/settings"));
		}
		if(isset($_GET["s_remove"]))
		{
			$s_id= intval($_GET["s_id"]);
			$this->service_m->deleteService($s_id);
			header("Location: ".site_url("index.php/admin/settings"));
		}


		// Get the serivies
		$data['services']  = $this->service_m->getServices(1);  //  change to session!!!!

		// load the view
		$this->load->view('admin/settings',$data);
	}

  public function  AdminMangement()
  {
    # code...
    echo 'admin';
  }
}
