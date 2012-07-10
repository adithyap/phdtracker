<?php

class Apply extends CI_Controller{
    public function __construct() {
        parent::__construct();
        
        $this->load->helper(array('html', 'form', 'url'));
        
        $this->load->model(array('application_model'));
    }
    
    public function index()
    {
//        Load Libraries
        $this->load->library(array('form_validation','javascript'));
        
        $config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'pdf|doc|txt|rtf|odf';
		$config['max_size']	= '2048';
        $this->load->library('upload', $config);
        
//        Load Model
        $this->load->model('application_model');
        
//        Validation Rules
        $this->form_validation->set_rules('name', 'Name', 'trim|required|alpha_dash|xss_clean');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required|xss_clean');
        $this->form_validation->set_rules('area_of_interest', 'Areas of Interest', 'trim|required|xss_clean');
        $this->form_validation->set_rules('synopsis', 'Synopsis', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'E-Mail', 'trim|required|valid_email|xss_clean');
        
//        Prepend Error Class
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        $data['title'] = 'Apply';
        $data['css'] = 'login';
        
        $this->load->view('head', $data);
        $this->load->view('jquery',array('ui'=>TRUE));
        
        if ($this->form_validation->run() == FALSE)
		{            
			$this->load->view('apply/index');
		}
		else
		{
            if(!$this->upload->do_upload('resume'))
            {
                $error = array('error' => $this->upload->display_errors('<div class="error">','</div>'));
                $this->load->view('apply/index', $error);
            }
            else
            {
//                Initialize Data
                $details['name'] = $this->input->post('name');
                $details['dob'] = $this->input->post('dob');
                $details['area_of_interest'] = $this->input->post('area_of_interest');
                $details['synopsis'] = $this->input->post('synopsis');
                $details['email'] = $this->input->post('email');
                
                $file_data = $this->upload->data();
                $details['resume'] = $file_data['file_name'];
                
//                Upload to Database
                $this->application_model->upload($details);
                
//                Display Success Page
                $this->load->view('apply/success');
            }
		}
        
        $this->load->view('footer');
    }
}

/* End of file apply.php */
/* Location: ./application/controllers/apply.php */
