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

      <table width="100%" cellpadding="0" cellspacing="0" border="0" class="list link">
            <tbody>
            <?php
            $c_id = $_SESSION["c_id"];
            $result = get_services($c_id);

            while($row = $result->fetch_assoc()){
              ?>
              <tr>
                <td class="ttitle tmain">
                  <?php  echo $row['name']?>
                  <div class="annotation">
                    Name of service. Click will get you to service
                  </div>
                </td>
                <td class="ttitle ticons">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
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


    </div>
  </body>
</html>
