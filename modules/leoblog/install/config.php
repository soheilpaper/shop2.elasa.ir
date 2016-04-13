<?php
/**
 *  Leo Prestashop Blockleoblogs for Prestashop 1.6.x
 *
 * @package   blockleoblogs
 * @version   3.0
 * @author    http://www.leotheme.com
 * @copyright Copyright (C) October 2013 LeoThemes.com <@emai:leotheme@gmail.com>
 *               <info@leotheme.com>.All rights reserved.
 * @license   GNU General Public License version 2
 */

$blogConfig = array(
	'template' => 'default',
	'blog_link_title_1' => 'Blog',
	'blog_link_title_3' => 'Blog',
	'link_rewrite' => 'blog',
	'meta_title_1' => 'Blog',
	'meta_title_3' => 'Blog',
	'meta_description_1' => '',
	'meta_description_3' => '',
	'meta_keywords_1' => '',
	'meta_keywords_3' => '',
	'indexation' => 0,
	'rss_limit_item' => 5,
	'rss_title_item' => 'RSS FEED',
	#'latest_limit_items' => 20,
	'saveConfiguration' => '',
	'listing_show_categoryinfo' => 1,
	'listing_show_subcategories' => 1,
	'listing_leading_column' => 1,
	'listing_leading_limit_items' => 2,
	'listing_leading_img_width' => 690,
	'listing_leading_img_height' => 300,
	'listing_secondary_column' => 3,
	'listing_secondary_limit_items' => 6,
	'listing_secondary_img_width' => 390,
	'listing_secondary_img_height' => 220,
	'listing_show_title' => 1,
	'listing_show_description' => 1,
	'listing_show_readmore' => 1,
	'listing_show_image' => 1,
	'listing_show_author' => 1,
	'listing_show_category' => 1,
	'listing_show_created' => 1,
	'listing_show_hit' => 1,
	'listing_show_counter' => 1,
	'item_img_width' => 690,
	'item_img_height' => 350,
	'item_show_description' => 1,
	'item_show_image' => 0,
	'item_show_author' => 1,
	'item_show_category' => 1,
	'item_show_created' => 1,
	'item_show_hit' => 1,
	'item_show_counter' => 1,
	'social_code' => '',
	'item_comment_engine' => 'local',
	'item_limit_comments' => '10',
	'item_diquis_account' => 'demo4leotheme',
	'item_facebook_appid' => '100858303516',
	'item_facebook_width' => '600'
);

LeoBlogConfig::updateConfigValue('cfg_global', serialize($blogConfig));
?>