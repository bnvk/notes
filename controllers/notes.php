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
		$note = $this->social_igniter->get_content_view_multiple(array('type' => 'status', 'content_id' => $this->uri->segment(2)), 'P');

		if (!$note) redirect('notes');

    $users = $this->social_auth->get_users('active', 1);
    $users_urls = array();

    foreach($users as $user):
      $users_urls[$user->username] = $user->url;
    endforeach;

 		// Is Response
 		if ($note[0]->parent_id):
      $this->data['response'] = $this->social_igniter->get_content($note[0]->parent_id);
      $this->data['response_site'] = $this->social_igniter->get_site($this->data['response']->site_id);
 			$this->data['response_user'] = $this->social_auth->get_user('user_id', $this->data['response']->user_id);        
 		endif;

		$note_social = $this->notes_model->get_note_social_post($note[0]->content_id, $note[0]->user_id);
		$note_extras = $this->social_igniter->get_meta_content($note[0]->content_id);
 		
    $this->data['users_urls']   = $users_urls;
		$this->data['note']			    = $note[0];

 		$this->data['note_social']	= $note_social;
 		$this->data['note_extras']	= $note_extras;
 		$this->data['short_url']	  = $this->social_igniter->find_meta_content_value('short_url', $note_extras);

 		// Core Values
 		$default_image					    = $this->data['this_module_assets'].'notes_32.png';
 		$meta_description				    = truncator($note[0]->content, 25);
 		$this->data['site_image']		= find_image_in_note($note[0]->content, $note_extras, $default_image);
 		$this->data['site_description']	= $meta_description;
 		$this->data['page_title']		= $meta_description;

		$this->render('wide', 'note');
	}

	/* Widgets */
	function widgets_recent_notes($widget_data)
	{
		$this->load->view('widgets/recent_notes', $widget_data);
	}

	function widgets_share_note($widget_data)
	{
    if ($this->uri->segment(1) == 'notes' and $this->uri->segment(2)):
		  $this->load->view('widgets/share_note', $widget_data);
    endif;
	}

}
