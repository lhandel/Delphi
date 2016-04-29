<?php
//connect to database
  include '../db.php';

$u_id = intval($_GET['u_id']);

// Check the service id
if($u_id!=0){
    // Putting updated information to varaible sql
    $sql = "UPDATE user SET state='2' WHERE u_id=$u_id";

}
// run the query and update mysql database
if ($mysqli->query($sql) === TRUE) {
            header("Location: success.php");
} else {
      echo "Error updating record: " . $mysqli->error;
}

$mysqli->close();
