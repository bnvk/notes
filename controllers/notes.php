<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:			Social Igniter : Notes : Controller
* Author: 		Localhost
* 		  		hi@brennannovak.com
* 
* Project:		http://social-igniter.com
* 
* Description: This file is for the public Notes Controller class
*/
class Notes extends Site_Controller
{
    function __construct()
    {
        parent::__construct();       
	}

	function _remap($method)
	{	
		if (($this->uri->segment(2) == 'view') AND ($this->uri->segment(3)))
		{
			redirect('/notes/'.$this->uri->segment(3));
		}
		elseif (($this->uri->segment(2) == 'view') AND (!$this->uri->segment(3)))
		{
			redirect('/notes');
		}
		elseif ($this->uri->segment(2))
		{		
			$this->note();
		}
		else
		{
			$this->index();
		}	
	}

	function index()
	{
		$this->data['timeline'] = $this->social_igniter->get_content_view('type', 'status', 'all', 20);
	
		$this->data['page_title'] = 'Notes';
		$this->render();
	}

	function note() 
	{		
		$this->data['note'] = $this->social_igniter->get_content($this->uri->segment(2));
				
		$this->render('wide', 'note');
	}
	

	/* Widgets */
	function widgets_recent_notes($widget_data)
	{
		// Load Template Model

		$this->load->view('widgets/recent_notes', $widget_data);
	}

}
