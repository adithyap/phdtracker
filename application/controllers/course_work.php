<?php

class Course_Work extends CI_Controller{
    public function __construct() {
        parent::__construct();
        
        $this->load->library('session');
        
        $this->load->helper(array('html', 'form', 'url'));
        
        $this->load->model(array('user_model','course_work_model'));
        
//        Check if Logged in
        if(! $this->session->userdata('logged_in'))
        {
            redirect('login/index','refresh');
        }
    }
    
    public function index(){
        $id = $this->course_work_model->get_cw_id($this->uri->segment(3));
        
        if($id)
        {
            $details = $this->course_work_model->get_cw($id);
            $this->load->view('course_work/view', $details);
        }
        else
        {
            if($this->session->userdata('is_admin'))
                $this->load->view('course_work/set',array('id'=>$this->uri->segment(3)));
            else
                $this->load->view('course_work/not_set');
        }
    }
    
    public function edit()
    {
        $details = $this->course_work_model->get_cw($this->course_work_model->get_cw_id($this->uri->segment(3)));
        
        $this->load->view('head', array('title'=>'Edit Course Work'));
        $this->load->view('course_work/edit',$details);
        $this->load->view('footer');
        
    }
    
    public function submit(){
//        Load Libraries
        $this->load->library(array('form_validation'));
        
//        Error Delimiters
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

//        Validation Rules        
        for($i = 1; $i < 5; $i++)
        {
            $this->form_validation->set_rules('course'.$i, 'Course'.$i, 'trim|required|alpha_dash|xss_clean');
            $this->form_validation->set_rules('mark'.$i, 'Mark '.$i, 'trim|numeric|xss_clean');
        }
        
//        Validate
        if ($this->form_validation->run() == FALSE)
		{
            $this->load->view('head', array('title'=>'Set Course Work'));
            $this->load->view('course_work/set',array('id' => $this->input->post('id')));
            $this->load->view('footer');
		}
        else
        {
//            Prep Data for Insertion
            $courses = implode(',',array($this->input->post('course1'), $this->input->post('course2'), $this->input->post('course3'), $this->input->post('course4')));
            $marks = implode(',',array($this->input->post('mark1'), $this->input->post('mark2'), $this->input->post('mark3'), $this->input->post('mark4')));
            $id = $this->input->post('id');
            
//            Compute Result
            $total_marks = (int)$this->input->post('mark1') + (int)$this->input->post('mark2') + (int)$this->input->post('mark3') + (int)$this->input->post('mark4');
            
            if($total_marks/4 < 60) $result = FALSE;
            else $result = TRUE;
            

            $details = array('courses' => $courses, 'marks' => $marks, 'result' => $result, 'user_id' => $id);

            if($this->input->post('type') == 'add')
            {
//              Insert to Database
                $this->course_work_model->add($details);
            }
            else
            {
                $this->course_work_model->update($details, $this->input->post('cw_id'));
            }

//            Redirect to Student View
            redirect('student/view/'.$id, 'refresh');
        }
    }
    
    
}

/* End of file course_work.php */
/* Location: ./application/controllers/course_work.php */
