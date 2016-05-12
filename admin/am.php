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
                </td>
<!-- Testar härifrån-->
                <td class="ttitle ticons">

                  <a href="#" class="ta" onclick="popup_s('<?php echo 'rem';?>',<?php echo $row['s_id'];?>)"><!-- ändra länk till popup rutan-->

                  <?php echo $row['a_id']; ?>
                  </a>

                  <div class="annotation">
                    Admin id
                  </div>

<!-- hit -->

                </td>

                <td class="ttitle ticons">
                  <a href="#" class="ta" onclick="popup_s('<?php echo 'edit';?>',<?php echo $row['s_id'];?>)">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                  </a>

                  <div class="annotation">
                    Click to edit name of admin
                  </div>
                </td>




                <td class="ttitle ticons">

                  <a href="update.php?s_id=<?php echo $row["s_id"];?>&remove=true" class="ta">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                  </a>
                  <div class="annotation">
                    Click to remove admin
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

    <div class="row">
      <div class="s1 ns">

        <div class="row">
          <div class="nsinfo">
            <h1 class="nh2">
              New Admin
            </h1>
            <h2 class="nh2"> Fill Out New Admin Name</h2>
          </div>
        </div class="row">

        <div class="row">
          <form class="formErase" action="update.php" method="post" id="createNS">
            <input class="infoc" type="text" name="name" value="">
          </form>
        </div class="row">


        <div class="row">
          <button type="submit" form="createNS" value="Submit" class="btn servicebtn cns">  Create <i class="fa fa-angle-right" aria-hidden="true"></i> </button>
        </div>

      </div>

    </div class="row">

  </div>


  </body>
</html>
