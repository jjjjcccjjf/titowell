<?php

class Wellness_program extends Crud_controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('api/wellness_program_model');
  }

  function index_post()
  {
  	$res = (object)[];
  	$data = $this->wellness_program_model->add($this->input->post());

  	if ($data) {
	  	$res->data = (object)[];
	  	$res->meta = (object)[
	  		'message' => 'Data inserted',
	  		'code' => 'ok',
	  		'status' => '200',
	  	];
  	} else {
	  	$res->data = (object)[];
	  	$res->meta = (object)[
	  		'message' => 'Malformed request',
	  		'code' => 'malformed_request',
	  		'status' => '400',
	  	];
    }
  	
  	$this->response($res);
  }

}
