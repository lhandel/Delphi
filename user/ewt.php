<?php
  include '../function.php';
  header("Content-type: application/json; charset=ut8");


    $pid = $mysqli->real_escape_string($_GET['public_id']);

    $u_id = get_var("SELECT u_id FROM user WHERE public_id='$pid'");

    $time = ewt_for_user(get_s_id($u_id),$u_id);

    $flag = (string)get_flag($u_id);
  //

  //  $display = sprintf("%02d", $ewt/60) .":" . sprintf("%02d", $ewt%60);
    $data = array(

      "title"   =>  "ok",
      "content" =>  $time,
      "flag" => $flag
    );
    echo json_encode($data);
