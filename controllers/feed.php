<?php

class Feed extends MY_Controller 
{ 
  function __construct() 
  {
    parent::__construct();    
    $this->load->helper('xml');        
  }

  function index()
  {    
    $this->data['site_feed']	   = base_url().'feed/notes';
    $this->data['item_base_url'] = base_url().'notes/';
    $this->data['contents']      = $this->social_igniter->get_content_recent('status', 45);
    
    $this->output->set_header('Content-type:application/rss+xml');
    echo $this->load->view('../views/feeds/rss', $this->data, true);
  }

}
?>