<style type="text/css">
/* Dashboard - Notes */

#status_update				{ width: 645px; }
#status_update_text 		{ width: 615px; min-height: 45px; overflow: hidden; font-size: 14px; line-height: 18px; padding: 12px; }
#status_update_options		{ width: 400px; height: 50px; float: left; margin: 15px 0 0 0; }
#status_update_geo			{ width: 130px; float: left; }

#status_find_place			{ width: 24px; height: 24px; display: block; margin: 0; background: url(icons/places_gray_24.png) 0 0 no-repeat; position: relative; top: -6px; left: 0; } 
#status_find_place span		{ width: 110px; display: block; position: relative; top: 4px; left: 30px; }

#notes_extras						{ height: 18px; margin: 0 0 10px 0; color: #999999; font-style: italic; }
#notes_extras li					{ float: left; margin-right: 25px; }
#notes_extras a						{ color: #999999; }
#notes_extras a span.actions		{ position: relative; top: -2px; left: 0; }

#notes_add_attachment_textarea		{ width: 350px; height: 75px; margin-bottom: 25px; }
#notes_attachments					{ margin: 25px 0 0 10px; }
#notes_attachments li 				{ margin: 0 0 10px 0; color: #999999; font-style: italic; }


#feed								{ margin: 0; }
#feed li							{ float: left; }
#feed ul.item_actions				{ position: relative; bottom: 8px; right: 5px; }

li.item								{ width: 645px; margin: 0; padding: 0; background: url(<?= $dashboard_assets ?>images/item_separator.png) left bottom repeat-x; margin: 0 0 5px 0; }
li.item:hover ul.item_actions		{ visibility: visible; position: relative; bottom: 8px; right: 0px !important; }
li.item_new							{ width: 645px; margin: 0; padding: 0; background: url(<?= $dashboard_assets ?>images/item_separator.png) left bottom repeat-x; margin: 0 0 5px 0; }
li.item_new:hover ul.item_actions	{ visibility: visible; position: relative; bottom: 8px; right: 0px !important; }
li.item_created						{ background: #f2e3af; }
li.item_link						{ width: 100%; height: 2px; background: url(<?= $dashboard_assets ?>images/item_separator.png) left bottom repeat-x; margin: 0 0 5px 0; }

div.item_thumbnail 					{ width: 48px; height: 48px; display: block; position: relative; top: 7px; left: 0; margin: 0 20px 18px 15px; overflow: hidden; float: left; }
div.item_content 					{ width: 550px; display: block; line-height: 21px; margin: 2px 0 5px 0; position: relative; top: 2px; left: 0; float: left; }
div.item_content_small 				{ width: 400px; display: block; line-height: 21px; margin: 0 0 10px 0; position: relative; top: 8px; left: 0; float: left; }
span.item_separator					{ width: 100%; height: 2px; display: block; background: url(<?= $dashboard_assets ?>images/item_separator.png) 0 0 repeat-x; margin: 6px 0 15px 0; }
span.item_verb						{ color: #999999; }
span.item_content_body				{ width: 450px; float: left; }
span.item_content_body_small		{ width: 375px; float: left; word-wrap: break-word; word-break: inherit;  }
img.item_content_thumb				{ width: 125px; display: block; float: left; margin: 0 15px 0 0; }
span.item_content_detail			{ width: 350px; display: block; float: left; margin: 4px 0; color: #999999; font-size: 12px; line-height: 21px; }
span.item_content_detail_sm			{ width: 250px; display: block; float: left; margin: 4px 0; color: #999999; font-size: 12px; line-height: 21px; }
a.item_meta 						{ height: 12px; display: block; margin: 5px 0 0 0; font-size: 12px; line-height: 12px; color: #999999 !important; width: 150px; float: left; overflow: hidden; }
a.item_meta:hover					{ color: #2078CE !important; }
</style>