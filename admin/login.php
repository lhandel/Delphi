<?php include '../function.php';
$s_id= $_GET['s_id'];

if(isset($_SESSION['a_id'])){
  header("Location:service.php?s_id=$s_id");
}
if(isset($_POST['a_id'])){

  $a_id = trim($_POST['a_id']);
  // Check in db if adminname exist
  if (check_admin_id($_POST['a_id'])) {
    $_SESSION["a_id"] = $a_id;
    header("Location:service.php?s_id=$s_id");
  }else {
    header("Location:login.php?s_id=$s_id&wrong=true");
  }

}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin Login</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" charset="utf-8"></script>
    <script src="assets/script.js" charset="utf-8"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:500,700,400|Open+Sans:400,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="assets/style.css" media="screen" title="no title" charset="utf-8">

  </head>
  <body>
    <?php
    include 'menu.php';
     ?>
    <div class="container">

      <div class="loginblock">
        <h1 class="header"> <img src="assets/Admin.svg" class="icon" />Admin Login</h1>
        <?php
          if(isset($_GET['wrong']))
            echo 'Please try again!';
        ?>
        <form action="" method="post">
          <input id="adminname" type="text" name="a_id" value="" placeholder="YOUR ID" >
          <input id="login_button" type="submit" name="login_button" value="LOG IN">
        </form>

      </div>
        <img src="assets/logo.svg" class="logo">
    </div>

  </body>
</html>
