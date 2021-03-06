<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" charset="utf-8"></script>
    <script src="<?php echo site_url('assets/admin/script.js'); ?>" charset="utf-8"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:500,700,400|Open+Sans:400,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo site_url('assets/templates.css'); ?>" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="<?php echo site_url('assets/admin/style.css'); ?>" media="screen" title="no title" charset="utf-8">

  </head>
  <body <?php echo $theme; ?>>
    <?php if(isset($_GET['logout']))
      $this->session->unset_userdata('a_id');?>
  <div class="menuToggle">
    <i class="fa fa-bars" aria-hidden="true"></i>
  </div>
  <div class="menu">
    <a href="<?php echo site_url('index.php/admin/listService'); ?>"><img src="<?php echo site_url('assets/admin/logo.svg'); ?>" alt="" /></a>
    <ul>
      <li><a href="<?php echo site_url('index.php/admin/listService'); ?>" id="item1"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
      <li><a href="<?php echo site_url('index.php/admin/statistic'); ?>" id="item2"><i class="fa fa-bar-chart" aria-hidden="true"></i> Statistic</a></li>
      <li><a href="<?php echo site_url('index.php/admin/login?url='); ?><?php echo urlencode(site_url('index.php/admin/adminManagement')); ?>" id="item3"><i class="fa fa-users" aria-hidden="true"></i> Admin Management</a></li>
      <li><a href="<?php echo site_url('index.php/admin/login?url='); ?><?php echo urlencode(site_url('index.php/admin/serviceManagement')); ?>" id="item4"><i class="fa fa-th-list" aria-hidden="true"></i> Service Management</a></li>
      <li><a href="<?php echo site_url('index.php/admin/login?url='); ?><?php echo urlencode(site_url('index.php/admin/settings')); ?>" id="item5"><i class="fa fa-wrench" aria-hidden="true"></i> Settings</a></li>

      <!-- Checking if logged in or not -->
      <li ><?php if ($this->session->userdata('a_id')){ ?>
        <a href="<?php echo site_url('index.php/admin?logout=true');?>"><i class="fa fa-unlock" aria-hidden="true"></i>
      </i> Log Out
        </a>
      <?php } else{?>
        <a href="<?php echo site_url('index.php/admin/login/?url=').urlencode(site_url('index.php/admin'));?>"><i class="fa fa-lock" aria-hidden="true"></i>
 Log in
        </a>

        <?php  }?>
      </li>
    </ul>



  </div>
