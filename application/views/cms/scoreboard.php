<style>
  .hide-me-all, .hide-me-male, .hide-me-female {
    display:none;
}
</style>

<section id="main-content">
  <section class="wrapper">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-12">
        <h4>Scoreboard</h4>
        <form method="GET">
          <div class="form-group col-md-2">
            <label>Quarter</label>
            <input class="form-control" type="number" step="1" name="quarter" min="1" max="4" value="<?php echo $quarter ?>" placeholder="quarter">
          </div>
          <div class="form-group col-md-2">
            <label>Year</label>
            <input class="form-control" type="number" min="1900" max="2099" step="1" value="<?php echo $year ?>" name="year">
          </div>
            <input style="margin-top: 25px" type="submit" value="Apply filters" class="btn btn-sm btn-warning">
        </form>
      </div>
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading" >
            All Members
            <span class="tools pull-right">
              <button class="btn btn-success btn-xs show-me-all" data-typy="all">Show details</button>
              <a href="javascript:;" class="fa fa-chevron-down down-all"></a>
            </span>
          </header>
          <div class="panel-body">
 
            <!-- all  -->

            <div class="col-md-12">
              <div class="table-responsive" style="overflow: hidden; outline: none;" tabindex="1">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Rank</th>
                      <th>Name</th>
                      <th class="hyde hide-me-all">BMI Score</th>
                      <th class="hyde hide-me-all">Attendance Score</th>
                      <th class="hyde hide-me-all">Pedometer Score</th>
                      <th class="hyde hide-me-all">Happiness Score</th>
                      <th>Total Score</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (count($all) > 0 ): ?>
                      <?php $rank = 1; foreach ($all as $key => $value): ?>
                        <tr>
                          <td><?php echo $rank++; ?></td>
                          <td><a href="<?php echo base_url('cms/users?squery=' . $value->fname) ?>"><?php echo $value->fname ?> <button class="fa fa-link btn btn-xs btn-info"></button></a></td>
                          <td class="hyde hide-me-all"><?php echo round($value->bmi_score, 3) ?></td>
                          <td class="hyde hide-me-all"><?php echo round($value->pedometer_counter_score, 3) ?></td>
                          <td class="hyde hide-me-all"><?php echo round($value->attendance_score, 3) ?></td>
                          <td class="hyde hide-me-all"><?php echo round($value->happiness_meter_score, 3) ?></td>
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
          </section>
        </div>



      <div class="col-lg-12">
          <section class="panel">
            <header class="panel-heading">
              Male Members
              <span class="tools pull-right">
              <button class="btn btn-success btn-xs show-me-male" data-typy="male">Show details</button>
                <a href="javascript:;" class="fa fa-chevron-down down-male"></a>
              </span>
            </header>
            <div class="panel-body">
   
 

              <!-- male   -->
            <div class="col-md-12">
              <div class="table-responsive" style="overflow: hidden; outline: none;" tabindex="1">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Rank</th>
                      <th>Name</th>
                      <th class="hyde hide-me-male">BMI Score</th>
                      <th class="hyde hide-me-male">Attendance Score</th>
                      <th class="hyde hide-me-male">Pedometer Score</th>
                      <th class="hyde hide-me-male">Happiness Score</th>
                      <th>Total Score</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (count($male) > 0 ): ?>
                      <?php $rank = 1; foreach ($male as $key => $value): ?>
                        <tr>
                          <td><?php echo $rank++; ?></td>
                          <td><a href="<?php echo base_url('cms/users?squery=' . $value->fname) ?>"><?php echo $value->fname ?> <button class="fa fa-link btn btn-xs btn-info"></button></a></td>
                          <td class="hyde hide-me-male"><?php echo round($value->bmi_score, 3) ?></td>
                          <td class="hyde hide-me-male"><?php echo round($value->pedometer_counter_score, 3) ?></td>
                          <td class="hyde hide-me-male"><?php echo round($value->attendance_score, 3) ?></td>
                          <td class="hyde hide-me-male"><?php echo round($value->happiness_meter_score, 3) ?></td>
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

            </section>
        </div>


        <div class="col-lg-12">
          <section class="panel">
            <header class="panel-heading">
              Female Members
              <span class="tools pull-right">
              <button class="btn btn-success btn-xs show-me-female" data-typy="female">Show details</button>
                <a href="javascript:;" class="fa fa-chevron-down down-female"></a>
              </span>
            </header>
            <div class="panel-body">
   
              <!-- female -->
            <div class="col-md-12">
              <div class="table-responsive" style="overflow: hidden; outline: none;" tabindex="1">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Rank</th>
                      <th>Name</th>
                      <th class="hyde hide-me-female">BMI Score</th>
                      <th class="hyde hide-me-female">Attendance Score</th>
                      <th class="hyde hide-me-female">Pedometer Score</th>
                      <th class="hyde hide-me-female">Happiness Score</th>
                      <th>Total Score</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (count($female) > 0 ): ?>
                      <?php $rank = 1; foreach ($female as $key => $value): ?>
                        <tr>
                          <td><?php echo $rank++; ?></td>
                          <td><a href="<?php echo base_url('cms/users?squery=' . $value->fname) ?>"><?php echo $value->fname ?> <button class="fa fa-link btn btn-xs btn-info"></button></a></td>
                          <td class="hyde hide-me-female"><?php echo round($value->bmi_score, 3) ?></td>
                          <td class="hyde hide-me-female"><?php echo round($value->pedometer_counter_score, 3) ?></td>
                          <td class="hyde hide-me-female"><?php echo round($value->attendance_score, 3) ?></td>
                          <td class="hyde hide-me-female"><?php echo round($value->happiness_meter_score, 3) ?></td>
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

            </section>
          </div>


        
      <!-- page end-->
    </section>
  </section>

  <!-- <script src="<?php echo base_url('public/admin/js/custom/') ?>scoreboard_management.js"></script> -->
  
  <script>
  $(document).ready(function($) {
    $('.show-me-female, .show-me-male, .show-me-all').on('click', function(){
       let typy = $(this).data("typy")

       $('.hide-me-' + typy).toggle(200);
    })

    $('.down-female, .down-male, .down-all').trigger('click')
  });  
  </script>

  <script src="<?php echo base_url('public/admin/js/custom/') ?>generic.js"></script>
