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

<div class="note_details"><?= format_datetime('MONTH_DAY_YEAR_TIME_ABBR', $note->created_at) ?> via <a href="<?= base_url() ?>"><?= ucwords($note->source) ?></a></div>

<div>
    
    <h3>Share &amp; Respond</h3>

    <ul>
        <li><a href="https://twitter.com">Reply on Twitter</a></li>
        <li><a href="https://alpha.app.net">Reply on App.net</a></li>
    </ul>

    <label for="permalink" class="permalink-label">Permalink</label> <input type="text" name="permalink" value="<?= base_url().'notes/'.$note->content_id ?>" class="span4 permalink" onclick="this.focus(); this.select();">
    <label for="shortlink" class="permalink-label">Shortlink</label> <input type="text" name="shortlink" value="<?= base_url().'notes/'.$note->content_id ?>" class="span4 shortlink" onclick="this.focus(); this.select();">

    <div class="web-actions">
    	Retweet on Twitter<br>
        Like on Facebook
    </div>

</div>