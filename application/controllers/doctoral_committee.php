<?php

class Doctoral_Committee extends CI_Controller{
    public function __construct() {
        parent::__construct();
        
        $this->load->library('session');
        
        $this->load->helper(array('html', 'form', 'url'));
        
        $this->load->model(array('user_model','doctoral_committee_model'));
        
//        Check if Logged in
        if(! $this->session->userdata('logged_in'))
        {
            redirect('login/index','refresh');
        }
    }
    
    public function index()
    {
        $id = $this->doctoral_committee_model->get_dc_id($this->uri->segment(3));
        
        if($id)
        {
            $details = $this->doctoral_committee_model->get_dc($id);
            $this->load->view('doctoral_committee/view', $details);
        }
        else
        {
            if($this->session->userdata('is_admin'))
                $this->load->view('doctoral_committee/set',array('id'=>$this->uri->segment(3)));
            else
                $this->load->view('doctoral_committee/not_set');
        }
    }
        
    public function edit()
    {
        $details = $this->doctoral_committee_model->get_dc($this->uri->segment(3));
        
        $this->load->view('head', array('title'=>'Edit Doctoral Committee'));
        $this->load->view('doctoral_committee/edit',$details);
        $this->load->view('footer');
        
    }
    
    public function submit()
    {
//        Load Libraries
        $this->load->library(array('form_validation'));
        
//        Error Delimiters
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

//        Validation Rules        
        for($i = 1; $i < 5; $i++)
        {
            $this->form_validation->set_rules('name'.$i, 'Name '.$i, 'trim|required|alpha_dash|xss_clean');
            $this->form_validation->set_rules('affiliation'.$i, 'Affiliation '.$i, 'trim|required|xss_clean');
            $this->form_validation->set_rules('email'.$i, 'E-mail '.$i, 'trim|required|valid_email|xss_clean');
            $this->form_validation->set_rules('phone_no'.$i, 'Phone Number '.$i, 'trim|required|xss_clean');
            $this->form_validation->set_rules('address'.$i, 'Address '.$i, 'trim|required|xss_clean');
        }
        
//        Validate
        if ($this->form_validation->run() == FALSE)
		{
            $this->load->view('head', array('title'=>'Set Doctoral Committee'));
            $this->load->view('doctoral_committee/set',array('id' => $this->input->post('id')));
            $this->load->view('footer');
		}
        else
        {
//            Prep Data for Insertion
            $name = implode(',',array($this->input->post('name1'), $this->input->post('name2'), $this->input->post('name3'), $this->input->post('name4')));
            $affiliation = implode(',',array($this->input->post('affiliation1'), $this->input->post('affiliation2'), $this->input->post('affiliation3'), $this->input->post('affiliation4')));
            $email = implode(',',array($this->input->post('email1'), $this->input->post('email2'), $this->input->post('email3'), $this->input->post('email4')));
            $phone_no = implode(',',array($this->input->post('phone_no1'), $this->input->post('phone_no2'), $this->input->post('phone_no3'), $this->input->post('phone_no4')));
            $address = implode(',',array($this->input->post('address1'), $this->input->post('address2'), $this->input->post('address3'), $this->input->post('address4')));
            $id = $this->input->post('id');

            $details = array('name' => $name, 'affiliation' => $affiliation, 'email' => $email, 'phone_no' => $phone_no, 'address' => $address, 'user_id' => $id);

            if($this->input->post('type') == 'add')
            {
//              Insert to Database
                $this->doctoral_committee_model->add($details);
            }
            else
            {
                $this->doctoral_committee_model->update ($details, $this->input->post('dc_id'));
            }

//            Redirect to Student View
            redirect('student/view/'.$id, 'refresh');
        }
    }
}

/* End of file doctoral_committee.php */
/* Location: ./application/controllers/doctoral_committee.php */
