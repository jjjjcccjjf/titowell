<?php

class Picture_book_model extends Crud_model
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
       $this->db->insert('picture_book', $data);
       return $this->db->insert_id();
     }
}
