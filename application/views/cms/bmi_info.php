<section id="main-content">
  <section class="wrapper">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            Administrators
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
                    <th>Label</th>
                    <th>Description</th>
                    <th>Notes & Health Risks</th>
                    <th>Min BMI</th>
                    <th>Max BMI</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (count($res) > 0 ): ?>

                    <?php foreach ($res as $key => $value): ?>
                      <tr>
                        <td><?php echo $value->label ?></td>
                        <td><?php echo $value->description ?></td>
                        <td><?php echo $value->notes_health_risks ?></td>
                        <td><?php echo $value->min_bmi ?></td>
                        <td><?php echo $value->max_bmi ?></td>
                        <td>
                          <button type="button"
                          data-payload='<?php echo json_encode(['id' => $value->id, 'label' => $value->label, 'description' => $value->description, 'notes_health_risks' => $value->notes_health_risks, 'min_bmi' => $value->min_bmi, 'max_bmi' => $value->max_bmi])?>'
                          class="edit-row btn btn-info btn-xs">Edit</button>
                          </td>
                        </tr>
                      <?php endforeach; ?>


                    <?php else: ?>
                      <tr>
                        <td colspan="4" style="text-align:center">Empty table data</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </section>
        </div>
      </div>
      <!-- page end-->
    </section>
  </section>

  <!-- Modal -->
  <div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Manage</h4>
        </div>
        <div class="modal-body">

          <form role="form" method="post">
            <div class="form-group">
              <label >Label</label>
              <input type="text" class="form-control" name="label" placeholder="Label">
            </div> 
            <div class="form-group">
              <label >Description</label>
              <textarea class="form-control" name="description"></textarea>
            </div> 
            <div class="form-group">
              <label >Notes & Health Risks</label>
              <textarea class="form-control" name="notes_health_risks"></textarea>
            </div> 
            <div class="form-group">
              <label >Min BMI</label>
              <input type="text" class="form-control" name="min_bmi" placeholder="Min BMI">
            </div> 
            <div class="form-group">
              <label >Max BMI</label>
              <input type="text" class="form-control" name="max_bmi" placeholder="Max BMI">
            </div> 

          </div>
          <div class="modal-footer">
            <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
            <input class="btn btn-info" type="submit" value="Save changes">
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- modal -->

  <script src="<?php echo base_url('public/admin/js/custom/') ?>bmi_info_management.js"></script>
  <script src="<?php echo base_url('public/admin/js/custom/') ?>generic.js"></script>
