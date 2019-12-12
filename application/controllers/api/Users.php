<?php

class Users extends Crud_controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('api/users_model');
  }

	
  function timestamp_get($unix_timestamp)
  {
  	 $res = (object)[];

	 $timestamp = date('Y-m-d H:i:s', $unix_timestamp);
	 $data = $this->users_model->getFromLastTimestamp($timestamp);
	 $greatest_timestamp = $this->users_model->getGreatestTimestamp(); 


	 if ($data) {
		 $res->data = $data;
		 $res->meta = (object)[
		 	'message' => 'Got all data',
		 	'code' => 'ok',
		 	'status' => 200,
		 	'last_update_ymd' => $greatest_timestamp,
		 	'last_update_unix' => strtotime($greatest_timestamp),
		 ];
	 } else {
		 $res->data = (object)[];
		 $res->meta = (object)[
		 	'message' => 'No new data',
		 	'code' => 'you_are_up_to_date',
		 	'status' => 200,
		 	'last_update_ymd' => $greatest_timestamp,
		 	'last_update_unix' => strtotime($greatest_timestamp),
		 ];
	 }

	 $res = $this->formatRes($res);
	 $this->response($res);
  }  

  function formatRes($res)
  {
  	return $res;
  }


}
