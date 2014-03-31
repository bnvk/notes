<article class="h-as-note h-entry hentry note-single">
  <?php if ($note->parent_id): ?>  
  <!-- Indie Web Reply Contexts | http://indiewebcamp.com/reply-context -->
  <div id="note-reply" class="note-reply-context p-in-reply-to h-cite">
    <a href="<?= $response_site->url ?>" target="_blank"><img class="note_creator_avatar u-logo logo u-photo photo" src="<?= $this->social_igniter->profile_image($response_user->user_id, $response_user->image, $response_user->gravatar, 'medium'); ?>" alt=""></a>		
  	<div class="note_creator_info">    	
  	  <a class="p-publisher h-card" href="<?= $response_site->url ?>" target="_blank"><?= $response_user->name ?></a>
      <div class="p-summary p-name e-content">
    	<?= $response->content ?>
      </div>
  	  <a class="u-url" href="<?= $response->canonical ?>"><time class="dt-published published" datetime="<?= $note->created_at ?>"><?= format_datetime('MONTH_DAY_YEAR_ABBR', $note->created_at) ?></time></a>
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
  	<?= item_linkify(nl2br($note->content), 'twitter') ?><br>
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
  
  <div class="note_respond">
      <h4>Share &amp; Reply</h4>
      <?php if ($note_social): ?>
      <div class="note_respond syndication">
      	<ul>
      	<?php foreach($note_social as $social): ?>
      		<li><a href="<?= $this->notes_library->make_social_post_url($social); ?>" rel="syndication" class="u-syndication" target="_blank"><?= $social->title ?></a> </li>
      	<?php endforeach; ?>
      	</ul>
      	<div class="clear"></div>
      </div>
      <?php endif; ?>  
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

</article>

<script>
$(document).ready(function(){
    $(function(){
        $.getJSON("https://webmention.io/api/count?jsonp=?", {
            target: "<?= urlencode(base_url().'notes/'.$note->content_id) ?>"
        }, function(data){
            console.log(data.count);
        });
    });
});
</script>
