<form name="settings_update" id="settings_update" method="post" action="<?= base_url() ?>api/settings/modify" enctype="multipart/form-data">
<div class="content_wrap_inner">

	<div class="content_inner_top_right">
		<h3>App</h3>
		<p><?= form_dropdown('enabled', config_item('enable_disable'), $settings['notes']['enabled']) ?></p>
		<p><a href="<?= base_url() ?>api/<?= $this_module ?>/uninstall" id="app_uninstall" class="button_delete">Uninstall</a></p>
	</div>
	
	<h3>Permissions</h3>

	<p>Create
	<?= form_dropdown('create_permission', config_item('users_levels'), $settings['notes']['create_permission']) ?>
	</p>

	<p>Publish
	<?= form_dropdown('publish_permission', config_item('users_levels'), $settings['notes']['publish_permission']) ?>	
	</p>

	<p>Manage All
	<?= form_dropdown('manage_permission', config_item('users_levels'), $settings['notes']['manage_permission']) ?>	
	</p>

</div>

<span class="item_separator"></span>

<div class="content_wrap_inner">

	<h3>Display</h3>

	<p>Public Timeline
	<?= form_dropdown('public_timeline', config_item('yes_or_no'), $settings['notes']['public_timeline']) ?>
	</p>

	<p>Date
	<?= form_dropdown('date_style', config_item('date_style_types'), $settings['notes']['date_style']) ?>
	</p>

	<p>Status<br>
	<input type="text" size="4" name="status_length" value="<?= $settings['notes']['status_length'] ?>" /> characters
	</p>

	<p>Description<br>
	<input type="text" size="4" name="description_length" value="<?= $settings['notes']['description_length'] ?>" /> characters
	</p>

</div>

<span class="item_separator"></span>

<div class="content_wrap_inner">

	<h3>Actions</h3>

	<p>Share
	<?= form_dropdown('share', config_item('yes_or_no'), $settings['notes']['share']) ?>
	</p>
	
	<p>Like
	<?= form_dropdown('like', config_item('yes_or_no'), $settings['notes']['like']) ?>
	</p>

</div>

<span class="item_separator"></span>

<div class="content_wrap_inner">
	
	<h3>Comments</h3>

	<?php if (check_app_installed('comments')): ?>

	<p>Allow
	<?= form_dropdown('comments_allow', config_item('yes_or_no'), $settings['notes']['comments_allow']) ?>	
	</p>

	<p>Comments Per-Status
	<?= form_dropdown('comments_per_page', config_item('numbers_one_five'), $settings['notes']['comments_per_page']) ?>
	</p>

	<?php else: ?>
	<p>To allow comments on your Notes you need to install the <a href="https://social-igniter.com/apps/comments">Comments</a> App first. You will be able to configure this once installed</p>
	<?php endif; ?>

	<input type="hidden" name="module" value="<?= $this_module ?>">

	<p><input type="submit" name="save" value="Save" /></p>

</div>
</form>

<?= $shared_ajax ?>