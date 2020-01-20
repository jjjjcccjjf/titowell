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

  function pdf_tito($user_id)
  {
    $user = $this->users_model->get($user_id);
 
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Titowell Admin');
    $pdf->SetTitle("$user->fname $user->lname TiTo"); 

    // set default header data
    // $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    // ---------------------------------------------------------

    // set font
    $pdf->SetFont('dejavusans', '', 10);

    // add a page
    $pdf->AddPage();

    // writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
    // writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

    // create some HTML content
    $html = '<style>th, td {border: 1px solid black; padding:15px}</style>
    <h3>' .  "$user->fname $user->lname - TiTo PDF" . '</h3>
    <table class="table table-striped" cellpadding="9">
                <thead>
                  <tr>
                    <th>Datetime</th>
                    <th>Weight</th>
                    <th>Day</th>
                    <th>Type</th>
                  </tr>
                </thead><tbody>';
    foreach($this->users_model->getTito($user) as $value) {
      $html.= "<tr>";
      $html.= "<td>$value->datetime_f</td>";
      $html.= "<td>$value->weight_in_pounds_f lbs</td>";
      $html.= "<td>$value->datetime_day_f</td>";
      $html.= "<td>$value->type_f</td>";
      $html.= "</tr>";
    }           
    $html.='</tbody>
              </table>';

    // output the HTML content
    $pdf->writeHTML($html, true, false, true, false, '');
     

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

    // reset pointer to the last page
    $pdf->lastPage();

    // ---------------------------------------------------------

    //Close and output PDF document
    $pdf->Output($user->lname . '_attendance.pdf', 'I');

    //============================================================+
    // END OF FILE
    //============================================================+
  }

  function pdf_attendance($user_id)
  {
    $user = $this->users_model->get($user_id);
 
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Titowell Admin');
    $pdf->SetTitle("$user->fname $user->lname - Attendance / Wellness Program PDF"); 

    // set default header data
    // $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    // ---------------------------------------------------------

    // set font
    $pdf->SetFont('dejavusans', '', 10);

    // add a page
    $pdf->AddPage();

    // writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
    // writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

    // create some HTML content
    $html = '<style>th, td {border: 1px solid black; padding:15px}</style>
    <h3>' .  "$user->fname $user->lname Attendance / Wellness Program" . '</h3>
    <table class="table table-striped" cellpadding="9">
                <thead>
                  <tr>
                    <th>Activity</th>
                    <th>Date</th>
                    <th>Day</th>
                    <th>Mood</th>
                    <th>Comment</th>
                  </tr>
                </thead><tbody>';
    foreach($this->users_model->getWellnessProgram($user) as $value) {
      $html.= "<tr>";
      $html.= "<td>$value->activity_name</td>";
      $html.= "<td>$value->datetime_f</td>";
      $html.= "<td>$value->datetime_day_f</td>";
      $html.= "<td>$value->mood</td>";
      $html.= "<td>$value->comment</td>";
      $html.= "</tr>";
    }           
    $html.='</tbody>
              </table>';

    // output the HTML content
    $pdf->writeHTML($html, true, false, true, false, '');
     

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

    // reset pointer to the last page
    $pdf->lastPage();

    // ---------------------------------------------------------

    //Close and output PDF document
    $pdf->Output($user->lname . '_attendance.pdf', 'I');

    //============================================================+
    // END OF FILE
    //============================================================+
  }

  function pdf_bmi($user_id)
  {
    $user = $this->users_model->get($user_id);
 
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Titowell Admin');
    $pdf->SetTitle("$user->fname $user->lname - BMI PDF"); 

    // set default header data
    // $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    // ---------------------------------------------------------

    // set font
    $pdf->SetFont('dejavusans', '', 10);

    // add a page
    $pdf->AddPage();

    // writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
    // writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

    // create some HTML content
    $user->bmi_value = $this->users_model->getBmi($user);
    $bmi_info = $this->users_model->getBmiInfo($user);
    $html = '<h3>' .  "$user->fname $user->lname - BMI PDF" . '</h3>
    <hr>
    <h4>'. "$user->fname $user->lname" .' is in ' . $bmi_info->label. '</h4>
    <p>'. "($bmi_info->min_bmi - $bmi_info->max_bmi)" .'</p>
    <hr>
    <h3>Description</h3>
    <p>'. $bmi_info->description. '</p>
    <h3>Notes & Health Risks</h3>
    <p><sub>'. $bmi_info->notes_health_risks. '</sub></p>
    ';

    // output the HTML content
    $pdf->writeHTML($html, true, false, true, false, '');
     

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

    // reset pointer to the last page
    $pdf->lastPage();

    // ---------------------------------------------------------

    //Close and output PDF document
    $pdf->Output($user->lname . '_attendance.pdf', 'I');

    //============================================================+
    // END OF FILE
    //============================================================+
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
      $__offset = $this->input->post('__offset'); unset($_POST['__offset']);
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
