<form method="post" id="status_update" action="<?= base_url() ?>api/content/create">
	<ul id="notes_extras">
		<li><a href="#" id="notes_add_attachments"><span class="actions action_link"></span> Add Attachments</a></li>
		<li><input type="checkbox" name="short_url" value="1" id="short_url" class="settings_post" autocomplete="off"> Shorten URL</li>
		<!-- <li><a href="">Get location <span class="actions action_crosshairs"></span></a></li> -->
	</ul>
	<textarea id="status_update_text" placeholder="<?= $home_greeting ?>" name="content"></textarea>	
	<div id="status_update_options">
		<?php if ($logged_geo_enabled): ?>
		<div id="status_update_geo">
			<a href="#" class="find_location" id="status_find_location"><span>Get Location</span></a>
		</div>
		<?php endif; ?>		
		<?= $social_post ?>
		<ul id="notes_attachments"></ul>
		<div class="clear"></div>
	</div>
	<div id="status_update_post">
		<input type="submit" name="post" id="status_post" value="Share" />
		<span id="character_count"></span>
	</div>
	<div class="clear"></div>

	<input type="hidden" name="access" id="access" value="E" />
	<input type="hidden" name="geo_lat" id="geo_lat" value="" />
	<input type="hidden" name="geo_long" id="geo_long" value="" />
</form>
<div class="clear"></div>

<ol id="feed">
	<?= $timeline_view ?>
</ol>
<div class="clear"></div>

<script type="text/template" id="item_timeline_template">
	<?= $timeline_template ?>
</script>

<script type="text/template" id="notes_add_attachments_template">
	<textarea id="notes_add_attachment_textarea" placeholder='<img src="http://www.website.com">' name="attachment"></textarea>	
</script>

<script type="text/template" id="notes_attachment_template">
	<li>Attachment {title} <input type="hidden" class="note_attachment" value='{attachment}' name="attachments[]"></li>
</script>

