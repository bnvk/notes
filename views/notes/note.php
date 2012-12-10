<div id="note_creator">
	<img class="note_creator_avatar" src="<?= $this->social_igniter->profile_image($note->user_id, $note->image, $note->gravatar, 'medium'); ?>">
	<div class="note_creator_info">
		<h2><?= $note->name ?></h2>
		<a href="<?= base_url().'people/'.$note->username ?>">@<?= $note->username ?></a>
	</div>
</div>

<div id="note">
<?= $note->content ?>
</div>

<div class="note_details"><?= format_datetime('MONTH_DAY_YEAR_TIME_ABBR', $note->created_at) ?> via <a href="<?= base_url() ?>"><?= config_item('site_title') ?></a></div>

<div id="note_syndicated">
	<h4>Reply Via</h4> 
	<p>
	<?php foreach($note_meta as $meta): ?>
		<a href="<?= $this->notes_library->make_social_post_url($meta); ?>" target="_blank"><?= $meta->title ?></a> &nbsp;&nbsp;
	<?php endforeach; ?>
	</p>
</div>


<div id="note_share_respond">
    <h4>Share &amp; Respond</h4>

    <label for="permalink" class="permalink-label">Permalink</label>
    <input type="text" name="permalink" value="<?= base_url().'notes/'.$note->content_id ?>" class="span4 permalink" onclick="this.focus(); this.select();">
    <label for="shortlink" class="permalink-label">Shortlink</label>
    <input type="text" name="shortlink" value="<?= base_url().'notes/'.$note->content_id ?>" class="span4 shortlink" onclick="this.focus(); this.select();">

    <div id="note_share_actions">
		<table border="0" cellpadding="4">
		<tr>
			<td><script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script><g:plusone size="medium" href="<?= base_url().'notes/'.$note->content_id ?>"></g:plusone></td>		
			<td><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?= base_url().'notes/'.$note->content_id ?>" data-text="<?= character_limiter(strip_quotes($note->content), 115).' '.base_url().'notes/'.$note->content_id ?>" data-count="horizontal" data-via="<?= config_item('twitter_default_account') ?>">Tweet</a><script type="text/javascript" src="https://platform.twitter.com/widgets.js"></script></td>
			<td><iframe src="https://www.facebook.com/plugins/like.php?href=<?= base_url().'notes/'.$note->content_id ?>&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=112321278779214" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:21px;" allowTransparency="true"></iframe></td>
		</tr>
		</table>
    </div>
</div>