<?php

class Comprehensive_Viva_model extends CI_Model{

    public function __construct()
    {
        $this->load->database();
        $this->db->dbprefix(array('user','comprehensive_viva'));
    }
    
    /**
     * Returns whether the User has been assigned a Doctoral Committee
     * @param Integer $id 
     */
    public function get_id($id)
    {
        $query = $this->db->get_where('user',array('id' => $id));
        $row = $query->row();
        
        return $row->cv_id;
    }
    
    public function get($id)
    {
        $query = $this->db->get_where('comprehensive_viva',array('id' => $id));
        $row = $query->row();
        
        if($row)
        {
            $name = explode(',', $row->name);
            $affiliation = explode(',', $row->affiliation);
            $result = $row->result;
            $date = $row->date;
            
            return array('id' => $row->user_id , 'cv_id' => $row->id ,'name'=>$name, 'affiliation'=>$affiliation, 'date'=>$date, 'result'=>$result);
        }
        else
        {
            return FALSE;
        }
    }
    
    public function add($details)
    {
        $this->db->insert('comprehensive_viva', $details);
        $insert_id = $this->db->insert_id();
        
        $this->db->where('id', $details['user_id']);
        $this->db->update('user', array('cv_id' => $insert_id));
    }
    
    public function update($details, $cv_id)
    {
        $this->db->where('id', $cv_id);
        $this->db->update('comprehensive_viva', $details);
    }
}

/* End of file comprehensive_viva_model.php */
/* Location: ./application/models/comprehensive_viva_model.php */