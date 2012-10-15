<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:			Social Igniter : Notes : Settings Controller
* Author: 		Localhost
* 		  		hi@brennannovak.com
* 
* Project:		http://social-igniter.com
* 
* Description: This file is for the Notes Settings Controller class
*/
class Settings extends Dashboard_Controller 
{
    function __construct() 
    {
        parent::__construct();

		if ($this->data['logged_user_level_id'] > 1) redirect('home');	
        
        $this->load->config('notes');
        
		$this->data['page_title']	= 'Settings';
    }
 
 	function index()
	{
		if (config_item('notes_enabled') == '') 
		{
			$this->session->set_flashdata('message', 'Oops, the Notes is not installed');
			redirect('settings/apps');
		}
			
		$this->data['sub_title']    = 'Notes';
		$this->data['shared_ajax'] .= $this->load->view(config_item('dashboard_theme').'/partials/settings_modules_ajax.php', $this->data, true);		
		$this->render('dashboard_wide');
	}
	
	function widgets()
	{
		$this->data['sub_title'] = 'Widgets';		
		$this->render('dashboard_wide');
	}		

}