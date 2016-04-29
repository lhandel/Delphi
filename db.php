<?php
//open database connection

$mysqli = new mysqli('localhost','root', '', 'delphi') or die ('Error connecting to mysql: ' . mysqli_error($link));



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

function get_row($query){
  // Import our global mysqli-varible
  global $mysqli;

  // Run the query
  $result = $mysqli->query($query);
  $row = $result->fetch_assoc();
  return $row;

}
