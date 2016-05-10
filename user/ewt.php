<?php
  include '../function.php';
  header("Content-type: application/json; charset=ut8");


  $u_id = intval($_GET['u_id']);
    $time = ewt_for_user(get_s_id($u_id),$u_id);
  //

  //  $display = sprintf("%02d", $ewt/60) .":" . sprintf("%02d", $ewt%60);
    $data = array(

      "title"   =>  "ok",
      "content" =>  $time
    );
    echo json_encode($data);
