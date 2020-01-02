<?php

class Tito extends Crud_controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('api/tito_model');
  }

  function index_post()
  {
  	$res = (object)[];
  	$data = $this->tito_model->add($this->input->post());

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
