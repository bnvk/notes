<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:			Social Igniter : Notes : Widgets
* Author: 		Localhost
* 		  		hi@brennannovak.com
*          
* Project:		http://social-igniter.com/
*
* Description: 	Installer values for Notes for Social Igniter 
*/

$config['notes_widgets'][] = array(
	'regions'	=> array('sidebar','content', 'wide'),
	'widget'	=> array(
		'module'	=> 'notes',
		'name'		=> 'Recent Notes',
		'method'	=> 'run',
		'path'		=> 'widgets_recent_notes',
		'multiple'	=> 'FALSE',
		'order'		=> '1',
		'title'		=> 'Recent Notes',
		'content'	=> ''
	)
);
$config['notes_widgets'][] = array(
	'regions'	=> array('content', 'wide'),
	'widget'	=> array(
		'module'	=> 'notes',
		'name'		=> 'Share Note',
		'method'	=> 'run',
		'path'		=> 'widgets_share_note',
		'multiple'	=> 'FALSE',
		'order'		=> '2',
		'title'		=> 'Share & Reply',
		'content'	=> ''
	)
);