<script type="text/javascript">
$(document).ready(function()
{
	// Geo
	geo_get();

	// Character Counter
	$('#status_update_text').NobleCount('#character_count',
	{
		on_negative: 'color_red'
	});

	// Update Status
	$('#status_update').bind('submit', function(e)
	{
		e.preventDefault();
		$.validator(
		{
			elements :
				[{
					'selector' 	: '#status_update_text',
					'rule'		: 'require', 
					'field'		: 'Please write something...',
					'action'	: 'element'
				}],
			message	 : '',
			success	 : function()
			{
				if (is_int($('#select_group').val()))
				{
	    			var group_id = $('#select_group').val();
	    		}
	    		else
	    		{
	    			var group_id = 0;
	    		}

	    		// Basic Note Data
				var status_data	= $('#status_update').serializeArray();
				status_data.push(
					{'name':'category_id','value':group_id},
					{'name':'module','value':'notes'},
					{'name':'type','value':'status'},
					{'name':'source','value':'website'},
					{'name':'comments_allow','value':'Y'},
					{'name':'status','value':'publish'});

				// Add Settings (short_url, geo, etc...)
				addLocalSettingsPost(status_data);

				// Create Note
				$.oauthAjax(
				{
					oauth 		: user_data,
					url			: base_url + 'api/content/create',
					type		: 'POST',
					dataType	: 'json',
					data		: status_data,
				  	success		: function(result)
				  	{		  		  	
						if (result.status == 'success')
						{
							// Add Attachments
							if ($('#notes_attachments li').length)
							{
								$.each($('#notes_attachments li input'), function()
								{
									var note_data = [{'name':'meta','value':'attachment'},{'name':'value','value':$(this).val()}];

									$.oauthAjax(
									{
										oauth 		: user_data,
										url			: base_url + 'api/content_meta/create/id/' + result.data.content_id,
										type		: 'POST',
										dataType	: 'json',
										data		: note_data,
									  	success		: function(result)
									  	{	
											console.log(result);
										}
									});									
								});
								
								$('#notes_attachments').html('');
							}
						
							// Social Post
							var social_post = $('input.social_post');
							if (social_post.length > 0)
							{	
								// Extra Data To Social
								status_data.push({'name':'content_id','value':result.data.content_id});
								status_data.push({'name':'long_url','value':base_url + 'notes/' + result.data.content_id});

								// If short_url exists
								if (result.short_url !== undefined)
								{
									status_data.push({'name':'short_url','value':result.short_url});
								}
								
								// Do Social Post (Twitter, Facebook, App.net, etc...)
								$.each(social_post, function()
								{
									var social_api = $(this).attr('name');
									if ($('#social_post_' + social_api).is(':checked'))
									{							
										$.oauthAjax(
										{
											oauth 		: user_data,
											url			: base_url + 'api/' + social_api + '/social_post',
											type		: 'POST',
											dataType	: 'json',
											data		: status_data,
										  	success		: function(social_result)
										  	{
										  		// Need to do some UI notification
											}
										});
									}
								});
							}				
															
							var newHTML = $.template($('#item_timeline_template').html(),
							{
								'ITEM_ID'			 :result.activity.content_id,
								'ITEM_AVATAR'		 :getUserImageSrc(result.data),
								'ITEM_COMMENT_AVATAR':getUserImageSrc(result.data),
								'ITEM_PROFILE'		 :result.data.username,
								'ITEM_CONTRIBUTOR'	 :result.data.name,
								'ITEM_CONTENT'		 :result.data.content,
								'ACTIVITY_TYPE'		 :result.activity.type,
								'ITEM_DATE'			 :'just now',
								'ACTIVITY_MODULE'	 :result.activity.module,
								'ITEM_CONTENT_ID'	 :result.data.content_id,
								'ITEM_URL'			 : base_url + 'notes/' + result.data.content_id
							});

							$('#feed').prepend(newHTML);
							$('#status_update_text').val('');
					 	}
					 	else
					 	{
							$('#content_message').notify({message:result.message});				
					 	}	
				 	}
				});
			}
		});
	});

	// Browse Group
	$('#select_group').change(function()
	{
		var group_id = $(this).val();	
		if (is_int(group_id))
		{
	    	window.location = base_url + 'home/group/' + group_id;
    	}
    	else if (group_id == 'add_category')
    	{
			// This is just here so the add category will work	
    	}
    	else if (group_id == 'all') 
    	{
			window.location = base_url + 'home';
		}
		else if (!is_int(group_id))
		{
			window.location = base_url + 'home/' + group_id;
		}    	
    });

	// Add Category
	$('#select_group').categoryManager(
	{
		action		: 'create',		
		module		: 'home',
		type		: 'group',
		title		: 'Add Group'
	}); 
	
	// Add Connections
	$('#social_connections_add').bind('click', function(e)
	{
		e.preventDefault();
		$.get(base_url + 'dialogs/add_connections', function(partial_html)
		{
			$('<div />').html(partial_html).dialog(
			{
				width	: 325,
				modal	: true,
				close	: function(){$(this).remove()},
				title	: 'Add Connections',
				create	: function()
				{
					$parent_dialog = $(this);
					// Do Custom Things
				}
	    	});
		});
	});


	// Add Connections
	$('#notes_add_attachments').bind('click', function(e)
	{
		e.preventDefault();
		var add_attachment_html = $.template($('#notes_add_attachments_template').html());

		$('<div />').html(add_attachment_html).dialog(
		{
			width	: 375,
			modal	: true,
			close	: function(){$(this).remove()},
			title	: 'Paste HTML Attachment',
			create	: function()
			{
				$parent_dialog = $(this);
			},
			buttons	:
			{
				'Attach':function()
				{
					var attachment_data = { 
						title: $('#notes_attachments li').length + 1,
						attachment: $('#notes_add_attachment_textarea').val()
					};

					var attachment_html = $.template($('#notes_attachment_template').html(), attachment_data);

					$('#notes_attachments').append(attachment_html);

					$(this).dialog('close');			
				},
				'Cancel':function()
				{
					$(this).dialog('close');
				}				
			}
		});
	});


});
</script>
