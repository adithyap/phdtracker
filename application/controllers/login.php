<?php

class Login extends CI_Controller {
    public function __construct() {
        parent::__construct();
        
        $this->load->library('session');
        
        $this->load->helper(array('html', 'form', 'url'));
        
        $this->load->model('user_model');
    }

    public function index()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_dash|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|md5');
        
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        if($this->session->userdata('logged_in'))
        {
            if($this->session->userdata('is_admin'))
                redirect ('admin', 'refresh');
            else
                redirect ('student', 'refresh');
        }
        
        $data['title'] = 'Login';
        $data['css'] = 'login';
        
        $this->load->view('head', $data);

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('login/index', $data);
		}
		else
		{
            if($this->user_model->authenticate($this->input->post('username'), $this->input->post('password')))
            {
                $this->session->set_userdata(array('user_id' => $this->user_model->get_id($this->input->post('username')), 'logged_in' => TRUE));
                
//                Check if Admin Logged In
                if($this->user_model->is_admin($this->input->post('username')))
                {
                    $this->session->set_userdata(array('is_admin' => TRUE));
                    redirect('admin/index','refresh');
                }
                else
                {
                    redirect('student/index','refresh');
                }
            }
            else
            {
                $data['error'] = 'Invalid Username or Password';
                $this->load->view('login/index', $data);
            }
		}
        $this->load->view('footer');
    }
    
    public function logout()
    {
        $this->session->unset_userdata('user_id');
        $this->session->set_userdata(array('logged_in' => FALSE, 'is_admin' => FALSE));
        
        redirect('login/index','refresh');
    }
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */