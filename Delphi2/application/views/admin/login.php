<?php $this->load->view('admin/header'); ?>

<div class="container">
  <div class="companyimagebackground">
         <img class="loginimage" src="<?php echo site_url('assets/admin/logo.svg'); ?>" alt="" />
  </div>



    <?php if(isset($_GET['wrong'])){ echo '<div class="errorbox"><b>⚠ Incorrect!</b>  Identification was not found </div>';} ?>


     <div class="s1 companys1">
       <div class="containH">
         <h1 class="header"> <img src="<?php echo site_url('assets/admin/Admin.svg'); ?>" class="icon" />Admin Login</h1>
       </div>

       <div class="inners1">
         <form action="" method="post">
           <input type="text" class="infoc row inloginhead" name="a_id" value="" placeholder="Admin ID" >
           <input class="button" type="submit" name="login_button" value="LOG IN">
         </form>

       </div>

     </div>
   </div>

</body>
</html>
