<?php

class Users_model extends Admin_core_model
{

  function __construct()
  {
    parent::__construct();

    $this->table = 'users'; # Replace these properties on children
    $this->upload_dir = 'users'; # Replace these properties on children
    $this->per_page = 30;
  }

  public function all()
  {
	$this->db->select("users.*, CONCAT(fname, ' ', lname) as full_name, DATE_FORMAT(birth_date, '%b %d, %Y') as birth_date_formatted");
	$res = $this->db->get($this->table)->result();
    $res = $this->formatRes($res);
    return $res;
  }

  function formatRes(&$res)
  {
  	foreach ($res as $value) {
  		$value->profile_pic_path = (strpos($value->profile_pic_file, 'http') !== false) ? $value->profile_pic_file : base_url('uploads/' . $this->upload_dir);
  	}
  	return $res;
  }

}
