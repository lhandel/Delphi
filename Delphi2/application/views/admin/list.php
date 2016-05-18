<?php $this->load->view('admin/header'); ?>

  <div class="container">

    <?php foreach($services as $row){ ?>
    <div class="row">
      <div class="s1">

        <div class="row">
          <a href="<?php echo site_url("index.php/admin/login?s_id=".$row->s_id); ?>" class="btn servicebtn">
            <?php echo $row->name;?> <i class="fa fa-angle-right" aria-hidden="true"></i>
          </a>
        </div>

        <div class="row">
          <div class="infoc">
              <div class="est">
                <div class="icon">
                  <i class="fa fa-clock-o" aria-hidden="true"></i>
                </div>

                <div class="number stat" id="E<?php echo $row->s_id; ?>">
                  <?php echo $row->ewt; ?>
                </div>
                <h2>est. time</h2>

              </div>
              <div class="handler">
                <img class = "icon" src="<?php echo site_url('assets/admin/Admin.svg'); ?>" alt="" />
                <div class="number stat" id="H<?php echo $row->s_id; ?>">
                  <?php echo $row->handler; ?>
                </div>
                <h2>Handlers</h2>
              </div>
              <div class="queue">
                <img class = "icon" src="<?php echo site_url('assets/admin/QueueGrey.svg'); ?>" alt="" />
                <div class="number stat" id="Q<?php echo $row->s_id; ?>">
                  <?php echo $row->queue_count; ?>
                </div>
                <h2>Queue</h2>
              </div>
            </div>
          </div>


      </div>
    </div>
    <?php } ?>

  </div><!--.end container -->





  <ul>
  </ul>

  </body>
</html>
