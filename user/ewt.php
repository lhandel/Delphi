<?php
  include '../function.php';
  header("Content-type: application/json; charset=ut8");

  error_reporting(E_ALL);
ini_set('display_errors', 1);

    $pid = $mysqli->real_escape_string($_GET['public_id']);
    $data = get_result("SELECT u_id,s_id,r_sms,(SELECT COUNT(u_id) FROM user WHERE s_id=1 AND (state=0 OR state=1) AND u_id<u.u_id) as inline FROM user u WHERE public_id='$pid'");
    $data = $data->fetch_assoc();

    $s_id = $data['s_id'];
    $u_id = $data['u_id'];
    $flag = $data['r_sms'];

    $ewt = ewt_for_user2($s_id,$u_id);
    $better_ewt = $ewt['ewt']-(time()-$ewt['timer']);

    // if it takes longer time than average
    if($better_ewt<0){
      $better_ewt = 0;
    }



    $data = array(

      "title"   =>  "ok",
      "content" =>  ceil($better_ewt/60),
      "inline" => $data['inline'],
      "flag" => $flag
    );
    echo json_encode($data);
