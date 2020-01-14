<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();

    $this->load->model('cms/wellness_program_model');
  }

  public function index()
  {
    $data = [];
    $data['activities'] = $this->wellness_program_model->getActivities();
    $data['attendance'] = $this->wellness_program_model->getAttendance();
    $this->wrapper('cms/attendance', $data);
  }

 
}
