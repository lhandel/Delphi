<?php
session_start();

if(isset($_SESSION["c_id"])){
  header("Location: ia.php");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="admin/assets/style.css" media="screen" title="no title" charset="utf-8">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:500,700,400|Open+Sans:400,600' rel='stylesheet' type='text/css'>
  </head>
  <body>



 <div class="container">

   <div class="companyimagebackground">
          <img class="loginimage" src="admin/assets/logo.svg" alt="" />
   </div>



      <div class="login">

           <?php if(isset($_GET['wrong'])){ echo "Wrong password or id"; } ?>

        <form action="login.php" method="post">
          <p class="logintext">Company ID:</p><input  type="text" name="company_id" value="">
          <p class="logintext">Password:</p><input  type="password" name="password" value="">
          <input class="logininput" type="submit" value="LOG IN">
        </form>
      </div>

 </div>



  </body>
</html>
