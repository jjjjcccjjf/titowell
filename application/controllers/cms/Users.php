<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();

    $this->load->model('cms/users_model');
    $this->load->library("pagination");
    $this->load->library('user_agent');
  }

  public function index($offset = 0)
  { 

    $res = $this->users_model->all($offset);

    $data['res'] = $res;
    
    $pag_conf['base_url'] = base_url("cms/users/index");
    $pag_conf['total_rows'] = $this->users_model->getTotalCount();
    $pag_conf['per_page'] = 20;
    $pag_conf['cur_tag_open'] = '<li><a class="active_lg">';
    $pag_conf['cur_tag_close'] = '</a></li>';
    $pag_conf['num_tag_open'] = '<li>';
    $pag_conf['num_tag_close'] = '</li>';
    $pag_conf['next_tag_open'] = '<li>';
    $pag_conf['next_tag_close'] = '</li>';
    $pag_conf['prev_tag_open'] = '<li>';
    $pag_conf['prev_tag_close'] = '</li>';
    $pag_conf['last_tag_open'] = '<li>';
    $pag_conf['last_tag_close'] = '</li>';
    $pag_conf['first_tag_open'] = '<li>';
    $pag_conf['first_tag_close'] = '</li>';
    $this->pagination->initialize($pag_conf);
    $data["pagination"] = $this->pagination->create_links();

    $this->wrapper('cms/users', $data);
  }

  function add()
  {
      $_POST['pin'] = base64_encode($this->input->post('pin'));
      $data = array_merge($this->input->post(), $this->users_model->upload('profile_pic_file'));

      if($this->users_model->add($data)){ # Try to add and get the last id
        $this->session->set_flashdata('flash_msg', ['message' => 'Added successfully', 'color' => 'green']);
      }else{
        $this->session->set_flashdata('flash_msg', ['message' => 'Error deleting', 'color' => 'red']);
      }

      redirect('cms/users');
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

     redirect('cms/users/');
  }

  function update($id)
  {
      $__offset = $this->input->post('__offset'); unset($_POST['__offset']);
      $_POST['pin'] = base64_encode($this->input->post('pin'));
      
      $data = array_merge($this->input->post(), isset($_FILES['profile_pic_file']) && @$_FILES['profile_pic_file']['name'] != '' ? $this->users_model->upload('profile_pic_file'):[]);

      $res = $this->users_model->update($id, $data);

      if ($res || $res === 0) {
        $this->session->set_flashdata('flash_msg', ['message' => 'Updated successfully', 'color' => 'green']);
      } else {
        $this->session->set_flashdata('flash_msg', ['message' => 'Error updating', 'color' => 'red']);
      }
 
      if ($__offset) {
        $last_page = "index/{$__offset}";
      }
      redirect('cms/users/' . $last_page);
  }

}
