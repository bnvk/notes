<?php
/**
 * Notes Helper
 *
 * @package		Notes Helper
 * @subpackage	Helper
 * @author		Social Igniter
 * @link		contact@social-igniter.com
 *
 * Description: This is a helper file for Notes
 */
 
function find_image_in_note($note, $attachments, $default='')
{
	preg_match('#\b((?:http|https)://\S+\.(?:jpe?g|png|gif))\b#i', $note, $note_matches);

	// If Image in Note
	if (isset($note_matches[0])):
		return $note_matches[0]. ' ---- IN NOTE';
	endif;

	// Check Attachments
	if ($attachments):
		foreach ($attachments as $attachment):
			preg_match('#\b((?:http|https)://\S+\.(?:jpe?g|png|gif))\b#i', $attachment->value, $attachment_matches);
			if (isset($attachment_matches[0])):
				return $attachment_matches[0]; 
			endif;
		endforeach;
	endif;

	return $default;
}