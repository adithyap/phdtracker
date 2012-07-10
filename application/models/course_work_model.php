<?php

class Course_Work_model extends CI_Model{

    public function __construct()
    {
        $this->load->database();
        $this->db->dbprefix(array('user','course_work'));
    }
    
    /**
     * Returns whether the User has been assigned their Course Work
     * @param Integer $id 
     */
    public function get_cw_id($id)
    {
        $query = $this->db->get_where('user',array('id' => $id));
        $row = $query->row();
        
        return $row->cw_id;
    }
    
    public function get_cw($id)
    {
        $query = $this->db->get_where('course_work',array('id' => $id));
        $row = $query->row();
        
        if($row)
        {
//            Form Array from Data
            $courses = explode(',', $row->courses);
            $marks = explode(',', $row->marks);
            
            return array('id' => $row->user_id , 'cw_id' => $row->id ,'courses'=>$courses, 'marks'=>$marks, 'pass'=>$row->result);
        }
        else
        {
            return FALSE;
        }
    }
    
    public function add($details)
    {
        $this->db->insert('course_work', $details);
        $insert_id = $this->db->insert_id();
        
        $this->db->where('id', $details['user_id']);
        $this->db->update('user', array('cw_id' => $insert_id));
    }
    
    public function update($details, $cw_id)
    {
        $this->db->where('id', $cw_id);
        $this->db->update('course_work', $details);
    }
}

/* End of file course_work.php */
/* Location: ./application/models/course_work.php */