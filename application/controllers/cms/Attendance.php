<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();

    $this->load->model('cms/wellness_program_model');
    $this->load->model('cms/users_model');
  }

  public function index()
  {
    $data = [];
    $data['activities'] = $this->wellness_program_model->getActivities();
    $data['attendance'] = $this->wellness_program_model->getAttendance();
    // var_dump($this->db->last_query(), $data); die();

    $this->wrapper('cms/attendance', $data);
  }

  function user($user_id, $activity_id = null)
  {
    $data = [];
    $data['activities'] = $this->wellness_program_model->getActivities(!$activity_id ?[]: [$activity_id]);

    $this->db->where('wellness_program.user_id', $user_id);
    if ($activity_id) {
      $this->db->where('activities.id', $activity_id);
    }
    $data['attendance'] = $this->wellness_program_model->getAttendance();
    $this->wrapper('cms/classes', $data);
  }

  function progress ($user_id, $order = null)
  {
    $data = [];
    if ($order == 'desc') {
      $data['progress'] = '- Most Progressive First'; 
    } else if ($order == 'asc'){
      $data['progress'] = '- Least Progressive First';
    } else {
      $data['progress'] = '- Sorted by Date (descending)';
    }

    $data['categories'] = array_column($this->users_model->getProgress($user_id, $order), 'month_year');
    $data['series_data'] = array_column($this->users_model->getProgress($user_id, $order), 'avg_weight_per_month');
    $this->wrapper('cms/progress', $data);
  }

 
}
