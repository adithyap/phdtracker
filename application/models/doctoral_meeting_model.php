<?php

class Doctoral_Meeting_model extends CI_Model{

    public function __construct()
    {
        $this->load->database();
        $this->db->dbprefix(array('user','doctoral_meeting'));
    }
    
    public function get_id($id)
    {
        $query = $this->db->get_where('user',array('id' => $id));
        $row = $query->row();
        
        return explode(',', $row->dm_id);
    }
    
    public function get($id)
    {
        $query = $this->db->get_where('doctoral_meeting',array('id' => $id));
        
        if( ($row = $query->row_array()) )
        {
            return $row;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function get_num($id)
    {
        $query = $this->db->get_where('doctoral_meeting',array('id' => $id));
        
        if( ($row = $query->row()) )
        {
            return ((int)($row->num) + 1);
        }
        else
        {
            return 1;
        }
    }
    
    public function get_num_count($id)
    {
        $query = $this->db->get_where('doctoral_meeting',array('user_id' => $id));
        
        return $query->num_rows();
    }
    
    public function add($details)
    {
        $this->db->insert('doctoral_meeting', $details);
        $insert_id = $this->db->insert_id();
        
        if($this->get_num_count($details['user_id']))
        {
            $query = $this->db->get_where('user',array('id' => $details['user_id']));
            $row = $query->row();
            $insert_id = $row->dm_id . ',' . $insert_id;
        }
        
        $this->db->where('id', $details['user_id']);
        $this->db->update('user', array('dm_id' => $insert_id));
    }
    
    public function update($details, $dm_id)
    {
        $this->db->where('id', $dm_id);
        $this->db->update('doctoral_meeting', $details);
    }
}

/* End of file doctoral_meeting_model.php */
/* Location: ./application/models/doctoral_meeting_model.php */