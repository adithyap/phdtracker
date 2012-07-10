<?php

class Comprehensive_Viva extends CI_Controller{
    public function __construct() {
        parent::__construct();
        
        $this->load->library('session');
        
        $this->load->helper(array('html', 'form', 'url'));
        
        $this->load->model(array('user_model','comprehensive_viva_model'));
        
//        Check if Logged in
        if(! $this->session->userdata('logged_in'))
        {
            redirect('login/index','refresh');
        }
    }
    
    public function index()
    {
        $id = $this->comprehensive_viva_model->get_id($this->uri->segment(3));
        
        if($id)
        {
            $details = $this->comprehensive_viva_model->get($id);
            $this->load->view('comprehensive_viva/view', $details);
        }
        else
        {
            if($this->session->userdata('is_admin')){
                $this->load->view('jquery',array('ui'=>TRUE));
                $this->load->view('comprehensive_viva/set',array('id'=>$this->uri->segment(3)));
            }
            else
                $this->load->view('comprehensive_viva/not_set');
        }
    }
    
    public function edit()
    {
        $details = $this->comprehensive_viva_model->get($this->comprehensive_viva_model->get_id($this->uri->segment(3)));
        
        $this->load->view('head', array('title'=>'Edit Comprehensive Viva'));
        $this->load->view('comprehensive_viva/edit',$details);
        $this->load->view('footer');
        
    }
    
    public function submit()
    {
//        Load Libraries
        $this->load->library(array('form_validation'));
        
//        Error Delimiters
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

//        Validation Rules        
        for($i = 1; $i <= 5; $i++)
        {
            $this->form_validation->set_rules('name'.$i, 'Export Committee Member '.$i, 'trim|required|alpha_dash|xss_clean');
            $this->form_validation->set_rules('affiliation'.$i, 'Affiliation '.$i, 'trim|required|xss_clean');
        }
        $this->form_validation->set_rules('result', 'Result', 'trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');
        
//        Validate
        if ($this->form_validation->run() == FALSE)
		{
            $this->load->view('head', array('title'=>'Set Comprehensive Viva'));
            $this->load->view('comprehensive_viva/set',array('id' => $this->input->post('id')));
            $this->load->view('footer');
		}
        else
        {
//            Prep Data for Insertion
            $name = implode(',',array($this->input->post('name1'), $this->input->post('name2'), $this->input->post('name3'), $this->input->post('name4'), $this->input->post('name5')));
            $affiliation = implode(',',array($this->input->post('affiliation1'), $this->input->post('affiliation2'), $this->input->post('affiliation3'), $this->input->post('affiliation4'), $this->input->post('affiliation5')));
            $result = $this->input->post('result');
            $date = $this->input->post('date');
            $id = $this->input->post('id');

            $details = array('name' => $name, 'affiliation' => $affiliation, 'result' => $result, 'date' => $date, 'user_id' => $id);

            
            if($this->input->post('type') == 'add')
            {
//              Insert to Database
                $this->comprehensive_viva_model->add($details);
            }
            else
            {
                $this->comprehensive_viva_model->update($details, $this->input->post('cv_id'));
            }

//            Redirect to Student View
            redirect('student/view/'.$id, 'refresh');
        }
    }
}

/* End of file comprehensive_viva.php */
/* Location: ./application/controllers/comprehensive_viva.php */
