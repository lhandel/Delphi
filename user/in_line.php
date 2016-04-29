<?php
  include '../function.php';
  header("Content-type: application/json; charset=ut8");

  $data = array(

    "title"   =>  "ok",
    "content" =>  (string)get_inline_user($_GET['u_id'])
  );
  echo json_encode($data);
