<?php
  include '../function.php';
  header("Content-type: application/json; charset=ut8");

  $pid = $mysqli->real_escape_string($_GET['public_id']);
  $u_id = get_var("SELECT u_id FROM user WHERE public_id='$pid'");

  $data = array(

    "title"   =>  "ok",
    "content" =>  (string)get_inline_user($u_id)
  );
  echo json_encode($data);
