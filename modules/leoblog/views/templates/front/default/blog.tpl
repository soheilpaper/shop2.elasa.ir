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

{if isset($error)}
		<div id="blogpage">
			<div class="blog-detail">
				<div class="alert alert-warning">{l s='Sorry, We are updating data, please come back late!!!!' mod='leoblog'}</div>
			</div>
		</div>
	{else}	
	<div id="blogpage">
		<article class="blog-detail">
			{if $is_active}
			<h1 class="title">{$blog->meta_title}</h1>
			<div class="meta">
				{if $config->get('item_show_author','1')}
				<span class="author">
					<span class="fa fa-user"> {l s='Posted By' mod='leoblog'}: </span>
					<a href="{$blog->author_link|escape:'html':'UTF-8'}" title="{$blog->author}">{$blog->author}</a>
				</span>
				{/if}

				{if $config->get('item_show_category','1')}
				<span class="cat"> 
					<span class="fa fa-list"> {l s='In' mod='leoblog'}: </span> 
					<a href="{$blog->category_link|escape:'html':'UTF-8'}" title="{$blog->category_title|escape:'html':'UTF-8'}">{$blog->category_title}</a>
				</span>
				{/if}

				{if $config->get('item_show_created','1')}
				<span class="created">
					<span class="fa fa-calendar"> {l s='On' mod='leoblog'}: </span> 
					<time class="date" datetime="{strtotime($blog->date_add)|date_format:"%Y"}>
						{l s=strtotime($blog->date_add)|date_format:"%A" mod='leoblog'},	<!-- day of week -->
						{l s=strtotime($blog->date_add)|date_format:"%B" mod='leoblog'}		<!-- month-->
						{l s=strtotime($blog->date_add)|date_format:"%e" mod='leoblog'},	<!-- day of month -->
						{l s=strtotime($blog->date_add)|date_format:"%Y" mod='leoblog'}		<!-- year -->
					</time>
				</span>
				{/if}
				
				{if isset($blog_count_comment)&&$config->get('item_show_counter','1')}
				<span class="nbcomment">
					<span class="fa fa-comments-o"> {l s='Comment' mod='leoblog'}:</span> 
					{$blog_count_comment}
				</span>
				{/if}
				{if isset($blog->hits)&&$config->get('item_show_hit','1')}
				<span class="hits">
					<span class="fa fa-heart"> {l s='Hit' mod='leoblog'}:</span>
					{$blog->hits}
				</span>
				{/if}
			</div>

			{if $blog->preview_url && $config->get('item_show_image','1')}
				<div class="image">
					<img src="{$blog->preview_url}" title="{$blog->meta_title}" class="img-responsive" />
				</div>
			{/if}

			<div class="description">
				{if $config->get('item_show_description',1)}
					{$blog->description}
				{/if}
				{$blog->content}	
			</div>
			
			

			{if trim($blog->video_code)}
			<div class="video-code">
				<div class="inner ">
					{$blog->video_code}
				</div>
			</div>
			{/if}

			<div class="social">
				 {include file="{$module_tpl}_social.tpl"}
			</div>
			{if $tags}
			<div class="tags">
				<span>{l s='Tags:' mod='leoblog'}</span>
			 
				{foreach from=$tags item=tag name=tag}
					 <a href="{$tag.link|escape:'html':'UTF-8'}" title="{$tag.tag|escape:'html':'UTF-8'}"><span>{$tag.tag}</span></a> 	
				{/foreach}
				 
			</div>
			{/if}

			{if !empty($samecats)||!empty($tagrelated)}
			<div class="extra-blogs row">
			{if !empty($samecats)}
				<div class="col-lg-6 col-md-6 col-xs-12">
					<h4>{l s='In Same Category' mod='leoblog'}</h4>
					<ul>
					{foreach from=$samecats item=cblog name=cblog}
						<li><a href="{$cblog.link|escape:'html':'UTF-8'}">{$cblog.meta_title}</a></li>
					{/foreach}
					</ul>
				</div>
				<div class="col-lg-6 col-md-6 col-xs-12">
					<h4>{l s='Related by Tags' mod='leoblog'}</h4>
					<ul>
					{foreach from=$tagrelated item=cblog name=cblog}
						<li><a href="{$cblog.link|escape:'html':'UTF-8'}">{$cblog.meta_title}</a></li>
					{/foreach}
					</ul>
				</div>
			{/if}
			</div>
			{/if}

			{if $productrelated}

			{/if}
			<div class="comment">
			{if $config->get('item_comment_engine','local')=='facebook'}
				{include file="{$module_tpl}_facebook_comment.tpl"}
			{elseif $config->get('item_comment_engine','local')=='diquis'}
				{include file="{$module_tpl}_diquis_comment.tpl"}
			
			{else}
				{include file="{$module_tpl}_local_comment.tpl"}
			{/if}
			</div>	
			{else}
			<div class="alert alert-warning">{l s='Sorry, This blog is not avariable. May be this was unpublished or deleted.' mod='leoblog'}</div>
			{/if}

		</article>
	</div>
 	{/if}

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