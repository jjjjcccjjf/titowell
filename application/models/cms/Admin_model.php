<?php

class Admin_model extends Admin_core_model
{

  function __construct()
  {
    parent::__construct();
 
  }

  public function add($data)
  {
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    $this->db->insert('admin', $data);
    
    return $this->db->insert_id();
  }

  public function all()
  {
    $this->db->where_not_in('id', [$this->session->id]);
    $res = $this->db->get('admin')->result();
    return $res;
  }

  public function get($id)
  {
    return $this->db->get_where('admin', array('id' => $id))->row();
  }
 
  public function update($id, $data)
  {
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

    $this->db->update('admin', $data, ['id' => $id]);
    return $this->db->affected_rows(); # Returns 1 if update is successful, returns 0 if update is already made, but query is successful
  }

  public function delete($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('admin');
    return $this->db->affected_rows();
  }

}
