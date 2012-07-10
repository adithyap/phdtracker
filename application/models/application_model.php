<?php

class Application_model extends CI_Model{

    public function __construct()
    {
        $this->load->database();
        $this->db->dbprefix('application');
    }
    
    public function upload($details)
    {
        $this->db->insert('application', $details);
    }
    
    public function get_applicants($id = 0)
    {
        if($id)
        {
            $query = $this->db->get_where('application',array('id' => $id, 'status' => 0));
        }
        else
        {
            $query = $this->db->get_where('application',array('status' => 0));
        }
        
        $i = 0;
        $details = array();
        foreach ($query->result() as $row)
        {    
            $details[$i]['id'] = $row->id;
            $details[$i]['name'] = $row->name;
            $details[$i]['dob'] = $row->dob;
            $details[$i]['area_of_interest'] = $row->area_of_interest;
            $details[$i]['synopsis'] = $row->synopsis;
            $details[$i]['email'] = $row->email;
            $details[$i]['resume'] = $row->resume;

            $i++;
        }
        
        return $details;
    }
    
    public function set_status($id, $status)
    {
        if($status == 'approve')
            $status = 1;
        else
            $status = -1;
        
        $this->db->where('id', $id);
        $this->db->update('application', array('status' => $status));
    }
}

/* End of file application.php */
/* Location: ./application/models/application.php */