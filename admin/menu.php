<div class="menuToggle">
  <i class="fa fa-bars" aria-hidden="true"></i>
</div>
<div class="menu">
  <a href="index.php"><img src="assets/logo.svg" alt="" /></a>
  <ul>
    <li><a href="index.php" id="item1"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
    <li><a href="statistic.php" id="item2"><i class="fa fa-bar-chart" aria-hidden="true"></i> Statistic</a></li>
    <li><a href="settings.php" id="item3"><i class="fa fa-wrench" aria-hidden="true"></i> Settings</a></li>
  </ul>




      <a href="logout.php" id="lo"><?php
      if (isset($_SESSION['a_id'])){
        $a_id = intval($_SESSION['a_id']);
        echo get_var("SELECT admin_name FROM admin WHERE a_id=$a_id");
        echo " - Logout?";
      }
      ?></a>

  
</div>
