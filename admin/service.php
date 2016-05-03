<?php include '../function.php';  protect("admin"); ?>
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
  $service = get_service($_GET['s_id']);
?>
<div class="container">


      <div class="row service">

          <div class="row">
            <div class="title mg">
              <h1> <?php echo $service['name']; ?> <h1>
            </div>
          </div>

          <div class="row">

            <div class="box_container">

              <div class="box first">
                <div class="icon">
                  <i class="fa fa-clock-o" aria-hidden="true"></i>
                </div>
                <div class="number">--</div>
                <h2>est. time</h2>
              </div>

              <div class="box first last">
                <div class="icon">
                  <img class = "icon" src="assets/Admin.svg" alt="" />
                </div>
                <div class="number"><?php echo $service['handler']; ?></div>
                <h2>Handlers</h2>
              </div>


              <div class="box">
                <div class="icon">
                  <i class="fa fa-hashtag" aria-hidden="true"></i>
                </div>
                <div class="number"><?php echo $service['current']; ?></div>
                <h2>Current number</h2>
              </div>

              <div class="box last">
                <div class="icon">
                  <img class = "icon" src="assets/QueueGrey.svg" alt="" />
                </div>
                <div class="number"><?php echo $service['queue_count']; ?></div>
                <h2>Queue</h2>
              </div>


            </div><!-- .endboxcontainer -->
          </div><!-- .end row -->
      </div><!-- .end row & servicebox -->



      <div class="row">
          <a href="update.php?s_id=<?php echo $_GET["s_id"];?>&next=true" class="button large">Next</a>
      </div>

      <div class="row">
        <div class="col-2">
            <a href="index.php" class="button">Change service</a>
        </div>
        <div class="col-2 last">
            <a href="update.php?s_id=<?php echo $_GET["s_id"];?>&skip=true" class="button">Skip customer</a>
        </div>
      </div>
      <div class="col-2">
          <a href="update.php?s_id=<?php echo $_GET["s_id"];?>&reset=true" class="button">Reset Queue</a>
      </div>
      <div class="col-2 last">
          <a href="update.php?s_id=<?php echo $_GET["s_id"];?>&remove=true" class="button">Remove Service</a>
      </div>

    </body>


</html>
