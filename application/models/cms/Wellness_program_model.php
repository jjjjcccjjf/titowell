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
    $this->db->select("DATE_FORMAT(datetime, '%Y') as y, DATE_FORMAT(datetime, '%d') as d, (DATE_FORMAT(datetime, '%m') - 1) as m, activities.name as activity_name, activities.color as activity_color, CONCAT(users.fname, ' ', users.lname) as attendee_name, wellness_program.comment,
      CASE wellness_program.mood
      WHEN 5 THEN '😄'
      WHEN 4 THEN '😃'
      WHEN 3 THEN '🙂'
      WHEN 2 THEN '😐'
      WHEN 1 THEN '🙁'
      end as mood, wellness_program.mood as mood_raw
      ");
    $this->db->order_by('datetime', 'desc');
    $this->db->join('activities', 'activities.id = wellness_program.activity_id', 'left');
    $this->db->join('users', 'users.id = wellness_program.user_id', 'left');
    $res = $this->db->get('wellness_program')->result();
    $res = $this->formatRes($res);
    return $res;
  } 

  function getActivities($activities_arr = [])
  {
    if ($activities_arr) {
      $this->db->where_in('id', $activities_arr);
    }
    return $this->db->get('activities')->result();
  }

  function formatRes(&$res)
  {
    foreach ($res as $key => $value) {

      $mood_emoji = '';
      switch ($value->mood_raw) {
        case 5: $mood_emoji = '😄'; break;
        case 4: $mood_emoji = '😃'; break;
        case 3: $mood_emoji = '🙂'; break;
        case 2: $mood_emoji = '😐'; break;
        default:
        case 1: $mood_emoji = '🙁'; break;
          break;
      }

      if (!$value->mood) {
        $value->mood = $mood_emoji;
      }
    }

    return $res;
  }

}
