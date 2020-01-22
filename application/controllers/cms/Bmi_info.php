<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bmi_info extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();

    $this->load->model('cms/bmi_info_model');
  }

  public function index()
  {
    $res = $this->bmi_info_model->all();

    $data['res'] = $res;
    $this->wrapper('cms/bmi_info', $data);
  }

  function update($id)
  {

      $res = $this->bmi_info_model->update($id, $this->input->post());

      if ($res || $res === 0) {
        $this->session->set_flashdata('flash_msg', ['message' => 'Updated successfully', 'color' => 'green']);
      } else {
        $this->session->set_flashdata('flash_msg', ['message' => 'Error updating', 'color' => 'red']);
      }
 
      redirect('cms/bmi_info');
  }
}
