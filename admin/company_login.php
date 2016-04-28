<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="assets/style.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>



 <div class="container">



      <div class="companybackground">

                <h1 class="company">FET LOGO</h1>

      </div>

      <div class="login">

           <?php if(isset($_GET['wrong'])){ echo "Wrong password or id"; } ?>

        <form action="login.php" method="post">
          Company-id: <input class="inputtext" type="text" name="company_id"><br>
          Password:   <input class="inputpass" type="password" name="password"><br>
          <input type="submit">
        </form>
      </div>

 </div>



  </body>
</html>
