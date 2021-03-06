<?php

class Bmi_info_model extends Crud_model
{
      function __construct()
	 {
	    parent::__construct();
 
	 }

	 function getFromLastTimestamp($timestamp) {

	 	$greatest_timestamp = $this->getGreatestTimestamp(); 
	 	# pag mas updated si Mobile just return false
	 	if (strtotime($timestamp) >= strtotime($greatest_timestamp)) {
	 		return false;
	 	}

 		$this->db->order_by('id', 'asc');
	 	return $this->db->get('bmi_info')->result();
	 }

	 /**
	  * get greatest timestamp from created_at and updated_at fields
	  * @param  [type] $table [description]
	  * @return [type]        [description]
	  */
	 function getGreatestTimestamp()
	 {
	 	return $this->db->query("SELECT GREATEST(MAX(created_at), MAX(updated_at)) as greatest FROM `bmi_info` LIMIT 1")->row()->greatest;
	 }
}
