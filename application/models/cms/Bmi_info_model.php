<?php

class Bmi_info_model extends Admin_core_model
{

  function __construct()
  {
    parent::__construct();

    $this->table = 'bmi_info'; # Replace these properties on children
    $this->upload_dir = 'bmi_info'; # Replace these properties on children
    $this->per_page = 15;
  }

}
