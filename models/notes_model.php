<?php

class Notes_model extends CI_Model {
    
    function __construct()
    {
        parent::__construct();
    }
    
    function get_note_social_post($content_id, $user_id)
    {
 		$this->db->select('*');
 		$this->db->from('content_meta');
 		$this->db->join('sites', 'sites.site_id = content_meta.site_id');		    
 		$this->db->join('connections', 'connections.site_id = content_meta.site_id', 'left'); 
 		$this->db->where('content_meta.content_id', $content_id);
 		$this->db->where('connections.user_id', $user_id);
 		$result = $this->db->get();	
 		return $result->result();     
    }
    
}