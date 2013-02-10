<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:			Social Igniter : Notes : API Controller
* Author: 		Localhost
* 		  		hi@brennannovak.com
* 
* Project:		http://social-igniter.com
* 
* Description: This file is for the Notes API Controller class
*/
class Api extends Oauth_Controller
{
    function __construct()
    {
        parent::__construct();
	}

    /* Install App */
	function install_get()
	{
		// Load
		$this->load->library('installer');
		$this->load->config('install');

		// Settings & Create Folders
		$settings = $this->installer->install_settings('notes', config_item('notes_settings'));

		if ($settings == TRUE)
		{
            $message = array('status' => 'success', 'message' => 'Yay, the Notes App was installed');
        }
        else
        {
            $message = array('status' => 'error', 'message' => 'Dang Notes App could not be installed');
        }		
		
		$this->response($message, 200);
	} 

}