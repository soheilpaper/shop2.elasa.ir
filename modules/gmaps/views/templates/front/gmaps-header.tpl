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
{if $psversion < "1.4.0.0"}
<script src='{$module_dir|escape}js/snowfall.jquery.js'></script>
{/if}

	<div class="block" id="block_maps">
		<p class="title_block">{l s='Our location' mod='gmaps'}</p>
        <div class="block_content">
		<iframe src="{$min|escape}" width="100%" height="{$nbr|escape}" frameborder="0" style="border:0" ></iframe>
        </div>
	</div>
