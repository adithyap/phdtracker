<?php

class Admin extends CI_Controller{
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
    
    public function index()
    {
        $data['title'] = 'Admin';
        $data['css'] = 'admin/applicants';
        
        $this->load->view('head', $data);
        $this->load->view('jquery', array('ui' => TRUE));
        
//        Fetch Applicants
        $applicants = $this->application_model->get_applicants();
        
//        Fetch Users
        $users = $this->user_model->get_students();
        
        $this->load->view('admin/index', array('applicants' => $applicants, 'users' => $users));
        
        $this->load->view('footer');
    }
    
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */