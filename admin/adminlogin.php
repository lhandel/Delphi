<?php include '../function.php';
$s_id= $_GET['s_id'];
if(isset($_POST['adminid'])){

  $admin_name = trim($_POST['adminid']);
  // Check in db if adminname exist
  if (check_admin_id($_POST['adminid'])) {
    $_SESSION["adminid"] = $a_id;
    header("Location:service.php?s_id=$s_id");
  }else {
    header("Location:adminlogin.php?s_id=$s_id");
  }

}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin Login</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:500,700,400|Open+Sans:400,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="assets/style.css" media="screen" title="no title" charset="utf-8">

  </head>
  <body>

    <div class="container">

      <div class="loginblock">
        <h1 class="header"> <img src="assets/Admin.svg" class="icon" />Admin Login</h1>

        <form action="" method="post">
          <input id="adminname" type="text" name="adminid" value="" placeholder="YOUR ID" >
          <input id="login_button" type="submit" name="login_button" value="LOG IN">
        </form>

      </div>
        <img src="assets/logo.svg" class="logo">
    </div>

  </body>
</html>
