<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();

    $this->load->model('cms/admin_model', 'admin_model');
  }

  public function index()
  {
    $this->dashboard();
  }

  public function dashboard()
  {
    $this->db->order_by('name', 'asc');
    $res = $this->admin_model->all();

    $data['res'] = $res;
    $this->wrapper('cms/index', $data);
  }


  public function add()
  {
    $data = $this->input->post();

    if($this->admin_model->add($data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item added successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error adding item', 'color' => 'red']);
    }

    $this->admin_redirect('cms/dashboard');
  }

  public function update($id)
  {
    $data = $this->input->post();

    if($this->admin_model->update($id, $data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item updated successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error updating item', 'color' => 'red']);
    }

    $this->admin_redirect('cms/dashboard');
  }

  public function delete()
  {
    if($this->admin_model->delete($this->input->post('id'))){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item deleted successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error deleting item', 'color' => 'red']);
    }

    $this->admin_redirect('cms/dashboard');
  }

}
