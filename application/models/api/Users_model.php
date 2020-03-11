<?php

class Users_model extends Crud_model
{
 		
     function __construct()
	 {
	    parent::__construct();
 		$this->upload_dir = 'uploads/users';
	 }

	 function getFromLastTimestamp($timestamp) {

	 	$greatest_timestamp = $this->getGreatestTimestamp(); 
	 	# pag mas updated si Mobile just return false
	 	if (strtotime($timestamp) >= strtotime($greatest_timestamp)) {
	 		return false;
	 	}

 		$this->db->order_by('fname', 'asc');
	 	$res = $this->db->get('users')->result();
	 	return $this->formatRes($res);
	 }

	 /**
	  * get greatest timestamp from created_at and updated_at fields
	  * @param  [type] $table [description]
	  * @return [type]        [description]
	  */
	 function getGreatestTimestamp()
	 {
	 	return $this->db->query("SELECT GREATEST(MAX(created_at), MAX(updated_at)) as greatest FROM `users` LIMIT 1")->row()->greatest;
	 }

	 function formatRes(&$res)
	 {
	  	foreach ($res as $value) {
	  		$value->pin = base64_decode($value->pin);
  			$value->profile_pic_path = (strpos($value->profile_pic_file, 'http') !== false) ? $value->profile_pic_file : base_url("$this->upload_dir/") . $value->profile_pic_file;
  			$value->initial_weight_in_pounds = round($value->initial_weight_in_pounds);
  			$value->height_in_feet = (float)$value->height_in_feet;
  			$value->height_in_inches = (float)$value->height_in_inches;

	  	}
	  	return $res;
	 }
}
