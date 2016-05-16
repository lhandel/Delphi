
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Instore</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <meta name="apple-mobile-web-app-capable" content="yes">

    <link rel="stylesheet" href=<?php echo base_url('assets/instore/style.css') ?> media="screen" title="no title" charset="utf-8">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:500,700,400|Open+Sans:400,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
  </head>
  <body  <?php echo $theme?>>
    <div class="container">
        <h1 class="startpage">What do you need<br/> help with?</h1>



        <div class="btn_container " <?php echo $margin ?>>

            <ul class="btn_list ">
              <?php foreach($services as $row){  ?>
                  <li><a href="instore/register?service=<?php echo $row->s_id; ?>"><?php echo $row->name; ?></a></li>
              <?php } ?>
            </ul>

        </div>

    </div>

    <img src="<?php echo base_url('assets/instore/logo.svg') ?>" alt="" class="logo">

  </body>
</html>
