<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>login</title>
    <link rel="stylesheet" href=<?php echo base_url('assets/admin/style.css') ?> media="screen" title="no title" charset="utf-8">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:500,700,400|Open+Sans:400,600' rel='stylesheet' type='text/css'>


  </head>
  <body>
    <div class="container">
       <div class="companyimagebackground">
              <img class="loginimage" src="<?php echo site_url('assets/admin/logo.svg') ?>" alt="" />
       </div>



         <?php if(isset($_GET['wrong'])){ echo '<div class="errorbox"><b>⚠ Incorrect!</b>  Password and id does not match. </div>';} ?>




          <div class="s1 companys1">
            <div class="inners1">
              <form action="" method="post">

                <input class="infoc row inloginhead" type="text" name="company_id" value="" placeholder="Company ID">
                <input class="infoc row inlogin" type="password" name="password" value="" placeholder="Password">
                <input name="c_submit" class="button cbutton" type="submit" value="LOG IN">
              </form>
            </div>
          </div>
        </div>

  </body>
</html>
