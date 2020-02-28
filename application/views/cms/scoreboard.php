<section id="main-content">
  <section class="wrapper">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            Scoreboard
            <?php if ($flash_msg = $this->session->flash_msg): ?>
              <br><sub style="color: <?php echo $flash_msg['color'] ?>"><?php echo $flash_msg['message'] ?></sub>
            <?php endif; ?>
          </header>
          <div class="panel-body">
 
            <!-- all  -->

            <div class="col-md-4">
              <h4>All Members</h4>
              <div class="table-responsive" style="overflow: hidden; outline: none;" tabindex="1">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Rank</th>
                      <th>Name</th>
                      <th>Score</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (count($all) > 0 ): ?>
                      <?php $rank = 1; foreach ($all as $key => $value): ?>
                        <tr>
                          <td><?php echo $rank++; ?></td>
                          <td><?php echo $value->fname ?></td>
                          <td><?php echo round($value->total_score, 3) ?></td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="2" style="text-align:center">Empty table data</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
            </div>



              <!-- male   -->
            <div class="col-md-4">
              <h4>Male Members</h4>
              <div class="table-responsive" style="overflow: hidden; outline: none;" tabindex="1">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Rank</th>
                      <th>Name</th>
                      <th>Score</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (count($male) > 0 ): ?>
                      <?php $rank = 1; foreach ($male as $key => $value): ?>
                        <tr>
                          <td><?php echo $rank++; ?></td>
                          <td><?php echo $value->fname ?></td>
                          <td><?php echo round($value->total_score, 3) ?></td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="2" style="text-align:center">Empty table data</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
            </div>


              <!-- female -->
            <div class="col-md-4">
              <h4>Female Members</h4>
              <div class="table-responsive" style="overflow: hidden; outline: none;" tabindex="1">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Rank</th>
                      <th>Name</th>
                      <th>Score</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (count($female) > 0 ): ?>
                      <?php $rank = 1; foreach ($female as $key => $value): ?>
                        <tr>
                          <td><?php echo $rank++; ?></td>
                          <td><?php echo $value->fname ?></td>
                          <td><?php echo round($value->total_score, 3) ?></td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="2" style="text-align:center">Empty table data</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
            </div>

            </div>
          </section>
        </div>
      </div>
      <!-- page end-->
    </section>
  </section>

  <script src="<?php echo base_url('public/admin/js/custom/') ?>scoreboard_management.js"></script>
  <script src="<?php echo base_url('public/admin/js/custom/') ?>generic.js"></script>
