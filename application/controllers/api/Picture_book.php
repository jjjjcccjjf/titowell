<?php

class Picture_book extends Crud_controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('api/picture_book_model');
  }

  function index_post()
  {
  	$res = (object)[];

        # NOTE: This is an example usage of batch upload
    // $data = array_merge($this->input->post(), $this->model->batch_upload($_FILES['input_name']));

    # NOTE: This is an example usage of single upload
    $posty = array_merge($this->input->post(), $this->picture_book_model->upload('pic_file'));

  	$data = $this->picture_book_model->add($posty);

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
