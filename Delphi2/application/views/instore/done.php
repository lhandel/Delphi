
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Instore</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

    <meta name="apple-mobile-web-app-capable" content="yes">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link rel="stylesheet" href="<?php echo site_url('assets/templates.css'); ?>" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href=<?php echo base_url('assets/instore/style.css')?> media="screen" title="no title" charset="utf-8">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:500,700,400|Open+Sans:400,600' rel='stylesheet' type='text/css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" charset="utf-8"></script>
    <script type="text/javascript">

        $(document).ready(function(){

            $(".ticketbox").animate({top:'6px'},1500);

        });
    </script>
    <meta name="format-detection" content="telephone=no">
  </head>
  <body >
    <div class="container">

      <div class="row">
        <h1 class= "doneh1">Done <i class="fa fa-check-circle ml" aria-hidden="true"></i></h1>
        <h2 class= "doneh2">Here's your number</h2>
      </div>

      <div class="row">

        <div class="ticketcontainer">
            <div class="ttop"></div>
            <div class="ticketbox">
                <b><?php echo $q_no; ?></b>
                <div class="ticketlabel"> <?php echo $service; ?> </div>
            </div>
            <div class="tbottom"></div>
        </div>

      </div>

      <div class="row">
        <div class="p2">
          A SMS Has Been Sent To
        </div>

        <h1>
          <?php echo $phone_nr; ?>
        </h1>

        <p>
          SMS Can Take Up To 30s To Be Recieved
        </p>

      </div>

      <div class="row">

      </div>
      <div class="row">
        <a href="../instore" class="btn btndone">Finish</a>
      </div>
    </div>

  </body>
</html>
