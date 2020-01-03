<?php

class Picture_book_model extends Crud_model
{
 		
     function __construct()
	 {
	    parent::__construct();
    
        $this->upload_dir = 'picture_book'; # uploads/your_dir
        $this->uploads_folder = "uploads/" . $this->upload_dir . "/";
        $this->full_up_path = base_url() . "uploads/" . $this->upload_dir . "/"; # override this block on your child class. just redeclare it
	 }

     /**
     * Inserts to the table with the associative array provided
     * @param  array $data
     * @return int   the last insert id
     */
     public function add($data)
     {
       $this->db->insert('picture_book', $data);
       return $this->db->insert_id();
     }

          /**
      * Upload single file. Returns an empty array on failure
      * @param  string    $file_key   [description]
      * @return array                 [description]
      */
      public function upload($file_key)
      {
        @$file = $_FILES[$file_key];
        $upload_path = "uploads/" . $this->upload_dir;

        $config['upload_path'] = $upload_path; # NOTE: Change your directory as needed
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; # NOTE: Change file types as needed
        $config['overwrite'] = TRUE;
        $config['file_name'] = $file['name']; # Set the new filename
        $this->upload->initialize($config);

        # Folder creation
        # TODO: Will refactor this and integrate it to the core upload class
        if (!is_dir($upload_path) && !mkdir($upload_path, DEFAULT_FOLDER_PERMISSIONS, true)){
          mkdir($upload_path, DEFAULT_FOLDER_PERMISSIONS, true); # You can set DEFAULT_FOLDER_PERMISSIONS constant in application/config/constants.php
        }

        if($this->upload->do_upload($file_key)){
          return [$file_key => $this->upload->data('file_name')];
        }else{
          // echo $this->upload->display_errors(); die();
          return [];
        }

      }
}
