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

  function getProgress($user_id, $order = null)
  {
    if ($order) {
      $order_str = "ORDER BY `weight_in_pounds` $order";
    } else {
      $order_str = "ORDER BY `datetime` DESC";
    }
    return $this->db->query("SELECT *, AVG(weight_in_pounds) as avg_weight_per_month, CONCAT(DATE_FORMAT(datetime, '%b'), ' ', YEAR(datetime)) as month_year FROM `tito` WHERE user_id = $user_id GROUP BY YEAR(datetime), MONTH(datetime) $order_str")->result_array();
  }

  function formatRes(&$res)
  {
  	foreach ($res as $value) {
  		$value->profile_pic_path = (strpos($value->profile_pic_file, 'http') !== false) ? $value->profile_pic_file : base_url("$this->upload_dir/") . $value->profile_pic_file;
      
      $value->bmi_value = $this->getBmi($value);
      $value->bmi_info = $this->getBmiInfo($value);

      $value->tito = $this->getTito($value);

      $value->wellness_program = $this->getWellnessProgram($value);
  	}
  	return $res;
  }

  function getBmi($user)
  {
    return round( ( ($this->getLatestWeight($user) / (pow(($user->height_in_feet * 12) + $user->height_in_inches, 2))) * 703.0 ) * 10.0 ) / 10.0;
  }

  function getLatestWeight($user)
  {
    $this->db->order_by('datetime', 'desc');
    $weight_in_pounds = @$this->db->get_where('tito', ['user_id' => $user->id])->row()->weight_in_pounds;
    if (!$weight_in_pounds) {
      $weight_in_pounds = @$this->db->get_where('users', ['id' => $user->id])->row()->initial_weight_in_pounds;
    }
    return $weight_in_pounds;
  }

  function getBmiInfo($user)
  {
    return $this->db->get_where('bmi_info', "'{$user->bmi_value} '> min_bmi AND '{$user->bmi_value}' < max_bmi")->row();
  }

  function getTito($user)
  {
    $this->db->select("DATE_FORMAT(datetime, '%b %d, %Y') as datetime_f, CONCAT(weight_in_pounds, ' lbs') as weight_in_pounds_f, DATE_FORMAT(datetime, '%W') as datetime_day_f, IF(type = 'ti', 'Timbang In', 'Timbang Out') as type_f");
    $this->db->order_by('datetime', 'desc');
    return $this->db->get_where('tito', ['user_id' => $user->id])->result();
  }

  function getWellnessProgram($user)
  {
    $this->db->select("activities.name as activity_name, DATE_FORMAT(datetime, '%b %d, %Y') as datetime_f, DATE_FORMAT(datetime, '%W') as datetime_day_f, mood, comment");
    $this->db->order_by('datetime', 'desc');
    $this->db->join('activities', 'activities.id = wellness_program.activity_id', 'left');
    return $this->db->get_where('wellness_program', ['user_id' => $user->id])->result();
  }

  function getTotalCount()
  {
    return $this->db->count_all_results('users');
  }

}
