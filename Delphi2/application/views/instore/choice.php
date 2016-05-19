
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Delphi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <meta name="apple-mobile-web-app-capable" content="yes">


    <link rel="stylesheet" href="<?php echo site_url('assets/templates.css'); ?>" media="screen" title="no title" charset="utf-8">

    <link rel="stylesheet" href=<?php echo base_url('assets/instore/style.css') ?> media="screen" title="no title" charset="utf-8">

    <link href='https://fonts.googleapis.com/css?family=Ubuntu:500,700,400|Open+Sans:400,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
  </head>
  <body <?php echo $theme; ?>>
    <div class="container">
        <h3 class="log_in3">
          <a href="<?php echo site_url("index.php/instore"); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
          <b>Join the queue</b>
        </h3>



        <div class="btn_container">

            <ul class="btn_list ">
              <li><a href="<?php echo site_url("index.php/instore/register/?s_id=$s_id"); ?>">SMS Ticket</a></li>
              <li><a href="<?php echo site_url("index.php/instore/paperDone/?s_id=$s_id"); ?>">Paper Ticket</a></li>
            </ul>

        </div>
<!-- ********************************************* -->
        <div class="login_display">

          <div class="info">
            <img class="icon queue" src="<?php echo base_url('assets/instore/Queue.svg'); ?>" alt="" />
            <p class="important"><?php echo $inline?></p>
            <p class="info">People <br> In Queue</p>
          </div>
          <div class="info">
            <i class="fa fa-clock-o icon ticon queue" aria-hidden="true"></i>
            <p class="important"><?php echo $ewt?></p>
            <p class="info">Minutes <br> Left</p>
          </div>
        </div>

    </div>




    <img src="<?php echo base_url('assets/instore/logo.svg') ?>" alt="" class="logo">

  </body>
</html>
