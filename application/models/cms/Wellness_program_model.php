<?php

class Wellness_program_model extends Admin_core_model
{

  function __construct()
  {
    parent::__construct();

    $this->table = 'wellness_program'; # Replace these properties on children
    $this->upload_dir = 'uploads/wellness_program'; # Replace these properties on children
    $this->per_page = 20;
  }

  function getAttendance()
  {
    $this->db->select("DATE_FORMAT(datetime, '%Y') as y, DATE_FORMAT(datetime, '%d') as d, DATE_FORMAT(datetime, '%c') as m, activities.name as activity_name, activities.color as activity_color, CONCAT(users.fname, ' ', users.lname) as attendee_name, wellness_program.comment,
      CASE wellness_program.mood
      WHEN 5 THEN '😄'
      WHEN 4 THEN '😃'
      WHEN 3 THEN '🙂'
      WHEN 2 THEN '😐'
      WHEN 1 THEN '🙁'
      end as mood
      ");
    $this->db->order_by('datetime', 'desc');
    $this->db->join('activities', 'activities.id = wellness_program.activity_id', 'left');
    $this->db->join('users', 'users.id = wellness_program.user_id', 'left');
    return $this->db->get_where('wellness_program')->result();
  } 

  function getActivities()
  {
    return $this->db->get('activities')->result();
  }

}
