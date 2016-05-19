<?php $this->load->view('admin/header'); ?>
<div class="settingscontainer">
    <!-- TABLE -->

    <div class="container-popup">
        <div class="popup">
          <form class="popup1 row" action="" method="post">
            <input type="text" name="content" id="contID" class="textfield row" value="">
            <input type="hidden" name="s_id" id="sID" value="">
            <input type="submit" class="button row"  name="" id="settingButton" value="Save Changes">
          </form>
        </div>
    </div>
    
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
                <a href="<?php echo site_url('index.php/admin/serviceManagement?s_id='.$row->s_id.'&reset=true'); ?>" class="ta">
                  <i class="fa fa-recycle" aria-hidden="true"></i>
                </a>
                <div class="annotation">
                  Click to reset queue
                </div>
              </td>

              <!-- Remove service -->
              <td class="ttitle ticons">

                <a href="<?php echo site_url('index.php/admin/serviceManagement?s_id='.$row->s_id.'&s_remove=true'); ?>" class="ta">
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
        <div class="adminrow">
          <div class="newadmin">

            <div class="adminrow">
              <div class="nainfo">
                <h1 class="nh2">New Service</h1>
                <h2 class="nh2"> Fill Out New Service Name</h2>
              </div>
              <div class="admin_name_inputfield">
                <form  action="" method="post" id="createNA">
                  <input type="text" name="a_content" class="nameinfo" value="">
                  <input type="hidden" name="a_id" id="sID" value="">
                </form>
              </div>

                  <button class="button assign" type="submit" name="new_admin" form="createNA" value="Submit"> Assign admin<i class="fa fa-angle-right" aria-hidden="true"></i> </button>

            </div>  <!-- end adminrow -->
          </div>  <!-- end newadmin -->
        </div>  <!-- end adminrow -->
      </body>
    </html>
