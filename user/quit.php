<?php
//connect to database
  include '../db.php';

$pid = $mysqli->real_escape_string($_GET['u']);

// Check the service id
if(isset($_GET['u'])){
    // Putting updated information to varaible sql
    $sql = "UPDATE user SET state='2' WHERE public_id=$pid";

    // run the query and update mysql database
    if ($mysqli->query($sql) === TRUE) {
                header("Location: success.php");
    } else {
          echo "Error updating record: " . $mysqli->error;
    }

}


$mysqli->close();
