<?php $this->load->view('admin/header'); ?>
<div class="settingscontainer">
    <!-- TABLE -->
    <table width="100%" cellpadding="0" cellspacing="0" border="0" class="list link">
          <tbody>
          <!-- Php code for getting all relevant info about each company services -->
            <?php foreach($services as $row){ ?>

            <tr>

              <!-- Service name -->
              <td class="ttitle tmain">
                <a href="<?php echo site_url('index.php/admin/service?s_id='.$row->s_id); ?>" class="ta">
                  <?php  echo $row->name?>
                </a>
                <div class="annotation">
                  Name of service. Click will get you to service
                </div>
              </td>

              <!-- Reminder time-->
              <td class="ttitle ticons">
                <a href="#" class="ta" onclick="popup_s('rem',<?php echo $row->s_id;?>)"><!-- ändra länk till popup rutan-->
                  <?php echo $row->r_time;?>
                </a>

                <div class="annotation">
                  Change reminder time
                </div>
              </td>

              <!-- Edit name -->
              <td class="ttitle ticons">
                <a href="#" class="ta" onclick="popup_s('edit',<?php echo $row->s_id;?>)">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>

                <div class="annotation">
                  Click to edit name of service
                </div>
              </td>


              <!-- Reset Queue -->
              <td class="ttitle ticons">
                <a href="<?php echo site_url('index.php/admin/settings?s_id='.$row->s_id.'&reset=true'); ?>" class="ta">
                  <i class="fa fa-recycle" aria-hidden="true"></i>
                </a>
                <div class="annotation">
                  Click to reset queue
                </div>
              </td>

              <!-- Remove service -->
              <td class="ttitle ticons">

                <a href="<?php echo site_url('index.php/admin/settings?s_id='.$row->s_id.'&s_remove=true'); ?>" class="ta">
                  <i class="fa fa-trash-o" aria-hidden="true"></i>
                </a>
                <div class="annotation">
                  Click to remove service
                </div>
              </td>

            </tr>

            <?php } ?> <!-- End of while-loop -->

          </tbody>
        </table> <!-- End of table -->
        <div class="container-popup">
            <div class="popup">
              <form class="popup1 row" action="" method="post">
                <input type="text" name="content" id="contID" class="textfield row" value="">
                <input type="hidden" name="s_id" id="sID" value="">
                <input type="submit" class="button row"  name="" id="settingButton" value="Save Changes">
              </form>
            </div>
        </div>

        <div class="row themePicker">

          <div class="squareTheme_container" onclick="document.location = '<?php echo site_url("index.php/admin/settings?theme=green") ?>'">
            <div class="squareTheme <?php if($theme_name=='green') echo 'active'; ?>"></div>
            <span>Summer green</span>
          </div>

          <div class="squareTheme_container" onclick="document.location='<?php echo site_url("index.php/admin/settings?theme=blue") ?>'">
            <div class="squareTheme blue <?php if($theme_name=='blue') echo 'active'; ?>"></div>
            <span>Deep ocean blue</span>
          </div>

          <div class="squareTheme_container" onclick="document.location='<?php echo site_url("index.php/admin/settings?theme=red") ?>'">
            <div class="squareTheme red <?php if($theme_name=='red') echo 'active'; ?>"></div>
            <span>Passionate <br/>red</span>
          </div>

          <div class="squareTheme_container" onclick="document.location='<?php echo site_url("index.php/admin/settings?theme=dark") ?>'">
            <div class="squareTheme dark <?php if($theme_name=='dark') echo 'active'; ?>"></div>
            <span>Liquorice<br/> Black</span>
          </div>

        </div>


  </div>
</body>
</html>
