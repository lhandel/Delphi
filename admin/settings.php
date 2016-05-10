<?php include '../function.php';  protect("company");  ?>
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
  <body onload="startLiveUpdate()">
  <?php
  include 'menu.php';
   ?>



    <div class="settingscontainer">

      <table width="100%" cellpadding="0" cellspacing="0" border="0" class="list link">
            <thead>
              <tr>
                <th>Företag</th>
                <th>Antal offerter</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            <tr>
              <td>
                <div class="ttitle">Hotel Express</div>
                <div class="subtitle">
                  Kristoffer
                </div>
              </td>
              <td>
                5st offerter
              </td>
              <td class="go">
                ›
              </td>
            </tr>
            <tr>
              <td>
                <div class="ttitle">K3 Nordic</div>
                <div class="subtitle">
                  Håkan Svanberg
                </div>
              </td>
              <td>
                2 offerter
              </td>
              <td class="go">
                ›
              </td>
            </tr>
            <tr>
              <td>
                <div class="ttitle">Företagsnam</div>
                <div class="subtitle">dsa</div>
              </td>
              <td>
                21 maj
              </td>
              <td class="go">
                ›
              </td>
            </tr>
            </tbody>
          </table>


    </div>
  </body>
</html>
