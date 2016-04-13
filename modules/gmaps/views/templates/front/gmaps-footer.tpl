{*
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* No redistribute in other sites, or copy.
*
*  @author RSI 
*  @copyright  2007-2014 RSI
*}

{if $psversion > "1.6.0.0"}
	<section class="footer-block col-xs-12 {$max}" id="block_maps">
		<h4>{l s='Our location' mod='gmaps'}</h4>
		<iframe src="{$min|escape}" width="100%" height="{$nbr|escape}" frameborder="0" style="border:0" ></iframe>
	</section>
    {else}
    <section class="footer-block col-xs-12 {$max}" id="block_maps_c" width="{$max}">
		<h4>{l s='Our location' mod='gmaps'}</h4>
		<iframe src="{$min}" width="{$max|escape}" height="{$nbr|escape}" frameborder="0" style="border:0" ></iframe>
	</section>
    {/if}