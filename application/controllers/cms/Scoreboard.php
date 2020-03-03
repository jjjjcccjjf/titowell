<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scoreboard extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();

    $this->load->model('api/scoreboard_model');
  }

  public function index()
  {
    $data['year'] = $this->input->get('year')?: date('Y');
    $data['quarter'] = $this->input->get('quarter')?: $this->scoreboard_model->getQuarterByMonth(date('m'));

    $data['all'] = $this->scoreboard_model->buildScoreboard('all');
    $data['male'] = $this->scoreboard_model->buildScoreboard('male');
    $data['female'] = $this->scoreboard_model->buildScoreboard('female');
    
    $this->wrapper('cms/scoreboard', $data);
  }
 
}
