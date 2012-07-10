<?php

class Doctoral_Meeting extends CI_Controller{
    public function __construct() {
        parent::__construct();
        
        $this->load->library('session');
        
        $this->load->helper(array('html', 'form', 'url'));
        
        $this->load->model(array('user_model','doctoral_meeting_model'));
        
//        Check if Logged in
        if(! $this->session->userdata('logged_in'))
        {
            redirect('login/index','refresh');
        }
    }
    
    public function index()
    {   
        if($this->doctoral_meeting_model->get_num_count($this->uri->segment(3)))
        {
            $count = 0;
            $dm_id = $this->doctoral_meeting_model->get_id($this->uri->segment(3));
            foreach ($dm_id as $di) {
                $details[$count++] = $this->doctoral_meeting_model->get($di);
            }
            $this->load->view('doctoral_meeting/view', array('details'=>$details));
        }
        else
        {
            if($this->session->userdata('is_admin'))
            {
                $this->load->view('jquery',array('ui'=>TRUE));
                $this->load->view('doctoral_meeting/set',array('id'=>$this->uri->segment(3), 'num'=>(int)($this->doctoral_meeting_model->get_num_count($this->uri->segment(3))) + 1 ));
            }
            else
            {
                $this->load->view('doctoral_meeting/not_set');
            }
        }
    }
    
    public function add()
    {
        $id = $this->doctoral_meeting_model->get_id($this->uri->segment(3));
        
        $this->load->view('head', array('title'=>'Add Doctoral meeting'));
        
        if($this->session->userdata('is_admin'))
        {
            $this->load->view('jquery',array('ui'=>TRUE));
            $this->load->view('doctoral_meeting/set',array('id'=>$this->uri->segment(3), 'num'=>(int)($this->doctoral_meeting_model->get_num_count($this->uri->segment(3))) + 1 ));
        }
        else
        {
            $this->load->view('doctoral_meeting/not_set');
        }
        
        $this->load->view('footer');
    }


    public function edit()
    {
        $details = $this->doctoral_meeting_model->get($this->uri->segment(3));
        
        $this->load->view('head', array('title'=>'Edit Doctoral meeting'));
        $this->load->view('jquery',array('ui'=>TRUE));
        $this->load->view('doctoral_meeting/edit',$details);
        $this->load->view('footer');
        
    }
    
    public function submit()
    {
//        Load Libraries
        $this->load->library(array('form_validation'));
        
//        Error Delimiters
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

//        Validation Rules        
        $this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('venue', 'Venue', 'trim|required|xss_clean');
        $this->form_validation->set_rules('public_seminar', 'Public Seminar', 'trim|required|xss_clean');
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|required|xss_clean');
        
//        Validate
        if ($this->form_validation->run() == FALSE)
		{
            $this->load->view('head', array('title'=>'Set Doctoral meeting'));
            $this->load->view('doctoral_meeting/set',array('id' => $this->input->post('id'), 'num' => $this->input->post('num')));
            $this->load->view('footer');
		}
        else
        {
//            Prep Data for Insertion
            $num = $this->input->post('num');
            $id = $this->input->post('id');
            $date = $this->input->post('date');
            $venue = $this->input->post('venue');
            $public_seminar = $this->input->post('public_seminar');
            $remarks = $this->input->post('remarks');

            $details = array('num'=>$num, 'date'=>$date, 'venue'=>$venue, 'public_seminar'=>$public_seminar, 'remarks'=>$remarks, 'user_id' => $id);

            if($this->input->post('type') == 'add')
            {
//              Insert to Database
                $this->doctoral_meeting_model->add($details);
            }
            else
            {
                $this->doctoral_meeting_model->update ($details, $this->input->post('dm_id'));
            }

//            Redirect to Student View
            redirect('student/view/'.$id, 'refresh');
        }
    }
}

/* End of file doctoral_meeting.php */
/* Location: ./application/controllers/doctoral_meeting.php */
