<?php
  include '../function.php';
  header("Content-type: application/json; charset=ut8");


  $data = ewt($_POST['s_id']);


  echo json_encode($data);
