<?php include '../function.php'; ?>
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
        <?php $in_line=get_inline($_GET['service']);?>
        <h3 class="log_in3">
          <a href="index.php"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>  <?php echo get_service_name($_GET['service']); ?>
        </h3>
        <h2 class="log_in2">Enter your MOBILE number below to enter the queue</h2>

        <div class="log_in">

          <form action="submit.php" method="post">
            <input type="hidden" name="in_line" value=<?php echo $in_line; ?>>
            <input type="hidden" name="service_id" value="<?php echo $_GET['service']; ?>">
            <input id="number" name="number" type="text" pattern="[0-9]{10}" title="07XXXXXXXX (10 digits)" placeholder="Enter your mobile number">
            <input id="submit_button" type="submit" value="Register">
          </form>


        </div>
        <div class="login_display">
          <img class="icon queue" src="assets/Queue.svg" alt="" />
          <div class="icon time_icon">
          </div>
          <div class="info">
            <p class="important"><?php echo $in_line?></p>
            <p class="info">people <br/>in front</p>
          </div>
          <div class="info">
            <p class="important"><?php $number=ceil(ewt($_GET['service'])); echo $number; ?></p>
            <p class="info">minute<?php if($number!=1) echo 's'; ?> <br/>left</p>
          </div>
        </div>

    </div>

  </body>
</html>
