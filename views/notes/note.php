<div id="note_creator">
	<img class="note_creator_avatar" src="<?= $this->social_igniter->profile_image($note->user_id, $note->image, $note->gravatar, 'medium'); ?>">
	<div class="note_creator_info">
		<h2><?= $note->name ?></h2>
		<a href="<?= base_url().'people/'.$note->username ?>">@<?= $note->username ?></a> on <?= format_datetime('MONTH_DAY_YEAR_ABBR', $note->created_at) ?></a>
	</div>
</div>

<div id="note">
	<?= item_linkify($note->content, 'twitter') ?>
</div>

<div id="note_attachments">
	<?php foreach ($note_extras as $extra): if ($extra->meta == 'attachment'): ?>
		<div class="note_attachment"><?= str_replace(array('&lt;', '&gt;'), array('<', '>'), $extra->value) ?></div>
	<?php endif; endforeach; ?>
</div>

<?php if ($note_social): ?>
<div class="note_respond">
	<h4>Reply Via</h4> 
	<ul>
	<?php foreach($note_social as $social): ?>
		<li><a href="<?= $this->notes_library->make_social_post_url($social); ?>" target="_blank"><?= $social->title ?></a> </li>
	<?php endforeach; ?>
	</ul>
	<div class="clear"></div>
</div>
<?php endif; ?>

<div class="note_respond">
    <h4>Share &amp; Respond</h4>

    <?php if ($short_url): ?>
    <label for="shortlink" class="permalink-label">Shortlink</label>
    <input type="text" name="shortlink" value="<?= $short_url ?>" class="span4 shortlink" onclick="this.focus(); this.select();">
    <?php endif; ?>

    <label for="permalink" class="permalink-label">Permalink</label>
    <input type="text" name="permalink" value="<?= base_url().'notes/'.$note->content_id ?>" class="span4 permalink" onclick="this.focus(); this.select();">

    <?php if (config_item('notes_social_buttons') == 'TRUE'): ?>
	<table border="0" cellpadding="4">
	<tr>
		<td><script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script><g:plusone size="medium" href="<?= base_url().'notes/'.$note->content_id ?>"></g:plusone></td>		
		<td><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?= base_url().'notes/'.$note->content_id ?>" data-text="<?= character_limiter(strip_quotes($note->content), 115).' '.base_url().'notes/'.$note->content_id ?>" data-count="horizontal" data-via="<?= config_item('twitter_default_account') ?>">Tweet</a><script type="text/javascript" src="https://platform.twitter.com/widgets.js"></script></td>
		<td><iframe src="https://www.facebook.com/plugins/like.php?href=<?= base_url().'notes/'.$note->content_id ?>&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=112321278779214" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:21px;" allowTransparency="true"></iframe></td>
	</tr>
	</table>
	<?php endif; ?>
</div>