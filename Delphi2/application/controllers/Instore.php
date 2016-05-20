<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instore extends CI_Controller{

  public function paperDone(){
    $data['theme'] = $this->use_theme($this->session->userdata('c_id'));


    $time_in = time(); // time() return the unix timestamp
    $s_id = intval($_GET['s_id']); // make sure it's a number

    // Get the queue-number
    $this->load->model('instore_m');

    $result = $this->instore_m->q_no($s_id);


    if($result==false){
      $q_no = 1;
    }else{
      $q_no = $result[0]->q_no+1;
    }
    // Check the service id
    if($s_id!=0){

      $public_id = $this->generateRandomString(5);

      // Run the query and insert into db
      $uid= $this->instore_m->insert($public_id, 0,$time_in,$s_id,$q_no);
      // send the user to the next page
      $data['q_no']= $q_no;
      $result = $this->instore_m->get_service_name($s_id); //gets the service
      $data['service']= $result[0]->name;

      $this->load->view("instore/paperDone",$data);
    }
  }

  public function index()
  {
//    $c_id = $this->session->userdata('c_id');
    $c_id = $this->session->userdata('c_id');
    $data['services'] =$this->get_services($c_id);
    $data['theme'] = $this->use_theme($c_id);
    $data['margin'] = $this->set_margin($this->get_services($c_id));

    //Set Instore Session
    $this->session->set_userdata('instore',true);

    $this->load->view('instore/index_i',$data);

  }

  // display for index page
  private function set_margin($result){
    if(sizeof($result)==4){
          return 'remove_margin_top';
    }
    else return '';
  }

  // get theme selected by company
  private function use_theme($c_id){
		$c_id = intval($c_id);
		$this->load->model('instore_m');
		$theme = $this->instore_m->get_theme($c_id); // get theme from database
    return "class='".$theme."'";
	}

  // get a list of services currently offered by the company
  // return array of service id and service name
  private function get_services($c_id){
    $c_id = intval($c_id);
    $this->load->model('instore_m');
    $result = $this-> instore_m ->get_services($c_id);
    return $result;
  }

  /* Goes to specific register page */
  public function register()
  	{
  		// Load the model
  		$this->load->model('instore_m');
      $data['theme'] = $this->use_theme($this->session->userdata('c_id'));

      // service
  		$result = $this->instore_m->get_service_name(intval($_GET['s_id'])); //gets the service
      $data['name']= $result[0]->name;
      $data['s_id']= $_GET['s_id'];
      // inline
      $in_line = $this->instore_m->get_inline(intval($_GET['s_id'])); //inline
      $data['inline']= sizeof($in_line);
      // estimate waiting time

      $data['ewt'] = $this->instore_m->ewt(intval($_GET['s_id']));;

  		$this->load->view('instore/register',$data);
  	}


    public function choice(){
      $data['s_id']=$_GET['s_id'];
      // Load the model
      $this->load->model('instore_m');

      $data['theme'] = $this->use_theme($this->session->userdata('c_id'));

      $in_line = $this->instore_m->get_inline(intval($_GET['s_id'])); //inline
      $data['inline']= sizeof($in_line);
      // estimate waiting time
      $data['q_no'] = $this-> new_q_no(intval($_GET['s_id']));
      $data['ewt'] = $this->instore_m->ewt(intval($_GET['s_id']));
      $this->load->view('instore/choice',$data);




    }

  private function new_q_no($s_id){
    $this->load->model('instore_m');
    $result = $this->instore_m->q_no($s_id);

    if($result==false){
      return 1;
    }else{
      return $result[0]->q_no+1;
    }
  }



  public function submit(){

    $data['theme'] = $this->use_theme($this->session->userdata('c_id'));

    // Check if the number is submited
    if(isset($_POST['number'])){

      // Setup the varibles & Clean the data
      // $number = $mysqli->real_escape_string($_POST['number']); /*ask ludwig if we really need it?*/
      $time_in = time(); // time() return the unix timestamp
      $s_id = intval($_POST['service_id']); // make sure it's a number

      // Get the queue-number
      $this->load->model('instore_m');

      $result = $this->instore_m->q_no($s_id);


      //sendSMS(makeSMS($_POST['number'],$_POST['in_line']));


      if($result==false){
        $q_no = 1;
      }else{
        $q_no = $result[0]->q_no+1;
      }
      // Check the service id
      if($s_id!=0){

        $public_id = $this->generateRandomString(5);

        // Run the query and insert into db
        //$mysqli->query("INSERT INTO user(public_id,phone_no,time_in,s_id,q_no) VALUES('$public_id','$number',$time_in,$s_id,$q_no)");
        $uid= $this->instore_m->insert($public_id, $_POST['number'],$time_in,$s_id,$q_no);
        // send the user to the next page

        $link1 = 'http://46.101.97.62/Delphi2/index.php/user?u='.$public_id;
        $data['q_no']= $q_no;
        $data['phone_nr'] = $_POST['number'];
        // get service name
        $result = $this->instore_m->get_service_name($s_id); //gets the service
        $data['service']= $result[0]->name;



        $this->sendSMS($this->makeSMS($_POST['number'],$_POST['in_line'],$link1,$q_no,$uid,$s_id));
      //  header("Location: done.php?q_no=".$q_no."&phone_nr=".$_POST['number']."&service=".$s_id);
        $this->load->view('instore/done',$data);
      }
    }else{
      die("Fel");
    }

  }

  private function generateRandomString($length = 10) {
      $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
  }

  private function sendSMS ($sms) {
    // Set your 46elks API username and API password here
    // You can find them at https://dashboard.46elks.com/
    //Comment out 2 lines below to disable SMS when testing
    $username = 'u92c0d266fed48b8ca18a4d2f795eb1fd';
    $password = 'D80F6925A0D8DD4732734486222D884A';
    $context = stream_context_create(array(
      'http' => array(
        'method' => 'POST',
        'header'  => "Authorization: Basic ".
                     base64_encode($username.':'.$password). "\r\n".
                     "Content-type: application/x-www-form-urlencoded\r\n",
        'content' => http_build_query($sms),
        'timeout' => 10
    )));
    $response = file_get_contents(
      'https://api.46elks.com/a1/SMS', false, $context );
    if (!strstr($http_response_header[0],"200 OK"))
      return $http_response_header[0];

    return $response;
  }



  private function makeSMS($phone_no,$in_line,$link1,$q_no,$user,$s_id)
  {
    $this->load->model('instore_m');
    $temp = (string)$phone_no;
    $temp1 = substr($temp,1);
    $num = '+46'.$temp1;
    return array(
      'from' => 'Queue',
      'to' => $num,
      'message' => "Your number is #".(string)$q_no.".\nThere are ".(string)$in_line." people in queue. Please return to DQ in ".$this->instore_m->ewt(intval($s_id))." minutes. Track yourself here ".$link1
    );

  }

}
