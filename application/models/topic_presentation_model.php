<?php

class Topic_Presentation_model extends CI_Model{

    public function __construct()
    {
        $this->load->database();
        $this->db->dbprefix(array('user','topic_presentation'));
    }
    
    
}

?>
