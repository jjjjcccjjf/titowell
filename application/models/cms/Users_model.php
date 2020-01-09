<?php

class Users_model extends Admin_core_model
{

  function __construct()
  {
    parent::__construct();

    $this->table = 'users'; # Replace these properties on children
    $this->upload_dir = 'uploads/users'; # Replace these properties on children
    $this->per_page = 20;
  }

  public function all($offset = 0)
  {

  	$this->db->select("users.*, CONCAT(fname, ' ', lname) as full_name, DATE_FORMAT(birth_date, '%b %d, %Y') as birth_date_formatted");
    $this->db->limit($this->per_page, $offset);
  	$res = $this->db->get($this->table)->result();
    $res = $this->formatRes($res);
    return $res;
  }

  function formatRes(&$res)
  {
  	foreach ($res as $value) {
  		$value->profile_pic_path = (strpos($value->profile_pic_file, 'http') !== false) ? $value->profile_pic_file : base_url("$this->upload_dir/") . $value->profile_pic_file;
  	}
  	return $res;
  }

  function getTotalCount()
  {
    return $this->db->count_all_results('users');
  }

}
