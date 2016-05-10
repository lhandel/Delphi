<?php include '../function.php'; protect("instore"); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Instore</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <meta name="apple-mobile-web-app-capable" content="yes">

    <link rel="stylesheet" href="assets/style.css" media="screen" title="no title" charset="utf-8">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:500,700,400|Open+Sans:400,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
  </head>
  <body>
    <div class="container">
        <h1 class="startpage">What do you need<br/> help with?</h1>

        <?php
        $c_id = 1;
        $result = get_services($c_id);

        // This code is fixing the margin if we have 4 items in the list
        $special_class = '';
        if($result->num_rows==4){
          $special_class = 'remove_margin_top';
        }
        ?>

        <div class="btn_container <?php echo $special_class; ?>">

            <ul class="btn_list ">

              <?php while ($row = $result->fetch_assoc()){  ?>
                <li><a href="register.php?service=<?php echo $row['s_id']; ?>"><?php echo $row['name']; ?></a></li>
              <?php } ?>
            </ul>

        </div>

    </div>

    <img src="assets/logo.svg" class="logo">

  </body>
</html>
