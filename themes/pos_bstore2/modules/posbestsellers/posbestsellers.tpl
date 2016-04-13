{if count($best_sellers) > 0 && $best_sellers != null}
	<div class="pos_bestseller">
		<div class="title_block">
			<h3>{l s='BESTSELLER' mod='posbestsellers'}</h3>
			<div class="navi">
				<a class="prevtab"><i class="icon-angle-left"></i></a>
				<a class="nexttab"><i class="icon-angle-right"></i></a>
			</div>
		</div>
		<div class="block_content">
		<div class="row">
			<div class="bestsellerSlide">
				{foreach from=$best_sellers item=product name=myLoop}
					{if $smarty.foreach.myLoop.index % 5 == 0 || $smarty.foreach.myLoop.first }
						<div class="item_out">
					{/if}
						<div class="item">
							<div class="home_tab_img pull-left">
								<a class="product_img_link"	href="{$product.link|escape:'html':'UTF-8'}" title="{$product.name|escape:'html':'UTF-8'}" itemprop="url">
									<img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'cart_default')|escape:'html'}"
									alt="{$product.legend|escape:'html':'UTF-8'}"
									class="img-responsive"/>
								</a>
							</div>
							<div class="home_tab_info">
								<a class="product-name" href="{$product.link|escape:'html'}" title="{$product.name|truncate:50:'...'|escape:'htmlall':'UTF-8'}">
									{$product.name|truncate:35:'...'|escape:'htmlall':'UTF-8'}
								</a>
								<div class="comment_box">
									{hook h='displayProductListReviews' product=$product}
								</div>
								<div class="price-box">
									<meta itemprop="priceCurrency" content="{$priceDisplay}" />
									<span class="price">{if !$priceDisplay}{convertPrice price=$product.price}{else}{convertPrice price=$product.price_tax_exc}{/if}</span>
									{if isset($product.specific_prices) && $product.specific_prices && isset($product.specific_prices.reduction) && $product.specific_prices.reduction > 0}
										<span class="old-price product-price">
											{displayWtPrice p=$product.price_without_reduction}
										</span>
									{/if}
								</div>
							</div>
						</div>
					{if $smarty.foreach.myLoop.iteration % 5 == 0 || $smarty.foreach.myLoop.last}
						</div>
					{/if}
				{/foreach}
			</div>
		</div>
		</div>
	</div>
	<script>
		$(document).ready(function() {
			var bestsellerSlide = $(".bestsellerSlide");
			bestsellerSlide.owlCarousel({
				items : 1,
				itemsDesktop : [1199,1],
				itemsDesktopSmall : [991,1],
				itemsTablet: [767,1],
				itemsMobile : [480,1],
				autoPlay :  false,
				stopOnHover: false,
			});

			// Custom Navigation Events
			$(".pos_bestseller .nexttab").click(function(){
				bestsellerSlide.trigger('owl.next');})
			$(".pos_bestseller .prevtab").click(function(){
				bestsellerSlide.trigger('owl.prev');})
		});
	</script>
{/if}