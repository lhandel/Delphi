<?php include '../function.php';  protect("company");  ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" charset="utf-8"></script>
    <script src="assets/script.js" charset="utf-8"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:500,700,400|Open+Sans:400,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="assets/style.css" media="screen" title="no title" charset="utf-8">

  </head>
  <body onload="startLiveUpdate()">
  <?php
  include 'menu.php';
   ?>



    <div class="settingscontainer">
      <!-- TABLE -->
      <table width="100%" cellpadding="0" cellspacing="0" border="0" class="list link">
            <tbody>
            <!-- Php code for getting all relevant info about each company services -->
            <?php
            $c_id = $_SESSION["c_id"];
            $result = get_services($c_id);
            while($row = $result->fetch_assoc()){
              ?>

              <tr>

                <!-- Service name -->
                <td class="ttitle tmain">
                  <a href="service.php?s_id=<?php echo $row['s_id'];?>" class="ta">
                    <?php  echo $row['name']?>
                  </a>

                </td>

                <!-- Reminder time-->
                <td class="ttitle ticons" onclick="popup_s('<?php echo 'rem';?>',<?php echo $row['s_id'];?>)">
                    <?php echo $row['r_time'];?>


                  <div class="annotation">
                    Change reminder time
                  </div>
                </td>

                <!-- Edit name -->
                <td class="ttitle ticons" onclick="popup_s('<?php echo 'edit';?>',<?php echo $row['s_id'];?>)">
                    <i class="fa fa-pencil" aria-hidden="true"></i>


                  <div class="annotation">
                    Click to edit name of service
                  </div>
                </td>


                <!-- Reset Queue -->
                <td class="ttitle ticons" onclick="if(confirm('Are you sure?')) document.location='update.php?s_id=<?php echo $row["s_id"];?>&reset=true'">

                    <i class="fa fa-recycle" aria-hidden="true"></i>

                  <div class="annotation">
                    Click to reset queue
                  </div>
                </td>

                <!-- Remove service -->
                <td class="ttitle ticons" onclick="if(confirm('Are you sure?')) document.location='update.php?s_id=<?php echo $row["s_id"];?>&remove=true'">


                    <i class="fa fa-trash-o" aria-hidden="true"></i>

                  <div class="annotation">
                    Click to remove service
                  </div>
                </td>

              </tr>

              <?php } ?> <!-- End of while-loop -->

            </tbody>
          </table> <!-- End of table -->
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
