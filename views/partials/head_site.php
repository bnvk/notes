<link rel="webmention" href="http://webmention.io/brennannovak.com/webmention"/>
<link rel="alternate" type="application/rss+xml" title="<?= $site_title ?> RSS 2.0 Feed" href="<?= base_url('/feed/notes') ?>" />
<style type="text/css">
/* Notes */
#notes ul               { list-style: none; margin: 0px; padding: 0px; }
#notes li.note          { border-bottom: 2px solid #e6e6e6; margin: 25px 0px; padding: 0px 0px 25px 0px; }
#notes li:last-child    { border-bottom: 0px }
span.note_text          { display: block; margin: 0px 0px 10px 0px; font-size: 30px; line-height: 36px; }
span.note_details       { display: block; font-size: 14px; line-height: 14px; }

/* Note View */
#note-reply				      { background: #e3e3e3; padding: 20px 20px 20px 20px; margin-bottom: 40px; }
#note-reply h2	        { margin: 0px; padding: 0px; }


#note_creator           { width: 600px; height: 60px; margin: 0px 0px 25px 0px; }
#note_creator h2        { margin: 0px; padding: 0px; }
img.note_creator_avatar { width: 60px; float: left; }
div.note_creator_info   { float: left; width: 510px; margin: 0px 0px 0px 25px; }

/* Note */
#note                   { width: 80%; margin: 0px 0px 15px 0px; font-size: 36px; line-height: 48px; }
#note a.u-url,
#note .published,
#note .updated          { margin-top: 5px; color: #999; font-size: 14px; line-height: 14px; font-style: italic; font-weight: normal; }

#note_attachments       { width: 75%; margin: 35px 0 45px 0; }
#note_attachments a     { font-size: 36px; line-height: 48px; }
#note_attachments small { display: block; margin-top: 15px; }
#note_attachments small a { font-size: 14px; line-height: 21px; }
#note_attachments ol    { margin-left: 25px; list-style-position: inside; }
#note_attachments ol li { list-style-type: decimal; list-style-position: inside; }
#note_attachments p,
#note_attachments li,
#note_attachments li a,
#note_attachments p a  { font-size: 21px; line-height: 24px; }


div.note_attachment     { margin-bottom: 25px }

div.note_respond		{ margin: 15px 0px; }
div.note_respond h4		{ margin: 0px 0px 15px 0px; }
div.note_respond ul		{ list-style: none; margin: 0 !important; padding: 0; clear: both; }
div.note_respond ul li	{ float: left; margin: 0 25px 0 0; }
div.note_respond table	{ margin: 0px; }
</style>