<?php if ($response): ?>
<div id="note-reply" class="note-reply-context p-in-reply-to h-entry">
	<img class="note_creator_avatar u-logo logo u-photo photo" src="<?= $this->social_igniter->profile_image($response_user->user_id, $response_user->image, $response_user->gravatar, 'medium'); ?>" alt="">						
	<div class="note_creator_info">
	<a class="u-url p-name" href="<?= base_url().'people/'.$response_user->username ?>"><h2><?= $response_user->name ?></h2></a>
	<span class="p-summary p-name p-content">
		Posted <a href="<?= $response->url ?>" target="_blank"><?= $response->title ?></a>
	</span>
	</div>
	<div class="clear"></div>
</div>
<?php endif; ?>

<div id="note_creator" class="h-card">
	<img class="note_creator_avatar u-logo logo u-photo photo" src="<?= $this->social_igniter->profile_image($note->user_id, $note->image, $note->gravatar, 'medium'); ?>">
	<div class="note_creator_info">
		<a href="<?= base_url().'people/'.$note->username ?>"><h2 class="p-name fn"><?= $note->name ?></h2></a>
		<?php if ($response): ?>Replied<?php else: ?>Posted<?php endif; ?> at
		<time class="dt-published published dt-updated updated" datetime="<?= $note->created_at ?>"><?= format_datetime('MONTH_DAY_YEAR_ABBR', $note->created_at) ?></time> 
	</div>
</div>

<div id="note">
	<?= item_linkify($note->content, 'twitter') ?>
</div>

<div id="note_attachments">
	<?php foreach ($note_extras as $extra): if ($extra->meta == 'attachment'): ?>
		<div class="note_attachment"><?= nl2br(str_replace(array('&lt;', '&gt;'), array('<', '>'), $extra->value)) ?></div>
	<?php endif; endforeach; ?>
</div>



<?php if ($note_social): ?>
<div class="note_respond">
	<h4>Reply Via</h4> 
	<ul>
	<?php foreach($note_social as $social): ?>
		<li><a href="<?= $this->notes_library->make_social_post_url($social); ?>" rel="syndication" class="u-syndication" target="_blank"><?= $social->title ?></a> </li>
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