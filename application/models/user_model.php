<?php

class User_model extends CI_Model{

    public function __construct()
    {
        $this->load->database();
        $this->db->dbprefix('user');
    }
    
    public function authenticate($username, $password)
    {
        $query = $this->db->get_where('user',array('username'=>$username, 'password'=>$password));
        
        if($query->result())
            return TRUE;
        
        return FALSE;
    }
    
    public function get_id($username)
    {
        $query = $this->db->get_where('user',array('username'=>$username));
        $row = $query->row();
        
        return $row->id;
    }
    
    public function is_admin($username)
    {
        $query = $this->db->get_where('user',array('username'=>$username));
        $row = $query->row();
        
        if($row->role == 1)
            return TRUE;
        
        return FALSE;
    }
    
    public function get_students($id = 0)
    {
        if($id)
        {
            $query = $this->db->get_where('user',array('id' => $id, 'role' => 2));
        }
        else
        {
            $query = $this->db->get_where('user',array('role' => 2));
        }

        $i = 0;
        $details = array();
        foreach ($query->result() as $row)
        {
            $details[$i]['id'] = $row->id;
            $details[$i]['name'] = $row->name;
            
            $i++;
        }
        
        return $details;
    }
    
    public function create_account($id)
    {
        $query = $this->db->get_where('tbl_application',array('id' => $id));
        $row = $query->row();
        
        $name = $row->name;
        $name = str_replace(' ', '_', $name);
        $username = strtolower($name);
        
        $this->db->insert('user', 
                array('username' => $username, 'password' => md5($username), 'name' => $row->name, 'application_id' => $row->id));
    }
}

/* End of file user.php */
/* Location: ./application/models/user.php */