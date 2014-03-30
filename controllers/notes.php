<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:		 Social Igniter : Notes : Controller
* Author:  Brennan Novak
* 		  	 hi@brennannovak.com
* 
* Project: http://social-igniter.com
* 
* Description: This file is for the public Notes Controller class
*/
class Notes extends Site_Controller
{
  function __construct()
  {
    parent::__construct();

    $this->load->helper('../modules/notes/helpers/notes_helper');
    $this->load->model('notes_model');
    $this->load->library('notes_library');
	}

	function _remap($method)
	{
		if (($this->uri->segment(2) == 'view') AND ($this->uri->segment(3))):
			redirect('/notes/'.$this->uri->segment(3));
		elseif (($this->uri->segment(2) == 'view') AND (!$this->uri->segment(3))):
			redirect('/notes');
		elseif ($this->uri->segment(2)):
			$this->note();		
		else:		
			$this->index();
		endif;	
	}

	function index()
	{
		$this->data['timeline'] = $this->social_igniter->get_content_view('type', 'status', 'all', 20);
	
		$this->data['page_title'] = 'Notes';
		$this->render();
	}

	function note() 
	{		
		$note = $this->social_igniter->get_content($this->uri->segment(2));

		if (!$note) redirect('notes');

		$note_social = $this->notes_model->get_note_social_post($note->content_id, $note->user_id);
		$note_extras = $this->social_igniter->get_meta_content($note->content_id);

		$this->data['note']			= $note;
 		$this->data['note_social']	= $note_social; 		
 		$this->data['note_extras']	= $note_extras;
 		$this->data['short_url']	= $this->social_igniter->find_meta_content_value('short_url', $note_extras);

 		// Is Response
 		$response = $this->social_igniter->find_meta_content_value('response', $note_extras);

 		if ($response):
 			$response = json_decode($response);
 			$this->data['response_user'] = $this->social_auth->get_user('user_id', $response->user_id); 
 		endif;
 		
 		$this->data['response']	= $response;


 		// Core Values
 		$default_image					= $this->data['this_module_assets'].'notes_32.png';
 		$meta_description				= truncator($note->content, 25);
 		$this->data['site_image']		= find_image_in_note($note->content, $note_extras, $default_image);
 		$this->data['site_description']	= $meta_description;
 		$this->data['page_title']		= $meta_description;

		$this->render('wide', 'note');
	}	

	/* Widgets */
	function widgets_recent_notes($widget_data)
	{
		$this->load->view('widgets/recent_notes', $widget_data);
	}

}
