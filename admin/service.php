<?php include '../function.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title> Service 1</title>

    <link rel="stylesheet" href="assets/style.css" media="screen" title="no title" charset="utf-8">

  </head>
  <body>
    <div class="container">
        <div class="row">
          <div class="buttons">
            <a href="service.php?s_id=<?php echo $_GET["s_id"];?>&next=true " class="nextbutton"> Next
              <?php
              if(isset($_GET["next"])){
                  $s_id= $_GET["s_id"];

                  // $a_id= 2 updating a_id later, assigning a_id to the next person in line
                  $result = user_update_by_service($s_id);
              } ?>


            </a>
            <a href=index.php class="switch"> switch</a>
          </div>



        </div>


    </div>

  </body>
</html>
