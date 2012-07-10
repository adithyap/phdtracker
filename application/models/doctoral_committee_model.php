<?php

class Doctoral_Committee_model extends CI_Model{

    public function __construct()
    {
        $this->load->database();
        $this->db->dbprefix(array('user','doctoral_committee','doctoral_meeting'));
    }
    
    /**
     * Returns whether the User has been assigned a Doctoral Committee
     * @param Integer $id 
     */
    public function get_dc_id($id)
    {
        $query = $this->db->get_where('user',array('id' => $id));
        $row = $query->row();
        
        return $row->dc_id;
    }
    
    public function get_dc($id)
    {
        $query = $this->db->get_where('doctoral_committee',array('id' => $id));
        $row = $query->row();
        
        if($row)
        {
            $name = explode(',', $row->name);
            $affiliation = explode(',', $row->affiliation);
            $email = explode(',', $row->email);
            $phone_no = explode(',', $row->phone_no);
            $address = explode(',', $row->address);
            
            return array('id'=>$row->user_id, 'dc_id'=>$row->id ,'name'=>$name, 'affiliation'=>$affiliation, 'email'=>$email, 'phone_no'=>$phone_no, 'address'=>$address);
        }
        else
        {
            return FALSE;
        }
    }
    
    public function add($details)
    {
        $this->db->insert('doctoral_committee', $details);
        $insert_id = $this->db->insert_id();
        
        $this->db->where('id', $details['user_id']);
        $this->db->update('user', array('dc_id' => $insert_id));
    }
    
    public function update($details, $dc_id)
    {
        $this->db->where('id', $dc_id);
        $this->db->update('doctoral_committee', $details);
    }
}

/* End of file doctoral_committee_model.php */
/* Location: ./application/models/doctoral_committee_model.php */