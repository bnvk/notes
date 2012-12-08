<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:			Social Igniter : Notes : Routes
* Author: 		Localhost
* 		  		hi@brennannovak.com
*          
* Project:		http://social-igniter.com/
*
* Description: 	URI Routes for Notes for Social Igniter 
*/


/* Home */
$route['home/notes/group/(:any)']		= 'home/index/$1/$2';
$route['home/notes/friends']			= 'home/index';
$route['home/notes/likes']				= 'home/index';
$route['home/notes']					= 'home/index';

$route['notes'] 						= 'notes';