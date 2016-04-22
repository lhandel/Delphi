<?php
//connect to database
  include 'db.php';

function get_service_name($s_id){

  //dynamic service title
    $s_id = intval($s_id);

    return get_var("SELECT name FROM service WHERE s_id=$s_id LIMIT 1");
}

function get_var($query){
  global $mysqli;
  $result = $mysqli->query($query);

  if($result->num_rows==0){
    return false;
  }else{
    $service = $result->fetch_assoc();
    $split = explode(' ',$query);
    return $service[$split[1]];
  }

}
