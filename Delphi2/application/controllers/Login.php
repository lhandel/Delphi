<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


	public function index(){

	 // check if session exists
	 if($this->session->userdata('c_id'))
	 {
		 redirect(site_url("index.php/admin/ai"));
	 }
	 $this->load->view('login');

	 // check if fields are empty
	 if(isset($_POST['c_submit']))
	 {
		 if(empty($_POST['company_id'])){
					 redirect(site_url("index.php/login?wrong"));
		 }
		 if(empty($_POST['password'])){
					 redirect(site_url("index.php/login?wrong"));
		 }

		 // passing info from html as variables
		 $company_id = intval($_POST['company_id']);
		 $password = trim($_POST['password']);
		 $password = md5($password);

		 // if wrong password, redirect page
		 $result = $this->CheckLoginInDB($company_id,$password);
		 if(!$result){
					 redirect(site_url("index.php/login?wrong"));

		 }

		 // if password correct, save session and redirect page
		 else{
					 $c_id = $this->session->set_userdata($company_id);
					 redirect(site_url("index.php/admin/ai"));
		 }
	 }
 }

 // check if there is only one matching both company_id and password
 public function CheckLoginInDB($company_id,$password){
	 $this->load->model('login_m');
	 $result = $this-> login_m -> get_company_login($company_id,$password);
	 $rows = sizeof($result);
   if ($rows!= 1) 
	 {
		 return false;
	 }else{
		 return true;
	 }
 }


}
