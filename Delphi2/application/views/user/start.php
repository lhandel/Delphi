<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>User Phone Number:
      <?php
      echo $phone_no;
      ?>
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="<?php echo site_url('assets/user/style.css'); ?>" media="screen" title="no title" charset="utf-8">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:500,700,400|Open+Sans:400,600' rel='stylesheet' type='text/css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" charset="utf-8"></script>

    <script src="assets/user/script.js" charset="utf-8"></script>
    <meta name="format-detection" content="telephone=no">
  </head>
  <body >
    <div class="container">
<!-- get u_id from SMS -->
      <script>
        var public_id = '<?php echo $p_id; ?>';
      </script>
      <div class="row topbox">
        <div id="clock_icon" class="clock-icon">
        </div>
        <div class="row clock-time">
          <p id="ewt_user"></p>
        </div>
        <div class="row hours-min">
          <span id="display_minute">min</span>
        </div>

        <div id="display_ewt" class="row est-time">
          Estimated waiting time
        </div>
      </div>

<!-- Ludde titta neråt härifrån -->
      <div class="row middlebox">
        <div class=" row q-no">
          <div class="ticket-icon"></div>
          <h2> <?php echo $queue_no; ?></h2>
          <div class="text">
            Your Queue</br> Number
          </div>
        </div>
        <div class="row verticalLine"></div>
        <div class="row people-infront">
          <div class="person-icon"></div>
          <h2 id="in_queue"></h2>
          <div class="text">
            People </br> in front
          </div>
        </div>

      </div>
      <div class="row">
        <a href="javascript:double_check('<?php echo "user/quit?u=".$p_id; ?>')" class="btn position-bottom" >Leave Queue</a>
        <script>
          function double_check(url) {
              var r = confirm("Are you sure?");
              if (r==true) {
                  document.location=url;              }
              }
        </script>
      </div>


    </div>
  </body>
</html>
