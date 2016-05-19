<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{
		$this->listService();
	}
	//check session a_id


	public function login(){
		// Check submit page
		if($this->session->userdata('c_id')==false){
      header("Location: ".site_url(""));
    }

		if($this->session->userdata('a_id')){
			if(isset($_GET['url']))
			{
				header("Location: ".$_GET['url']);
			}
			elseif(isset($_GET['s_id']))
			{
				$s_id= $_GET['s_id'];
				header("Location:".site_url("index.php/admin/service?s_id=".$s_id));
			}
		}


		if(isset($_POST['a_id'])){

			//Load model
			$this->load->model('admin_m');

			// get the a_id
			$a_id = intval(trim($_POST['a_id']));

			// Check if admin exists
			$result=$this->admin_m->check_admin_id($a_id);

			// Admin exist
			if (isset($result->a_id) && $result->a_id==$a_id && $a_id!==0)
			{
				$this->session->set_userdata('a_id',$a_id);

				if(isset($_GET['url']))
				{
					header("Location: ".$_GET['url']);
				}
				elseif(isset($_GET['s_id']))
				{
					$s_id= $_GET['s_id'];
					header("Location:".site_url("index.php/admin/service?s_id=".$s_id));
				}
				else {
					header("Location:".site_url("index.php/admin"));
				}
			}
			else
			{
					// admin log in error - must fix
					$append = (isset($_GET['url']))? 'url='.$_GET['url'] : 's_id='.$_GET['s_id'];
					header("Location: ".
							site_url("index.php/admin/login?wrong=true&".$append)
						);
			}
		}
		$data['theme'] = $this->use_theme($this->session->userdata('c_id'));
		$this->load->view('admin/login',$data);

	}

/* All services in the admin dashboard */
	public function listService(){
		$this->company_m->checkLogin();

		$data['theme'] = $this->use_theme($this->session->userdata('c_id'));

		// Load the model
		$this->load->model('service_m');

		// Get the serivies
		$data['services']  = $this->service_m->getServices($this->session->userdata('c_id'));  //  change to session!!!!

		// Load the view
		$this->load->view('admin/list',$data);
	}

/* Specific service */
	public function service()
	{
		$this->load->model('admin_m'); $this->admin_m->checkLogin();

		// Load the model
		$this->load->model('service_m');

		$data['theme'] = $this->use_theme($this->session->userdata('c_id'));
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

	//Function for serviceManagement.php
	public function serviceManagement()
	{
		$this->load->model('admin_m'); $this->admin_m->checkLogin();

		// Load the model
		$this->load->model('service_m');
		$this->load->model('instore_m');

	$data['theme_name'] = $this->instore_m->get_theme($this->session->userdata('c_id'));

	$data['theme'] = $this->use_theme($this->session->userdata('c_id'));

	//Change reminder time
	if (isset($_POST["rem"])) {
		$s_id= intval($_POST["s_id"]); //this service id
		$r_time= intval($_POST["content"]);// what you changed to in the textfield
		$this->service_m->save(array(
			'r_time'	=>  $r_time
		),$s_id);
		header("Location: ".site_url("index.php/admin/serviceManagement"));//send you back to the same page
	}

	//change service name
	if (isset($_POST["edit"])) {
		$s_id= intval($_POST["s_id"]);
		$this->service_m->save(array(
			'name'	=>  $_POST["content"]
		),$s_id);
		header("Location: ".site_url("index.php/admin/serviceManagement"));//send you back to the same page
	}
	//Reset service queue
	if(isset($_GET["reset"]))
	{
		$s_id= intval($_GET["s_id"]);
		$this->service_m->reset($s_id);
		header("Location: ".site_url("index.php/admin/serviceManagement"));
	}
	//Remove service
	if(isset($_GET["s_remove"]))
	{
		$s_id= intval($_GET["s_id"]);
		$this->service_m->deleteService($s_id);
		header("Location: ".site_url("index.php/admin/serviceManagement"));
	}

	//Create new admin
	if (isset($_POST["new_service"])) {
		$this->service_m->new_service($_POST["s_content"]);
		header("Location: ".site_url("index.php/admin/serviceManagement"));//send you back to the same page
	}

	// Get the serivies
	$data['services']  = $this->service_m->getServices(1);  //  change to session!!!!

	// load the view
	$this->load->view('admin/serviceManagement',$data);

	}

	//Function for settings.php
  public function settings()
  {
			$this->load->model('admin_m'); $this->admin_m->checkLogin();

			// Load the model
			$this->load->model('service_m');
			$this->load->model('instore_m');

		$data['theme_name'] = $this->instore_m->get_theme($this->session->userdata('c_id'));
		$data['company_name'] = $this->company_m->get_company_name($this->session->userdata('c_id'));
		$data['theme'] = $this->use_theme($this->session->userdata('c_id'));
<<<<<<< HEAD
		$data['survey'] = $this->company_m->get_survey_link($this->session->userdata('c_id'));
=======
		$data['surveylink'] = $this->company_m->get_survey_link($this->session->userdata('c_id'));

>>>>>>> master
		//Servey link
		if (isset($_POST['link'])) {
				$link= $_POST['url'];
				$c_id=$this->session->userdata('c_id');
				$this->load->model('admin_m');
				$this->company_m-> register_link($c_id,$link);
				header("Location: ".site_url("index.php/admin/settings"));//send you back to the same page
		}
		//Change theme
		if (isset($_GET["theme"])) {
			$c_id=$this->session->userdata('c_id');

			$this->company_m-> set_theme($c_id,$_GET["theme"]);

			header("Location: ".site_url("index.php/admin/settings"));
		}

		// Get the serivies
		$data['services']  = $this->service_m->getServices(1);  //  change to session!!!!

		// load the view
		$this->load->view('admin/settings',$data);
	}

  public function  adminManagement()
  {

		// Load the model
		$this->load->model('Admin_m');

		//change admin name
		if (isset($_POST["a_edit"])) {
			$a_id= intval($_POST["a_id"]);
			$this->Admin_m->a_edit($a_id,$_POST["a_content"]);
			header("Location: ".site_url("index.php/admin/adminManagement"));//send you back to the same page
		}

		//remove admin
		if(isset($_GET["a_remove"]))
		{
			$a_id= intval($_GET["a_id"]);
			$this->Admin_m->deleteAdmin($a_id);
			header("Location: ".site_url("index.php/admin/adminManagement"));

		}

		//Create new admin
		if (isset($_POST["new_admin"])) {
			$this->Admin_m->new_admin($_POST["a_content"]);
			header("Location: ".site_url("index.php/admin/adminManagement"));//send you back to the same page
		}

		// Get the serivies
		$data['services']  = $this->Admin_m->get_admins($this->session->userdata('c_id'));  //  change to session!!!!*/
		$data['theme'] = $this->use_theme($this->session->userdata('c_id'));
		// load the view
		$this->load->view('admin/adminManagement',$data);
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
