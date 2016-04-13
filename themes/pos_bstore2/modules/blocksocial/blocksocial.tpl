{*
* 2007-2015 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2015 PrestaShop SA

*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<section id="social_block">
	<h3>{l s='Follow us' mod='blocksocial'}</h3>
		{if isset($facebook_url) && $facebook_url != ''}
				<a class="_blank" href="{$facebook_url|escape:html:'UTF-8'}">
					<i class="icon-facebook"></i>
				</a>
		{/if}
		{if isset($twitter_url) && $twitter_url != ''}
				<a class="_blank" href="{$twitter_url|escape:html:'UTF-8'}">
					<i class="icon-twitter"></i>
				</a>
		{/if}
		{if isset($rss_url) && $rss_url != ''}
				<a class="_blank" href="{$rss_url|escape:html:'UTF-8'}">
					<i class="icon-rss"></i>
				</a>
		{/if}
        {if isset($youtube_url) && $youtube_url != ''}
        		<a class="_blank" href="{$youtube_url|escape:html:'UTF-8'}">
        			<i class="icon-youtube"></i>
        		</a>
        {/if}
        {if isset($google_plus_url) && $google_plus_url != ''}
        		<a class="_blank" href="{$google_plus_url|escape:html:'UTF-8'}">
        			<i class="icon-google-plus"></i>
        		</a>
        {/if}
        {if isset($pinterest_url) && $pinterest_url != ''}
        		<a class="_blank" href="{$pinterest_url|escape:html:'UTF-8'}">
        			<i class="icon-pinterest"></i>
        		</a>
        {/if}
        {if isset($vimeo_url) && $vimeo_url != ''}
        		<a class="_blank" href="{$vimeo_url|escape:html:'UTF-8'}">
        			<i class="icon-vimeo"></i>
        		</a>
        {/if}
        {if isset($instagram_url) && $instagram_url != ''}
        		<a class="_blank" href="{$instagram_url|escape:html:'UTF-8'}">
        			<i class="icon-instagram"></i>
        		</a>
        {/if}
</section>
<div class="clearfix"></div>
