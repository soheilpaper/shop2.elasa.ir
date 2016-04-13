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

<article class="blog-item">
	{if $config->get('listing_show_title','1')}
	<h4 class="title"><a href="{$blog.link|escape:'html':'UTF-8'}" title="{$blog.title}">{$blog.title}</a></h4>
	{/if}
	<div class="meta">
		{if $config->get('listing_show_author','1')&&!empty($blog.author)}
		<span class="author">
			<span class="fa fa-user"> {l s='Posted By' mod='leoblog'}:</span> 
			<a href="{$blog.author_link|escape:'html':'UTF-8'}" title="{$blog.author}">{$blog.author}</a> 
		</span>
		{/if}
		
		{if $config->get('listing_show_category','1')}
		<span class="cat"> 
			<span class="fa fa-list"> {l s='In' mod='leoblog'}:</span> 
			<a href="{$blog.category_link|escape:'html':'UTF-8'}" title="{$blog.category_title|escape:'html':'UTF-8'}">{$blog.category_title}</a>
		</span>
		{/if}
		
		{if $config->get('listing_show_created','1')}
		<span class="created">
			<span class="fa fa-calendar"> {l s='On' mod='leoblog'}: </span> 
			<time class="date" datetime="{strtotime($blog.date_add)|date_format:"%Y"}>
				{l s=strtotime($blog.date_add)|date_format:"%A" mod='leoblog'},	<!-- day of week -->
				{l s=strtotime($blog.date_add)|date_format:"%B" mod='leoblog'}		<!-- month-->
				{l s=strtotime($blog.date_add)|date_format:"%e" mod='leoblog'},	<!-- day of month -->
				{l s=strtotime($blog.date_add)|date_format:"%Y" mod='leoblog'}		<!-- year -->
			</time>
		</span>
		{/if}
		
		{if isset($blog.comment_count)&&$config->get('listing_show_counter','1')}	
		<span class="nbcomment">
			<span class="fa fa-comments-o"> {l s='Comment' mod='leoblog'}:</span> 
			{$blog.comment_count}
		</span>
		{/if}

		{if $config->get('listing_show_hit','1')}	
		<span class="hits">
			<span class="fa fa-heart"> {l s='Hit' mod='leoblog'}:</span> 
			{$blog.hits}
		</span>
		{/if}
	</div>
	{if $blog.image && $config->get('listing_show_image',1)}
	<div class="image">
		<img src="{$blog.preview_url}" title="{$blog.title}" class="img-responsive" />
	</div>
	{/if}

	<div class="shortinfo">
		{if $config->get('listing_show_description','1')}
		{$blog.description|strip_tags:'UTF-8'|truncate:160:'...'}
		{/if}
		{if $config->get('listing_show_readmore',1)}
		<p>
			<a href="{$blog.link}" title="{$blog.title|escape:'html':'UTF-8'}" class="more btn btn-default">{l s='Read more' mod='leoblog'}</a>
		</p>
		{/if}
	</div>
</article>
	
<!---
	Translation Day of Week - NOT REMOVE
	{l s='Sunday' mod='leoblog'}
	{l s='Monday' mod='leoblog'}
	{l s='Tuesday' mod='leoblog'}
	{l s='Wednesday' mod='leoblog'}
	{l s='Thursday' mod='leoblog'}
	{l s='Friday' mod='leoblog'}
	{l s='Saturday' mod='leoblog'}
-->
<!---
	Translation Month - NOT REMOVE
		{l s='January' mod='leoblog'}
		{l s='February' mod='leoblog'}
		{l s='March' mod='leoblog'}
		{l s='April' mod='leoblog'}
		{l s='May' mod='leoblog'}
		{l s='June' mod='leoblog'}
		{l s='July' mod='leoblog'}
		{l s='August' mod='leoblog'}
		{l s='September' mod='leoblog'}
		{l s='October' mod='leoblog'}
		{l s='November' mod='leoblog'}
		{l s='December' mod='leoblog'}
-->