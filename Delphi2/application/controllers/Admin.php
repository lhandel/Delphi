<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{
		$this->listService();
	}

	public function listService()
	{
		// Load the model
		$this->load->model('service_m');

		// Get the serivies
		$data['services']  = $this->service_m->getServices(1);  //  change to session!!!!

		// Load the view
		$this->load->view('admin/list',$data);
	}


	public function service()
	{
		// Load the model
		$this->load->model('service_m');

		if(isset($_GET['next']))
		{

			redirect(site_url("index.php/admin/service?s_id=".$_GET['s_id']));
		}

		$data['service'] = $this->service_m->getService($_GET['s_id']);
		// Load the view
		$this->load->view('admin/service',$data);
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
