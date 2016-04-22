<?php


// Check if the number is submited
if(isset($_POST['number'])){

  // Open connection to db
  $mysqli = new mysqli('localhost','root', '', 'delphi') or die ('Error connecting to mysql: ' . mysqli_error($link));

  // Setup the varibles & Clean the data
  $number = $mysqli->real_escape_string($_POST['number']);
  $time_in = time();
  $s_id = intval($_POST['service_id']); // make sure it's a number

  // Check the service id
  if($s_id!=0){
    // Run the query
    $mysqli->query("INSERT INTO user(phone_no,time_in,s_id) VALUES('$number',$time_in,$s_id)");
  }


}else{
  header("Location: index.php");
}
