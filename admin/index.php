<?php include '../function.php'; ?>
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
  <body>
  <?php
  include 'menu.php';
   ?>

    <div class="container">

      <?php
      $c_id = 1;
      $result = get_services($c_id);
      while($row = $result->fetch_assoc()){

      ?>
      <div class="row">
        <div class="s1">

      <div class="row">
          <!-- insert a_id -->
          <a href=<?php echo "adminlogin.php?s_id=".$row['s_id']; ?> class="btn"> <h1> <?php echo $row["name"];?> <i class="fa fa-angle-right" aria-hidden="true"></i><h1> </a>
      </div>
        <div class="row">
          <div class="infoc">
              <div class="est">
                <div class="icon">
                  <i class="fa fa-clock-o" aria-hidden="true"></i>
                </div>

                <h1 class="stat" >22</h1>
                <h2>est. time</h2>

              </div>
              <div class="handler">
                <img class = "icon" src="assets/Admin.svg" alt="" />
                <h1 class="stat" >
                  2
                </h1>
                <h2>Handlers</h2>
              </div>
              <div class="queue">
                <img class = "icon" src="assets/QueueGrey.svg" alt="" />
                <h1 class="stat" ><?php echo $row["q_count"]; ?></h1>
                <h2>Queue</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php  }?>
    </div>
  </body>
</html>
