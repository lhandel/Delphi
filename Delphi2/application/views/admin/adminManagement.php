<?php $this->load->view('admin/header'); ?>

    <div class="settingscontainer">
      <table width="100%" cellpadding="0" cellspacing="0" border="0" class="list link">
            <tbody>

            <!-- Php code for getting all relevant info about each company services -->
            <?php foreach($services as $row){  ?>

              <tr>

                <!-- Admin ID -->
                <td class="ttitle tmain">
                  <?php  echo $row->admin_name;?>
                </td>

                <td class="ttitle ticons">
                  <?php echo $row->a_id; ?>
                  <div class="annotation">
                    Admin ID
                  </div>
                </td>

                <!-- Edit Admin Name -->

                <td class="ttitle ticons">
                  <a href="#" class="ta" onclick="popup_a(<?php echo $row->a_id;?>)">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                  </a>

                  <div class="annotation">
                    Edit name of admin
                  </div>
                </td>

                <!-- Remove service -->

                <td class="ttitle ticons">

                  <a href="<?php echo site_url("index.php/admin/adminManagement") ?>?a_id=<?php echo $row->a_id;?>&a_remove=true" class="ta">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                  </a>
                  <div class="annotation">
                    Remove admin
                  </div>
                </td>
              </tr>
              <?php } ?> <!-- End of while-loop -->

            </tbody>
          </table>
          <div class="container-popup">
              <div class="popup">
                <form class="popup1 row" action="" method="post">
                  <input type="text" name="a_content" id="contID" class="textfield row" value="">
                  <input type="hidden" name="a_id" id="aID" value="">
                  <input type="submit" class="button row"  name="a_edit" id="aButton" value="Save Changes">
                </form>
              </div>
          </div>
    </div>

   <!-- setting container -->

   <div class="adminrow">
     <div class="newadmin">

       <div class="adminrow">
         <div class="nainfo">
           <h1 class="nh2">New Admin</h1>
           <h2 class="nh2"> Fill Out New Admin Name</h2>
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
