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

          <a href=<?php echo "service.php?s_id=".$row['s_id']; ?> class="btn"> <h1> <?php echo $row["name"];?> <i class="fa fa-angle-right" aria-hidden="true"></i><h1> </a>
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
      <div class="row">
        <div class="s1 ns">

          <div class="row">
            <div class="btn">
              <h1 class="nh2">
                New Service
              </h1>
              <h2 class="nh2"> Fill Out New Service Name</h2>
            </div>
          </div class="row">

          <div class="row">
            <form class="formErase" action="update.php" method="post" id="createNS">
              <input class="infoc" type="text" name="name" value="">
            </form>
          </div class="row">


          <div class="row">
            <button type="submit" form="createNS" value="Submit" class="btn cns"> <h1> Create <i class="fa fa-angle-right" aria-hidden="true"></i><h1> </button>
          </div>

        </div>

      </div class="row">

    </div>
  </body>
</html>
