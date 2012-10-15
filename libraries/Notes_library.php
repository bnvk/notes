<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Notes Library
*
* @package		Social Igniter
* @subpackage	Notes Library
* @author		Localhost
*
* Contains methods for Notes App
*/

class Notes_library
{
	function __construct()
	{
		// Global CodeIgniter instance
		$this->ci =& get_instance();

	}
	
	/* Interact with Data_Model */
	function my_custom_method($data_id)
	{
		return $this->ci->notes_model->get_data($data_id);
	}

}