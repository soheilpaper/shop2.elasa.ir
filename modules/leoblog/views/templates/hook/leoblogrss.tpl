{*
 *  Leo Prestashop SliderShow for Prestashop 1.6.x
 *
 * @package   leosliderlayer
 * @version   3.0
 * @author    http://www.leotheme.com
 * @copyright Copyright (C) October 2013 LeoThemes.com <@emai:leotheme@gmail.com>
 *               <info@leotheme.com>.All rights reserved.
 * @license   GNU General Public License version 2
*}

<!-- Block RSS module-->
<div id="rss_block_left" class="block">
	<h4 class="title_block">{$title}</h4>
	<div class="block_content">
		{if $rss_links}
			<ul>
				{foreach from=$rss_links item='rss_link'}
					<li><a href="{$rss_link.url}" title="{$rss_link.title}">{$rss_link.title}</a></li>
				{/foreach}
			</ul>
		{else}
			<p>{l s='No RSS feed added' mod='leoblog'}</p>
		{/if}
	</div>
</div>
<!-- /Block RSS module-->
