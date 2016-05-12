<?php include '../function.php';  protect("company");  ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin Management</title>
  </head>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" charset="utf-8"></script>
  <script src="assets/script.js" charset="utf-8"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
  <link href='https://fonts.googleapis.com/css?family=Ubuntu:500,700,400|Open+Sans:400,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="assets/style.css" media="screen" title="no title" charset="utf-8">

  <body>
    <?php
      include 'menu.php';
    ?>

    <div class="settingscontainer">
      <table width="100%" cellpadding="0" cellspacing="0" border="0" class="list link">
            <tbody>
            <?php
            $c_id = $_SESSION["c_id"];
            $result = get_admins($c_id);


            while($row = $result->fetch_assoc()){

              ?>
              <tr>
                <td class="ttitle tmain">
                  <?php  echo $row['admin_name'];?>
                  <div class="annotation">
                    Name of service. Click will get you to service
                  </div>
                </td>
<!-- Testar härifrån-->
                <td class="ttitle ticons">

                  <a href="#" class="ta" onclick="popup_s('<?php echo 'rem';?>',<?php echo $row['s_id'];?>)"><!-- ändra länk till popup rutan-->
                  

                  </a>

<!-- hit -->
                  <div class="annotation">
                    Change reminder time
                  </div>
                </td>

                <td class="ttitle ticons">
                  <a href="#" class="ta" onclick="popup_s('<?php echo 'edit';?>',<?php echo $row['s_id'];?>)">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                  </a>

                  <div class="annotation">
                    Click to edit name of service
                  </div>
                </td>



                <td class="ttitle ticons">
                  <a href="update.php?s_id=<?php echo $row["s_id"];?>&reset=true" class="ta">
                    <i class="fa fa-recycle" aria-hidden="true"></i>
                  </a>
                  <div class="annotation">
                    Click to reset queue
                  </div>
                </td>
                <td class="ttitle ticons">

                  <a href="update.php?s_id=<?php echo $row["s_id"];?>&remove=true" class="ta">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                  </a>
                  <div class="annotation">
                    Click to remove service
                  </div>
                </td>
              </tr>
              <?php } ?>

            </tbody>
          </table>
          <div class="container-popup">
              <div class="popup">
                <form class="popup1 row" action="update.php" method="post">
                  <input type="text" name="content" id="contID" class="textfield row" value="">
                  <input type="hidden" name="s_id" id="sID" value="">
                  <input type="submit" class="button row"  name="" id="settingButton" value="Save Changes">
                </form>
              </div>
          </div>
    </div>

  </body>
</html>
