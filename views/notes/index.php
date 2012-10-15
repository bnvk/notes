<h2>Notes</h2>

<?php if ($timeline): ?>
<ul id="notes">
	<?php foreach($timeline as $item): ?>
	<li class="note">
		<span class="note_text"><?= $item->content ?></span>
		<span class="note_details"><a href="<?= base_url().'notes/'.$note->content_id ?>"><?= format_datetime('MONTH_DAY_YEAR_TIME_ABBR', $note->created_at) ?></a></span>
	</li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>
