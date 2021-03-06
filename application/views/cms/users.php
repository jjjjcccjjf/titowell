<style>
  @media print {
    #main-content { display:none; }
    #wellness-program-model { display:block !important; }
  }
</style>
<section id="main-content">
  <section class="wrapper">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            Users
            <?php if ($flash_msg = $this->session->flash_msg): ?>
              <br><sub style="color: <?php echo $flash_msg['color'] ?>"><?php echo $flash_msg['message'] ?></sub>
            <?php endif; ?>
          </header>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-8">
                <button type="button" class="add-btn btn btn-success btn-sm">Add new</button>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <form method="GET" action="<?php echo base_url('cms/users') ?>">
                    <input type="text" class="form-control" name="squery" placeholder="search name" value="<?php echo $this->input->get('squery') ?>">
                  </form>
                </div>
              </div>
            </div>
            <div class="table-responsive" style="overflow: hidden; outline: none;" tabindex="1">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Pin</th>
                    <th>Gender</th>
                    <th>Health condition</th>
                    <th>Birthdate</th>
                    <th>Picture</th>
                    <th>Initial weight (lbs)</th>
                    <th>Height (ft,in)</th>
                    <th style="min-width:141px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (count($res) > 0 ): ?>

                    <?php $i = 1 + $this->uri->segment(4); foreach ($res as $key => $value): ?>
                      <tr>
                        <th scope="row"><?php echo $i++ ?></th>
                        <td><?php echo $value->full_name ?></td>
                        <td><span style="display:block">********</span><button class="btn btn-xs btn-info view-pin" data-pin="<?php echo base64_decode($value->pin) ?>"><i class="fa fa-eye"></i></button></td>
                        <td><?php echo $value->gender ?></td>
                        <td><?php echo $value->health_condition ?></td>
                        <td><?php echo $value->birth_date_formatted ?></td>
                        <td><img src="<?php echo $value->profile_pic_path ?>" style="max-width:150px" 
                          onerror="this.src='<?php echo base_url('public/admin/img/account.png') ?>'"></td>
                        <td><?php echo $value->initial_weight_in_pounds ?> (lbs)</td>
                        <td><?php echo $value->height_in_feet ?>' <?php echo $value->height_in_inches ?>"</td>
                        <td>
                          <button type="button"
                          data-payload='<?php echo json_encode(['id' => $value->id, 'fname' => $value->fname, 'lname' => $value->lname, 'gender' => $value->gender, 'birth_date' => $value->birth_date, 'pin' => base64_decode($value->pin), 'profile_pic_path' => $value->profile_pic_path, 'initial_weight_in_pounds' => $value->initial_weight_in_pounds, 'height_in_feet' => $value->height_in_feet, 'height_in_inches' => $value->height_in_inches], JSON_HEX_QUOT|JSON_HEX_APOS)?>'
                          class="edit-row btn btn-info btn-xs">Edit</button>
                          <br >
                          <button style="margin-top:5px" type="button" data-id='<?php echo $value->id; ?>'
                            class="btn btn-delete btn-danger btn-xs">Delete</button>
                          <br >
                          <button 
                          data-payload='<?php echo json_encode($value->bmi_info ,JSON_HEX_QUOT|JSON_HEX_APOS) ?>'
                          data-namey='<?php echo "$value->fname $value->lname" ?>'
                          style="margin-top:5px" type="button" data-id='<?php echo $value->id; ?>'
                            class="btn btn-success btn-xs btn-bmi">BMI</button>
                          <a style="margin-top:5px" href="<?php echo base_url("cms/users/pdf_bmi/$value->id") ?>" target="_blank" class="btn btn-default btn-xs"><i class="fa fa-print"></i></a>
                          <br >
                          <button 
                          data-payload='<?php echo json_encode($value->wellness_program ,JSON_HEX_QUOT|JSON_HEX_APOS) ?>'
                          style="margin-top:5px" type="button" data-id='<?php echo $value->id; ?>'
                            class="btn btn-success btn-xs btn-wellness-program">Attendance</button>
                          <a style="margin-top:5px" href="<?php echo base_url("cms/users/pdf_attendance/$value->id") ?>" target="_blank" class="btn btn-default btn-xs"><i class="fa fa-print"></i></a>
                          <br >

                          <button 
                          data-payload='<?php echo json_encode($value->tito ,JSON_HEX_QUOT|JSON_HEX_APOS) ?>'
                          style="margin-top:5px" type="button" data-id='<?php echo $value->id; ?>'
                            class="btn btn-success btn-xs btn-tito">TiTo</button> 
                          <a style="margin-top:5px" href="<?php echo base_url("cms/users/pdf_tito/$value->id") ?>" target="_blank" class="btn btn-default btn-xs"><i class="fa fa-print"></i></a>
                          <br>

                          <button 
                          data-payload='<?php echo json_encode($value->pedometer_counter ,JSON_HEX_QUOT|JSON_HEX_APOS) ?>'
                          style="margin-top:5px" type="button" data-id='<?php echo $value->id; ?>'
                            class="btn btn-success btn-xs btn-pedometer">Pedometer C.</button> 
                          <a style="margin-top:5px" href="<?php echo base_url("cms/users/pdf_pedometer_counter/$value->id") ?>" target="_blank" class="btn btn-default btn-xs"><i class="fa fa-print"></i></a>
                          <br>

                          <div class="btn-group" style="margin-top:5px">
                              <button class="btn btn-xs btn-info" type="button" onclick="window.location.href = '<?php echo base_url("cms/attendance/user/$value->id") ?>?source_url=<?php echo base64_encode(current_url() . '?' . $_SERVER['QUERY_STRING']) ?>'">All Classes</button>
                              <button data-toggle="dropdown" class="btn btn-xs  btn-info dropdown-toggle" type="button"><span class="caret"></span></button>
                              <ul role="menu" class="dropdown-menu">
                                <?php foreach ($activities as $activity): ?>
                                  <li><a href="<?php echo base_url("cms/attendance/user/{$value->id}/$activity->id") ?>?source_url=<?php echo base64_encode(current_url() . '?' . $_SERVER['QUERY_STRING']) ?>"><?php echo $activity->name ?></a></li>
                                <?php endforeach ?>
                              </ul>
                          </div><!-- /btn-group -->
                          <br>

                          <div class="btn-group" style="margin-top:5px">
                              <button onclick="window.location.href = '<?php echo base_url("cms/attendance/progress/{$value->id}") ?>?source_url=<?php echo base64_encode(current_url() . '?' . $_SERVER['QUERY_STRING']) ?>'" class="btn btn-xs btn-warning" type="button">Progression</button>
                              <button data-toggle="dropdown" class="btn btn-xs  btn-warning dropdown-toggle" type="button"><span class="caret"></span></button>
                              <ul role="menu" class="dropdown-menu">
                                  <li><a href="<?php echo base_url("cms/attendance/progress/{$value->id}/desc") ?>?source_url=<?php echo base64_encode(current_url() . '?' . $_SERVER['QUERY_STRING']) ?>">Most<br>Progressive</a></li>
                                  <li><a href="<?php echo base_url("cms/attendance/progress/{$value->id}/asc") ?>?source_url=<?php echo base64_encode(current_url() . '?' . $_SERVER['QUERY_STRING']) ?>">Least<br>Progressive</a></li>
                              </ul>
                          </div><!-- /btn-group -->
                          </td>
                        </tr>
                      <?php endforeach; ?>

                    <?php else: ?>
                      <tr>
                        <td colspan="9" style="text-align:center">Empty table data</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
                <style>
                .active_lg {
                  background: lightgray !important
                }
                </style>
                <ul class='pagination'>
                  <?php echo $pagination ?>
                </ul>
              </div>
            </div>
          </section>
        </div>
      </div>
      <!-- page end-->
    </section>
  </section>

  <!-- Modal -->
  <div class="modal fade edit-modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Manage
            <br><sub>(All fields marked with * are required)</sub>
          </h4>
        </div>
        <div class="modal-body">

          <form role="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label >Nickname *</label>
                      <input type="text" class="form-control" name="fname" placeholder="Nickname" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label >Full name *</label>
                      <input type="text" class="form-control" name="lname" placeholder="Last name" required>
                    </div>
                  </div>
                </div>
            </div>
            <div class="form-group">
              <label >Pin *</label>
              <input type="text" class="form-control" name="pin" placeholder="Pin" required>
            </div>
            <div class="form-group">
              <label >Gender *</label>
              <select class="form-control" name="gender" required>
                <option>male</option>
                <option>female</option>
              </select>
            </div>    
            <div class="form-group">
              <label >Health Condition</label>
              <input class="form-control" type="text" name="health_condition" placeholder="None">
            </div>            
            <div class="form-group">
              <label >Initial weight (lbs) *</label>
              <input type="number" step="0.1" name="initial_weight_in_pounds" class="form-control" required>
            </div>
            <div class="form-group">
              <label >Birthdate *</label> 
              <input type="date" class="form-control" name="birth_date" required>
            </div>
            <div class="form-group">
                <div class="row">
                  <div class="col-md-3">
                  <label >Height in feet *</label>
                    <div class="form-group">
                      <input type="number" class="form-control" name="height_in_feet" placeholder="feet" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                  <label >Height in inches *</label>
                    <div class="form-group">
                      <input type="number" class="form-control" name="height_in_inches" placeholder="inches" required>
                    </div>
                  </div>
                </div>
            </div>
            <div class="form-group">
              <label >Profile picture *</label> 
              <div><img src="" id="profile_pic_modal_image" style="max-width:150px" onerror="this.src='<?php echo base_url('public/admin/img/account.png') ?>'"></div>
              <input type="file" class="form-control" name="profile_pic_file">
            </div>
            <input type="hidden" name="__offset" value="<?php echo $this->uri->segment(4) ?>">
          </div>
          <div class="modal-footer">
            <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
            <input class="btn btn-info" type="submit" value="Save changes">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
  <!-- modal -->

  <!-- Modal -->
  <div class="modal fade in bmi-modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 comments-o="modal-title">BMI Information</h4>
        </div>
        <div class="modal-body">

          <h3 ><span id="bmi-name">-</span> <span style="font-weight: 100;">is in</span> <span id="bmi-label">-</span></h3>
          <h5>(<span id="bmi-min"></span> - <span id="bmi-max"></span>)</h5>
          <hr>

          <h4>Description</h4>
          <p style="text-align:justify" id="bmi-description">-</p>
          <br>

          <h4>Notes & Health Risks</h4>
          <p style="text-align:justify" ><sub id="bmi-notes">-</sub></p>

          <div class="modal-footer">
            <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
  <!-- modal -->

   <!-- Modal -->
  <div class="modal fade tito-modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 comments-o="modal-title">TiTo</h4>
        </div>
        <div class="modal-body">

          <table class="table table-striped">
            <thead>
              <tr>
                <th>Datetime</th>
                <th>Weight</th>
                <th>Day</th>
                <th>Type</th>
              </tr>
            </thead>
            <tbody>
              <!-- tbody -->
            </tbody>
          </table>

          <div class="modal-footer">
            <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
  <!-- modal -->

  <!-- Modal -->
  <div class="modal fade pedometer-modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 comments-o="modal-title">Pedometer Counter</h4>
        </div>
        <div class="modal-body">

          <table class="table table-striped">
            <thead>
              <tr>
                <th>Date</th>
                <th>Step count</th>
              </tr>
            </thead>
            <tbody>
              <!-- tbody -->
            </tbody>
          </table>

          <div class="modal-footer">
            <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
  <!-- modal -->

   <!-- Modal -->
  <div class="modal fade wellness-program-modal" id="wellness-program-model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 comments-o="modal-title">Wellness Program</h4>
        </div>
        <div class="modal-body">

          <table class="table table-striped">
            <thead>
              <tr>
                <th>Activity</th>
                <th>Date</th>
                <th>Day</th>
                <th>Mood</th>
                <th>Comment</th>
              </tr>
            </thead>
            <tbody>
              <!-- tbody -->
            </tbody>
          </table>

          <div class="modal-footer">
            <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
  <!-- modal -->

  <script src="<?php echo base_url('public/admin/js/custom/') ?>users_management.js"></script>
  <script src="<?php echo base_url('public/admin/js/custom/') ?>generic.js"></script>
