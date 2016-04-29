<?php
//connect to database
include '../function.php';

// Check if the number is submited
if(isset($_POST['number'])){

  // Setup the varibles & Clean the data
  $number = $mysqli->real_escape_string($_POST['number']);
  $time_in = time(); // time() return the unix timestamp
  $s_id = intval($_POST['service_id']); // make sure it's a number

  // Get the queue-number
  $result = get_var("SELECT q_no FROM user WHERE s_id=$s_id AND state=0 ORDER BY u_id DESC LIMIT 1");

  //sendSMS(makeSMS($_POST['number'],$_POST['in_line']));


  if($result==false){
    $q_no = 1;
  }else{
    $q_no = $result+1;
  }
  // Check the service id
  if($s_id!=0){
    // Run the query and insert into db
    $mysqli->query("INSERT INTO user(phone_no,time_in,s_id,q_no) VALUES('$number',$time_in,$s_id,$q_no)");

    // send the user to the next page
    $uid= $mysqli->insert_id;
    $link = 'http://46.101.97.62/user/?u_id='.$uid;

    sendSMS(makeSMS($_POST['number'],$_POST['in_line'],$link,$q_no));
    header("Location: done.php?q_no=".$q_no."&phone_nr=".$_POST['number']."&service=".$s_id);

  }


}else{
  header("Location: index.php");
}
