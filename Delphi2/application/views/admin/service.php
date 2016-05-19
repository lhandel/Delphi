<?php $this->load->view('admin/header'); ?>


  <div class="container">

    <div class="row service">

          <div class="row">
            <div class="title mg">
              <h1> <?php echo $service->name; ?> <h1>
            </div>
          </div>

          <div class="row">

            <div class="box_container">

              <div class="box first">
                <div class="icon">
                  <i class="fa fa-clock-o" aria-hidden="true"></i>
                </div>
                <div class="number"><?php echo $service->ewt; ?></div>
                <h2>est. time</h2>
              </div>

              <div class="box first last">
                <div class="icon">
                  <img class = "icon" src="<?php echo site_url('assets/admin/Admin.svg'); ?>" alt="" />
                </div>
                <div class="number"><?php echo $service->handler; ?></div>
                <h2>Handlers</h2>
              </div>


              <div class="box">
                <div class="icon">
                  <i class="fa fa-hashtag" aria-hidden="true"></i>
                </div>
                <div class="number"><?php echo $service->current; ?></div>
                <h2>Current number</h2>
              </div>

              <div class="box last">
                <div class="icon">
                  <img class = "icon" src="<?php echo site_url('assets/admin/QueueGrey.svg'); ?>" alt="" />
                </div>
                <div class="number"><?php echo $service->queue_count; ?></div>
                <h2>Queue</h2>
              </div>


            </div><!-- .endboxcontainer -->
          </div><!-- .end row -->
      </div><!-- .end row & servicebox -->


      <!-- Next buttom -->
      <div class="row">
          <a href="<?php echo site_url('index.php/admin/service?s_id='.$_GET['s_id'].'&next=true'); ?>" class="button large">Next</a>
      </div>

      <div class="row">
        <!-- Change service buttom -->
        <div class="col-2">
            <a href="<?php echo site_url('index.php/admin/listService'); ?>" class="button">Change service</a>
        </div>
        <!-- Skip queue buttom -->
        <div class="col-2 last">
            <a href="<?php echo site_url('index.php/admin/service?s_id='.$_GET['s_id'].'&skip=true'); ?>" class="button">Skip customer</a>
        </div>
        <!-- Service Management buttom -->
        <div class="row">
          <a href="<?php echo site_url('index.php/admin/serviceManagement'); ?>" class="button">Settings</a>
        </div>

  </div>

</body>
</html>
