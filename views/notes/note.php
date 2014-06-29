<article class="h-as-note h-entry hentry note-single">
  <?php if ($note->parent_id): ?>  
  <!-- Indie Web Reply Contexts | http://indiewebcamp.com/reply-context -->
  <div id="note-reply" class="note-reply-context p-in-reply-to h-cite">
    <a href="<?= $response_site->url ?>" target="_blank"><img class="note_creator_avatar u-logo logo u-photo photo" src="<?= $this->social_igniter->profile_image($response_user->user_id, $response_user->image, $response_user->gravatar, 'medium'); ?>" alt=""></a>		
  	<div class="note_creator_info">    	
  	  <a class="p-publisher h-card" href="<?= $response_site->url ?>" target="_blank"><?= $response_user->name ?></a>
      <div class="p-summary p-name e-content">
    	<?= item_linkify(nl2br($response->content)) ?>
      </div>
  	  <a class="u-url" href="<?= $response->canonical ?>"><time class="dt-published published" datetime="<?= $response->created_at ?>"><?= format_datetime('MONTH_DAY_YEAR_ABBR', $response->created_at) ?></time></a>
  	</div>
  	<div class="clear"></div>
  </div>
  <?php endif; ?>

  <!-- Author -->
  <div id="note_creator" class="p-author author h-card vcard">
  	<a href="<?= base_url() ?>"><img class="note_creator_avatar u-logo logo u-photo photo" src="<?= $this->social_igniter->profile_image($note->user_id, $note->image, $note->gravatar, 'medium'); ?>"></a>
  	<div class="note_creator_info">
  		<a href="<?= base_url() ?>"><h2 class="p-name fn"><?= $note->name ?></h2></a>
  	  <a class="u-url" href="<?= base_url() ?>"><?php $pretty_url = explode('://', base_url()); echo trim($pretty_url[1], '/'); ?></a>
  	</div>
  </div>
  
  <!-- Entry -->
  <div id="note" class="p-name entry-title p-summary summary e-content entry-content">
  	<?= item_linkify(nl2br($note->content), 'twitter'); ?><br>
		<a href="<?= base_url().'notes/'.$note->content_id ?>" class="u-url">
		<?php if ($note->parent_id): ?>Replied<?php else: ?>Posted<?php endif; ?> at
		<time class="dt-published published" datetime="<?= $note->created_at ?>"><?= format_datetime('MONTH_DAY_YEAR_ABBR', $note->created_at) ?></time> 
    </a>
    <?php if ($note->created_at != $note->updated_at): ?>
    <time class="dt-updated updated" datetime="<?= $note->updated_at ?>"><?= format_datetime('MONTH_DAY_YEAR_ABBR', $note->updated_at) ?></time>
    <?php endif; ?>
  </div>
  
  <div id="note_attachments">
  	<?php foreach ($note_extras as $extra): if ($extra->meta == 'attachment'): ?>
  		<div class="note_attachment"><?= nl2br(str_replace(array('&lt;', '&gt;'), array('<', '>'), $extra->value)) ?></div>
  	<?php endif; endforeach; ?>
  </div>

</article>