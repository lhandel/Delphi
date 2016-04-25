<?php
//connect to database
  include 'db.php';

//dynamic service title
function get_service_name($s_id){
    $s_id = intval($s_id);
    return get_var("SELECT name FROM service WHERE s_id=$s_id LIMIT 1");
}

//extract first value/variable in database
function get_var($query){
  $result = get_result($query);
  if ($result->num_rows == 0)
  {
    return false;
  }
  else {
    // Pop the value
    $service = $result->fetch_assoc();
    // Get the search colum by split the query
    $split = explode(' ',$query);
    // Return the selected colum value
    return $service[$split[1]];
  }
}

//connection to sql return result
function get_result($query){
  // Import our global mysqli-varible
  global $mysqli;

  // Run the query
  $result = $mysqli->query($query);

  return $result;

}

//get how many people in queue
function get_inline($s_id){
  $s_id = intval($s_id);
  $result = get_result("SELECT * FROM user WHERE s_id=$s_id AND state=0");
  return($result->num_rows);
}
