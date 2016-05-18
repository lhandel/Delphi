
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Delphi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <meta name="apple-mobile-web-app-capable" content="yes">

    <link rel="stylesheet" href=<?php echo base_url('assets/main.css') ?> media="screen" title="no title" charset="utf-8">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:500,700,400|Open+Sans:400,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
  </head>
  <body>
    <div class="container">
        <h1 class="startpage">Join the queue</h1>
        <h3 class="choosemenu">Paper or By Phone</h3>

        <div class="btn_container">

            <ul class="btn_list ">
                <li><a href="<?php echo site_url("index.php/instore/paperDone/?s_id=$s_id"); ?>">Paper</a></li>
                <li><a href="<?php echo site_url("index.php/instore/register/?s_id=$s_id"); ?>"> Phone</a></li>
            </ul>

        </div>

    </div>

    <img src="<?php echo base_url('assets/instore/logo.svg') ?>" alt="" class="logo">

  </body>
</html>
