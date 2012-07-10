<?php

class Home extends CI_Controller{
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
        $data['title'] = 'Admin';
        $data['css'] = 'login';
        
        $this->load->view('head', $data);
        
        $this->load->view('footer');
    }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
