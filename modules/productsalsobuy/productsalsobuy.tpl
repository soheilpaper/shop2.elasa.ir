<div id="products_also_buy" class="clear">
<ul class="idTabs">
	<li><a href="#idTab4">{l s='Others bought'}</a></li>
</ul>

<div id="{if count($categoryProducts) > 5}productscategory{else}productscategory_noscroll{/if}">
<div id="productscategory_list">
	<ul>
		{foreach from=$product item='product' name=product}
		{assign var='productLink' value=$link->getProductLink($product.id_product, $product.link_rewrite)}
		<li>
			<a href="{$link->getProductLink($product.id_product, $product.link_rewrite, $product.category)}" title="{$product.name|htmlspecialchars}">
				<img src="{$img_prod_dir}{$product.id_product}-{$product.id_image}-medium.jpg" alt="{$product.name|htmlspecialchars}" />
			</a><br />
			<a href="{$link->getProductLink($product.id_product, $product.link_rewrite, $product.category)}" title="{$product.name|htmlspecialchars}">
			{$product.name|truncate:15:'...'|escape:'htmlall':'UTF-8'}
			</a>
		</li>
		{/foreach}
	</ul>
</div>
</div>
</div>
