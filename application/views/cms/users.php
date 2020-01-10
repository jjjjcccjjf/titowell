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
            <p>
              <button type="button" class="add-btn btn btn-success btn-sm">Add new</button>
            </p>
            <div class="table-responsive" style="overflow: hidden; outline: none;" tabindex="1">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Pin</th>
                    <th>Gender</th>
                    <th>Birthdate</th>
                    <th>Picture</th>
                    <th>Initial weight (lbs)</th>
                    <th>Height (ft,in)</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (count($res) > 0 ): ?>

                    <?php $i = 1 + $this->uri->segment(4); foreach ($res as $key => $value): ?>
                      <tr>
                        <th scope="row"><?php echo $i++ ?></th>
                        <td><?php echo $value->full_name ?></td>
                        <td><span>********</span> <button class="btn btn-xs btn-info view-pin pull-right" data-pin="<?php echo base64_decode($value->pin) ?>"><i class="fa fa-eye"></i></button></td>
                        <td><?php echo $value->gender ?></td>
                        <td><?php echo $value->birth_date_formatted ?></td>
                        <td><img src="<?php echo $value->profile_pic_path ?>" style="max-width:150px"></td>
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
                          <br >
                          <button 
                          data-payload='<?php echo json_encode($value->wellness_program ,JSON_HEX_QUOT|JSON_HEX_APOS) ?>'
                          style="margin-top:5px" type="button" data-id='<?php echo $value->id; ?>'
                            class="btn btn-success btn-xs btn-wellness-program">Attendance</button>
                          <br >
                          <button 
                          data-payload='<?php echo json_encode($value->tito ,JSON_HEX_QUOT|JSON_HEX_APOS) ?>'
                          style="margin-top:5px" type="button" data-id='<?php echo $value->id; ?>'
                            class="btn btn-success btn-xs btn-tito">TiTo</button>
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
          <h4 class="modal-title">Manage</h4>
        </div>
        <div class="modal-body">

          <form role="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label >First Name</label>
                      <input type="text" class="form-control" name="fname" placeholder="First name">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label >Last name</label>
                      <input type="text" class="form-control" name="lname" placeholder="Last name">
                    </div>
                  </div>
                </div>
            </div>
            <div class="form-group">
              <label >Pin</label>
              <input type="text" class="form-control" name="pin" placeholder="Pin">
            </div>
            <div class="form-group">
              <label >Gender</label>
              <select class="form-control" name="gender">
                <option>male</option>
                <option>female</option>
              </select>
            </div>            
            <div class="form-group">
              <label >Initial weight (lbs)</label>
              <input type="number" name="initial_weight_in_pounds" class="form-control">
            </div>
            <div class="form-group">
              <label >Birthdate</label> 
              <input type="date" class="form-control" name="birth_date">
            </div>
            <div class="form-group">
                <div class="row">
                  <div class="col-md-3">
                  <label >Height in feet</label>
                    <div class="form-group">
                      <input type="number" class="form-control" name="height_in_feet" placeholder="feet">
                    </div>
                  </div>
                  <div class="col-md-3">
                  <label >Height in inches</label>
                    <div class="form-group">
                      <input type="number" class="form-control" name="height_in_inches" placeholder="inches">
                    </div>
                  </div>
                </div>
            </div>
            <div class="form-group">
              <label >Profile picture</label> 
              <div><img src="" id="profile_pic_modal_image" style="max-width:150px"></div>
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

  <script src="<?php echo base_url('public/admin/js/custom/') ?>users_management.js"></script>
  <script src="<?php echo base_url('public/admin/js/custom/') ?>generic.js"></script>
