<?php
  session_start();

  if(isset($_SESSION["companysession"])){
    header("Location: index.php");
  }

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="assets/style.css" media="screen" title="no title" charset="utf-8">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:500,700,400|Open+Sans:400,600' rel='stylesheet' type='text/css'>
  </head>
  <body>



 <div class="container">

   <div class="companyimagebackground">
          <img class="loginimage" src="assets/logo.svg" alt="" />
   </div>



      <div class="login">

           <?php if(isset($_GET['wrong'])){ echo "Wrong password or id"; } ?>

        <form action="login.php" method="post">
          Company-id: <input class="logintext" type="text" name="company_id"><br>
          Password:   <input class="loginpass" type="password" name="password"><br>
          <input class="logininput" type="submit">
        </form>
      </div>

 </div>



  </body>
</html>
