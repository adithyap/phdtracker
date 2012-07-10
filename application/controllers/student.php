<?php

class Student extends CI_Controller{
    public function __construct() {
        parent::__construct();
        
        $this->load->library('session');
        
        $this->load->helper(array('html', 'form', 'url'));
        
        $this->load->model(array('user_model'));
        
//        Check if Logged in
        if(! $this->session->userdata('logged_in'))
        {
            redirect('login/index','refresh');
        }
    }
    
    public function index()
    {
        $data['title'] = 'Student View';
        $data['css'] = 'student';
        
        $this->load->view('head', $data);
        $this->load->view('jquery',array('ui' => TRUE));
        
        $this->load->view('student/view',  array('id' => $this->session->userdata('user_id') ));
        
        $this->load->view('footer');
    }    

    public function view()
    {
        $data['title'] = 'Student View';
        $data['css'] = 'student';
        
        $this->load->view('head', $data);
        $this->load->view('jquery',array('ui' => TRUE));
        
        $this->load->view('student/view',  array('id' =>$this->uri->segment(3)));
        
        $this->load->view('footer');
    }
}

/* End of file student.php */
/* Location: ./application/controllers/student.php */
