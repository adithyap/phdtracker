<?php

class Applicant extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        
        $this->load->helper(array('html', 'form', 'url'));
        
        $this->load->model(array('user_model', 'application_model'));
        
//        Check if Admin
        if(! $this->session->userdata('logged_in') || ! $this->session->userdata('is_admin'))
        {
            redirect('login/index','refresh');
        }
    }
    
    public function view()
    {
        $data['title'] = 'Applicant View';
        $data['css'] = 'admin/applicants';
        
        $this->load->view('head', $data);
        
//        Fetch Applicant
        $applicant = $this->application_model->get_applicants($this->uri->segment(3));
        
        $this->load->view('applicant/view', array('applicant' => $applicant[0]));
        
        $this->load->view('footer');
    }
    
    public function approve()
    {
        
        $this->application_model->set_status($this->input->get_post('id'),'approve');
        
        $this->user_model->create_account($this->input->get_post('id'));
        
        redirect('admin/index', 'refresh');
    }
    
    public function reject()
    {
        $this->application_model->set_status($this->input->get_post('id'),'reject');
        redirect('admin/index', 'refresh');
    }
    
}

/* End of file applicant.php */
/* Location: ./application/models/applicant.php */