<?php include '../function.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin service</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <meta name="apple-mobile-web-app-capable" content="yes">
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
      <div class="row">
        <div class="service">

      <div class="row">
        <div class="title mg">
          <h1> <?php echo get_service_name($_GET['s_id']); ?> <h1>
        </div>

      </div>
          <div class="row">
            <div class="infoc">
              <div class="row">
                <div class="box_1">

                  <div class="est test2">
                    <div class="icon">
                      <i class="fa fa-clock-o" aria-hidden="true"></i>
                    </div>
                    <h1 class="stat" >22</h1>
                    <h2>est. time</h2>
                  </div>

                  <div class="handler test2">
                    <img class = "icon" src="assets/Admin.svg" alt="" />

                    <h1 class="stat" >
                      <?php echo $row["handlers"]; ?>
                    </h1>
                    <h2>Handlers</h2>

                  </div>
                </div>
              </div>

              <div class="row">
                <div class="box_2">

                  <div class="est new">
                    <div class="icon">
                      <i class="fa fa-clock-o" aria-hidden="true"></i>
                    </div>
                    <h1 class="stat" >22</h1>
                    <h2>est. time</h2>
                  </div>

                  <div class="queue new">
                    <img class = "icon" src="assets/QueueGrey.svg" alt="" />
                    <h1 class="stat" ><?php echo get_inline($_GET['s_id']); ?></h1>
                    <h2>Queue</h2>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

      <div class="row">
        <div class="b_1">
          <a href="update.php?s_id=<?php echo $_GET["s_id"];?>&next=true" class="btn_1">
            <h1>New customer</h1>
          </a>
        </div>
      </div>

      <div class="row">
        <div class="b_1">
          <a href="update.php?s_id=<?php echo $_GET["s_id"];?>&skip=true" class="btn_1"> <h1>Skip customer</h1></a>
        </div>
      </div>

      <div class="row">
        <div class="b_1">
          <a href="index.php" class="btn_1"> <h1>Change service</h1></a>
        </div>
      </div>

    </body>

</html>
