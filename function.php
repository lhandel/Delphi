<?php
session_start();
//connect to database
include 'db.php';

function protect($for="admin"){

  $url = (strpos($_SERVER["REQUEST_URI"],"admin"))? '../': '';

  if($for=="admin"){
    if(!isset($_SESSION['a_id']))
      header("Location: index.php");
  }else{
    if(!isset($_SESSION['c_id']))
      header("Location: ".$url."index.php");
  }
}
function get_service($s_id){
  $s_id = intval($s_id);
  $result = get_row("SELECT
                            s_id,
                            name,
                            (SELECT COUNT(DISTINCT a_id) FROM user WHERE state=1 AND s_id=service.s_id) as handler,
                            (SELECT COUNT(u_id) FROM user WHERE s_id=service.s_id AND state=0) as queue_count,
                            (SELECT q_no FROM user WHERE s_id=service.s_id AND state=1 ORDER BY u_id LIMIT 1) as current
                      FROM service WHERE s_id=$s_id LIMIT 1");
  return $result;
}


//dynamic service title
function get_service_name($s_id){
    $s_id = intval($s_id);
    return get_var("SELECT name FROM service WHERE s_id=$s_id LIMIT 1");
}
//get how many people in queue
function get_inline($s_id){
  $s_id = intval($s_id);
  $result = get_result("SELECT u_id FROM user WHERE s_id=$s_id AND state=0");
  return($result->num_rows);
}
// Get the services for the company
function get_services($c_id=1){
  $c_id = intval($c_id);
  if($c_id!=0){
    $result = get_result("SELECT
                              s_id,
                              name,
                              (SELECT COUNT(u_id) FROM user WHERE state=0 AND s_id=service.s_id) as queue_count,
                              (SELECT COUNT(DISTINCT a_id) FROM user WHERE state=1 AND s_id=service.s_id) as handler
                        FROM service WHERE c_id=$c_id");
    return $result;
  }else{
    return false;
  }
}

//check if adminname exists in the database
function check_admin_id($adminid){
  $result = get_var("SELECT a_id FROM admin WHERE a_id = $adminid");
  if($result !=0){
    return true;
  }else return false;
}


function user_update_by_service($s_id,$a_id){
  $s_id = intval($s_id);
  $a_id = intval($a_id);
  if($s_id!=0){
    get_result("UPDATE user SET state=3 WHERE s_id = $s_id AND state=1 ORDER BY time_in ASC LIMIT 1");
    get_result("UPDATE user SET state=1,a_id=$a_id WHERE s_id = $s_id AND state=0 ORDER BY time_in ASC LIMIT 1");
    return true;
  }else{
    return false;
  }
}

function user_update_state(){
  $a_id = 1;
  get_result("UPDATE user SET state=2 WHERE a_id = $a_id ORDER BY time_in ASC LIMIT 1");
}

function reset_queue($s_id){
  $s_id = intval($s_id);
  get_result("UPDATE user SET state=4 WHERE s_id = $s_id AND (state=0 OR state=1) ORDER BY time_in ASC");
}

function new_service($name){
  global $mysqli;
  $name=$mysqli->real_escape_string($name);
  $c_id = (isset($_SESSION['c_id']))? $_SESSION['c_id'] : 1;
  $mysqli->query("INSERT INTO service(name,c_id) VALUES('$name',$c_id)");
  $s_id= $mysqli->insert_id;
  return $s_id;
}

//Get s_id from db with u_id
function get_s_id($u_id){

    $u_id = intval($_GET['u_id']);
    return get_var("SELECT s_id FROM user WHERE u_id=$u_id");

}

//Get inline number with u_id and s_id
function get_inline_user($u_id){
  $u_id = intval($u_id);
  $s_id = intval(get_s_id($u_id));
  $result = get_result("SELECT u_id FROM user WHERE s_id=$s_id AND state=0 AND u_id < $u_id");
  return($result->num_rows);
}
function get_queue_number($u_id){

    $u_id = intval($_GET['u_id']);
    return get_var("SELECT q_no FROM user WHERE u_id=$u_id");

}

function sendSMS ($sms) {
  // Set your 46elks API username and API password here
  // You can find them at https://dashboard.46elks.com/
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


function makeSMS($phone_no,$in_line,$link,$q_no)
{
  $temp = (string)$phone_no;
  $temp1 = substr($temp,1);
  $num = '+46'.$temp1;
	return array(
	'from' => 'Queue',
	'to' => $num,
	'message' => "Your number is ".(string)$q_no.".\nThere are ".(string)$in_line."people in queue, click on the link: \n".$link
);
}
