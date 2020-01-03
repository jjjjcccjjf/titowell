<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();

    $this->load->model('cms/users_model');
  }

  public function index()
  {
    $this->dashboard();
  }

  public function dashboard()
  {
    $res = $this->users_model->all();

    $data['res'] = $res;
    $this->wrapper('cms/users', $data);
  }

  function delete()
  {
     $this->db->where('id', $this->input->post('id'));
     $res = $this->db->delete('users');

     if ($res) {
        $this->session->set_flashdata('flash_msg', ['message' => 'Deleted successfully', 'color' => 'green']);
     } else {
        $this->session->set_flashdata('flash_msg', ['message' => 'Error deleting', 'color' => 'red']);
     }

     redirect('cms/users');
  }

  function update($id)
  {
      $_POST['pin'] = base64_encode($this->input->post('pin'));
      
      $data = array_merge($this->input->post(), isset($_FILES['profile_pic_file']) && @$_FILES['profile_pic_file']['name'] != '' ? $this->users_model->upload('profile_pic_file'):[]);

      $res = $this->users_model->update($id, $data);

      if ($res || $res === 0) {
        $this->session->set_flashdata('flash_msg', ['message' => 'Updated successfully', 'color' => 'green']);
      } else {
        $this->session->set_flashdata('flash_msg', ['message' => 'Error updating', 'color' => 'red']);
      }
      redirect('cms/users');
  }

}
