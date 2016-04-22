<?php


// Check if the number is submited
if(isset($_POST['number'])){

  // Open connection to db
  $mysqli = new mysqli('localhost','root', '', 'delphi') or die ('Error connecting to mysql: ' . mysqli_error($link));

  // Setup the varibles & Clean the data
  $number = $mysqli->real_escape_string($_POST['number']);
  $time_in = time(); // time() return the unix timestamp
  $s_id = intval($_POST['service_id']); // make sure it's a number

  // Get the queue-number
  $result = $mysqli->query("SELECT q_no FROM user WHERE s_id=$s_id ORDER BY u_id DESC LIMIT 1");

  if($result->num_rows==0){
    $q_no = 1;
  }else{
    $data = $result->fetch_assoc();
    $q_no = ($data['q_no'])+1;
  }
  // Check the service id
  if($s_id!=0){
    // Run the query and insert into db
    $mysqli->query("INSERT INTO user(phone_no,time_in,s_id,q_no) VALUES('$number',$time_in,$s_id,$q_no)");

    // send the user to the next page
    header("Location: done.php?q_no=".$q_no."&phone_nr=".$_POST['number']);

  }


}else{
  header("Location: index.php");
}
