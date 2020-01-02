<?php

class Pedometer_counter_model extends Crud_model
{
 		
     function __construct()
	 {
	    parent::__construct();
 
	 }

     /**
     * Inserts to the table with the associative array provided
     * @param  array $data
     * @return int   the last insert id
     */
     public function add($data)
     {
       $this->db->insert('pedometer_counter', $data);
       return $this->db->insert_id();
     }
}
