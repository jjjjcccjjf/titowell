<?php

class Scoreboard extends Crud_controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('api/scoreboard_model');
  }

	
  function index_get()
  {
  	 $res = (object)[];

	 $data = $this->scoreboard_model->getHappinessMeterScores();

	 $res->data = $data;
	 $res->meta = (object)[
	 	'message' => 'Got all data',
	 	'code' => 'ok',
	 	'status' => 200,
	 ];
 
	 $this->response($res);
  }   
}