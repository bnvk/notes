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
		
		// Define Global Variables
		$this->view_categories = NULL;
	}

	/* Groups Dropdown */
	function make_group_dropdown($user_id, $user_level_id, $add_label=FALSE)
	{
		$categories_query 		= $this->ci->social_tools->get_categories_view_multiple(array('categories.module' => 'home'));
		$this->view_categories 	= array('all' => 'All', 'friends' => 'Friends');
		$categories 			= $this->ci->social_tools->render_categories_children($categories_query, 0);
				
		// Add Category if Admin
		if (($user_level_id <= 2) AND ($add_label))
		{
			if (!$add_label)
			{
				$this->view_categories['add_category'] = '+ Add Category';	
			}
			else
			{
				$this->view_categories['add_category'] = $add_label;
			}	
		}
		
		return $this->view_categories;	
	}


	/* Timelione Items */

    /**
     * Generate Item
     *
     * @param	object	$activity	The activity to render
     * @return	string	The $activity, rendered as html
     */
    function render_item($activity)
    {
    	$data 		= json_decode($activity->data);
    	$item 		= $this->render_item_status($activity, $data);
    	
    	if ($activity->type != 'status')
    	{
    		$item .= $this->render_item_content($activity->type, $data);
    	}
   
    	return $item;
    }
    
    /**
     * Generate Status
     * 
     * @param object $activity The activity to render
     * @param object $data
     */
    function render_item_status($activity, $data)
    {
    	$has_url	= property_exists($data, 'url');
    	$has_title	= property_exists($data, 'title');    
    	$has_new	= property_exists($data, 'new');
    	$has_status = property_exists($data, 'status'); 
    
    	// Status
    	if ($activity->type == 'status')
    	{
    		return item_linkify($this->ci->social_igniter->get_content($activity->content_id)->content);
		}
				
		// Has Status
		if ($has_status)
		{
			return $object->status;
		}
       	else
    	{
    		$verb		= item_verb($this->ci->lang->line('verbs'), $activity->verb);
    		$article	= item_type($this->ci->lang->line('object_articles'), $activity->type);
    		$type		= item_type($this->ci->lang->line('object_types'), $activity->type);
    		
    		// Has Title
    		if (($has_title) && ($data->title))
    		{	    		
	    		if ($has_url)	$title_link = $type.' <a href="'.$data->url.'">'.character_limiter($data->title, 22).'</a>';
	    		else			$title_link = $data->title; 	
    		}
    		else
    		{
	    		if ($has_url)	$title_link = ' <a href="'.$data->url.'">'.$type.'</a>';
	    		else			$title_link = $type;
    		}
    		
    		return '<span class="item_verb">'.$verb.' '.$article.' '.$title_link.'</span>';
    	}    	
    }

    /**
     * Generate Content
     * 
     * 
     */
    function render_item_content($type, $object)
    {
        $has_thumb	  = property_exists($object, 'thumb');
    
		$render_function = 'render_item_'.$type;
		$callable_method = array($this, $render_function);
		   
		// Custom Render Exists    		    		
		if (is_callable($callable_method, false, $callable_function))
		{
			$content = $this->$render_function($object, $has_thumb);
		}
		else
		{
			$content = $this->render_item_default($object, $has_thumb);
		}
    	
    	return '<span class="item_content">'.$content.'</span>';
    }
    
    /* Item Types */
    function render_item_default($object, $has_thumb)
    {
	    // Has Thumbnail
		if (property_exists($object, 'content') AND $has_thumb) 
		{
			$content = '<span class="item_content_detail"><a href="'.$object->url.'"><img class="item_content_thumb" src="'.$object->thumb.'" border="0"></a>'.$object->content.'</span>';
		}
		elseif (!property_exists($object, 'content') AND $has_thumb) 
		{
			$content = '<span class="item_content_detail"><a href="'.$object->url.'"><img class="item_content_thumb" src="'.$object->thumb.'" border="0"></a></span>';
		}
		elseif (property_exists($object, 'content') AND property_exists($object, 'url') AND $object->content != '')
		{
			$content = '<span class="item_content_detail">"'.$object->content.'" <a href="'.$object->url.'">read</a></span>';
		}
		else
		{
			$content = '';
		}
	    
    	return $content;
    }
    
    function render_item_page($object, $has_thumb)
    {
    	return '<span class="item_content_detail">"'.$object->content.'" <a href="'.$object->url.'">read</a>"</span>';
    }

    function render_item_place($object, $has_thumb)
    {
		$place = '<span class="item_content_detail_sm">';
    
        if (property_exists($object, 'address'))
        {
        	$place .= $object->address.'<br>';
        }
        
        if (property_exists($object, 'locality'))
        {
        	$place .= $object->locality.', ';
        }
        
        if (property_exists($object, 'region'))
        {
        	$place .= $object->region;
        }
    
    	return $place.'</span></span>';
    }
    
    function render_item_image($object, $has_thumb)
    {    
    	return '<span class="item_content_detail"><a href="'.$object->url.'"><img src="'.$object->thumb.'" border="0"></a></span>';
    }
    
    function render_item_event($object, $has_thumb)
    {
    	$thumb	 = NULL;
    	$title	 = NULL;
    	$details = NULL;
			
	    // Has Thumbnail
		if ($has_thumb) 
		{
			$thumb = '<a href="'.$object->url.'"><img class="item_content_thumb" src="'.$object->thumb.'" border="0"></a>';
		}
		
		$title = '<span class="item_content_detail_sm"><a href="'.$object->url.'">'.$object->title.'</a></span>';
		
		// Location
		if (property_exists($object, 'location'))
		{
			$details = '<span class="item_content_detail_sm">Location: <span class="color_black">'.events_location($object->location, array('name','locality','region')).'</span></span>';
		}

		// Date
		if (property_exists($object, 'date_time'))
		{
			$details .= '<span class="item_content_detail_sm">Time: <span class="color_black">'.format_datetime('MONTH_DAY_YEAR', $object->date_time).'</span></span>';
		}

		// Description
		if (property_exists($object, 'description'))
		{		
			$details .= $object->content;
    	}
    	    
    	return $thumb.$title.$details;    
    }



	/* Get Timelines */
	function get_timeline($module, $limit)
	{
		if ($module)	$where = array('activity.module' => $module);
		else			$where = array();
		return $this->ci->activity_model->get_timeline($where, $limit);		
	}

	function get_timeline_friends($friends, $limit)
	{	
		$i 		= 0;
		$where	= 'activity.site_id = 1 AND ';
		foreach ($friends as $friend)
		{			
			if ($i >= 1) $or = " OR ";
			else $or = "";
			
			$where .= $or." activity.user_id = '". $friend->user_id . "'";
		
			$i++;
		}
	
		return $this->ci->activity_model->get_timeline($where, $limit);
	}

	function get_timeline_likes($likes, $limit)
	{	
		$i = 0;
		if ($likes)
		{
			$where = 'activity.site_id = 1 AND ';
			
			foreach ($likes as $like)
			{			
				if ($i >= 1) $or = " OR ";
				else $or = "";
				
				$where .= $or." activity.user_id = '". $like->user_id . "'";
				$i++;
			}		

			return $this->ci->activity_model->get_timeline($where, $limit);
		}
		else
		{
			return FALSE;
		}
	}

	function get_timeline_group($group, $limit)
	{	
		$i = 0;
		if ($group)
		{
			$where = 'activity.site_id = 1 AND content.category_id = '.$group;

			return $this->ci->activity_model->get_timeline($where, $limit);
		}
		else
		{
			return FALSE;
		}
	}

	function get_timeline_user($user_id, $limit)
	{	
	 	$where = array('activity.user_id' => $user_id);
	
		return $this->ci->activity_model->get_timeline($where, $limit);
	}
	
	function get_timeline_user_view($user_id, $parameter, $value, $limit)
	{
		$where = array('activity.user_id' => $user_id, 'activity.'.$parameter => $value);
	
		return $this->ci->activity_model->get_timeline($where, $limit);
	}

}