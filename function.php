<?php
session_start();
//connect to database
include 'db.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

function ewt_for_user($s_id,$u_id){
  $ewt = get_result("SELECT
                          (
                              AVG(time_out-time_start)*
                              (
                                (SELECT COUNT(u_id) FROM user WHERE s_id=$s_id AND u_id<$u_id AND (state=0 OR state=1))
                              )
                          )
                          as ewt,
                          (SELECT COUNT(DISTINCT a_id) FROM user WHERE state=1 AND s_id=$s_id) as handlers
                           FROM user WHERE s_id=$s_id AND (state=3 OR state=2) AND time_out!=0 ORDER BY u_id DESC LIMIT 20");
  $data = $ewt->fetch_assoc();

  if($data['handlers']==0)
    return ceil($data['ewt']/60);
  else
    return ceil(($data['ewt']/$data['handlers'])/60);

}

function ewt_for_user2($s_id,$u_id){

  $ewt = get_result("SELECT
                          (
                              AVG(time_out-time_start)*
                              (
                                (SELECT COUNT(u_id) FROM user WHERE s_id=$s_id AND u_id<$u_id AND (state=0 OR state=1))
                              )
                          )
                          as ewt,
                          (SELECT time_start FROM user WHERE s_id=$s_id AND  state=1 ORDER BY time_start ASC LIMIT 1) as timer,
                          (SELECT COUNT(DISTINCT a_id) FROM user WHERE state=1 AND s_id=$s_id) as handlers
                           FROM user WHERE s_id=$s_id AND (state=3 OR state=2) AND time_out!=0 ORDER BY u_id DESC LIMIT 20");
  $data = $ewt->fetch_assoc();

  $array =  array
            (
              'ewt' => ($data['handlers']==0)? $data['ewt'] : $data['ewt']/$data['handlers'],
              'timer' => $data['timer']
            );
  return $array;


}

function ewt($s_id){
  $ewt = get_result("SELECT
                          (
                              AVG(time_out-time_start)*
                              (SELECT COUNT(u_id) FROM user WHERE s_id=$s_id AND (state=0 OR state=1))

                          )
                          as ewt,
                          (SELECT COUNT(DISTINCT a_id) FROM user WHERE state=1 AND s_id=$s_id) as handlers
                           FROM user WHERE s_id=$s_id AND (state=3 OR state=2)  AND time_out!=0 LIMIT 10");
  $data = $ewt->fetch_assoc();

  if($data['handlers']==0)
    return ceil($data['ewt']/60);
  else
    return ceil(($data['ewt']/$data['handlers'])/60);

}

function checkSMS($s_id){

    $reminder_time = get_var("SELECT r_time FROM sercive WHERE s_id=$s_id");

    if ($reminder_time==0) {
      $reminder_time=5;
    }

    $result = get_result("SELECT phone_no,u_id FROM user  WHERE s_id=$s_id AND r_sms=0 AND state=0 ORDER BY u_id ASC LIMIT 5");
    while($p_and_u = $result->fetch_assoc()){

      $data_pn=$p_and_u['phone_no'];
      $u_id=$p_and_u['u_id'];

      $ewt_data = ewt_for_user($s_id,$u_id);
      $user_in_front = get_result("SELECT u_id FROM user WHERE s_id =$s_id AND u_id <$u_id AND (state = 0)");
      $numb_users = $user_in_front->num_rows;

      $ongoing=("SELECT AVG(time_out-time_start)*((SELECT COUNT(u_id) FROM user WHERE s_id=$s_id AND u_id<$u_id AND (state=3) ");
      $diff=$ewt_data-$ongoing;


      if (($reminder_time > $diff && $ewt_data!=0) || $numb_users ==1) {
        sendSMS(makeReminder($data_pn));
        get_result("UPDATE user SET r_sms=1 WHERE u_id = $u_id AND s_id=$s_id");
      }
    }
}


function protect($for="admin"){

  $url = (strpos($_SERVER["REQUEST_URI"],"admin"))? '../': '';

  if($for=="admin"){
    if(!isset($_SESSION['a_id']))
      header("Location: index.php");
  }elseif($for=="instore"){
    if(!isset($_SESSION['c_id']))
      header("Location: ../index.php");
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
                            r_time,
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
                              r_time,
                              (SELECT COUNT(u_id) FROM user WHERE state=0 AND s_id=service.s_id) as queue_count,
                              (SELECT COUNT(DISTINCT a_id) FROM user WHERE state=1 AND s_id=service.s_id) as handler
                        FROM service WHERE c_id=$c_id AND state=0");
    return $result;
  }else{
    return false;
  }
}

/*get admins for the company*/

function get_admins($c_id=1){
  $c_id = intval($c_id);

  if($c_id!=0){
    $result = get_result("SELECT
                              a_id,
                              admin_name
                        FROM admin WHERE c_id=$c_id");

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
  checkSMS($s_id);

  if($s_id!=0){
    get_result("UPDATE user SET state=3,time_out=".time()." WHERE s_id = $s_id AND state=1 ORDER BY time_in ASC LIMIT 1");
    get_result("UPDATE user SET state=1,a_id=$a_id,time_start=".time()." WHERE s_id = $s_id AND state=0 ORDER BY time_in ASC LIMIT 1");
    return true;
  }else{
    return false;
  }
}

function user_update_state(){
  $a_id = 1;
  get_result("UPDATE user SET state=2 WHERE a_id = $a_id ORDER BY time_in ASC LIMIT 1");
}

//for admin page

function reset_queue($s_id){
  $s_id = intval($s_id);
  get_result("UPDATE user SET state=4 WHERE s_id = $s_id AND (state=0 OR state=1) ORDER BY time_in ASC");
}

function hide_service($s_id){
  get_result("UPDATE service SET state=1 WHERE s_id = $s_id AND (state=0)");

}

function remove_service($s_id){
  reset_queue($s_id);
  //hide sercive
  hide_service($s_id);
}

function new_service($name){
  global $mysqli;
  $name=$mysqli->real_escape_string($name);
  $c_id = (isset($_SESSION['c_id']))? $_SESSION['c_id'] : 1;
  $mysqli->query("INSERT INTO service(name,c_id,r_time) VALUES('$name',$c_id,5)");
  $s_id= $mysqli->insert_id;
  return $s_id;
}

//----

//Get s_id from db with u_id
function get_s_id($u_id){

    return get_var("SELECT s_id FROM user WHERE u_id=$u_id");

}

function get_flag($u_id){


    return get_var("SELECT r_sms FROM user WHERE u_id=$u_id");

}

//Get inline number with u_id and s_id
function get_inline_user($u_id){
  $u_id = intval($u_id);
  $s_id = intval(get_s_id($u_id));
  $result = get_result("SELECT u_id FROM user WHERE s_id=$s_id AND (state=0 OR state=1) AND u_id < $u_id");
  return($result->num_rows);
}
function get_queue_number($u_id){

    return get_var("SELECT q_no FROM user WHERE u_id=$u_id");

}

function sendSMS ($sms) {
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


function makeSMS($phone_no,$in_line,$link1,$q_no,$user,$s_id)
{
  $temp = (string)$phone_no;
  $temp1 = substr($temp,1);
  $num = '+46'.$temp1;
	return array(
	'from' => 'Queue',
	'to' => $num,
	'message' => "Your number is ".(string)$q_no.".\nThere are ".(string)$in_line." people in queue. Please return to DQ in ".ewt_for_user($s_id,$user)." minutes. Track yourself here ".$link1
);
}

function makeReminder($phone_no)
{
  $temp = (string)$phone_no;
  $temp1 = substr($temp,1);
  $num = '+46'.$temp1;
	return array(
	'from' => 'Queue',
	'to' => $num,
	'message' => "It is almost your turn, please return to the store."
);
}

function makeSkipSMS($phone_no)
{
  $temp = (string)$phone_no;
  $temp1 = substr($temp,1);
  $num = '+46'.$temp1;
	return array(
	'from' => 'Queue',
	'to' => $num,
'message' => "You where skipped"
);
}

function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function use_theme($c_id){
    $theme = get_var("SELECT theme FROM company WHERE c_id=$c_id");
    if ($theme === "dark"){
      return "class = 'dark'";
    }
    return "";
}
