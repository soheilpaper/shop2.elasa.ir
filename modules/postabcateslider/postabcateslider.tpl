<div class="col-xs-12">
<div class="postabcateslider">
	<div class="tab_container"> 
		
			{$counts = 0}
			{foreach from=$productCates item=productCate name=postabcateslider}
				<div id="tab3_{$counts}" class="tab_content">
					<div class="navi">
					<a class="prevtab"><i class="icon-angle-left"></i></a>
					<a class="nexttab"><i class="icon-angle-right"></i></a>
					</div>
					<div class="row">
					<div id="tab3_{$counts}_in" class="tabSlide">
						{foreach from=$productCate.product item=product name=postabcateslider}
							{if $smarty.foreach.myLoop.index % 1 == 0 || $smarty.foreach.myLoop.first }
								<div class="item_out">
							{/if}
								<div class="item">
									<div class="home_tab_img">
										<a class="product_img_link"	href="{$product.link|escape:'html':'UTF-8'}" title="{$product.name|escape:'html':'UTF-8'}" itemprop="url">
											<img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'large_default')|escape:'html'}"
											alt="{$product.legend|escape:'html':'UTF-8'}"
											class="img-responsive"/>
										</a>
										{if isset($product.new) && $product.new == 1}
											<a class="new-box" href="{$product.link|escape:'html':'UTF-8'}">
												<span class="new-label">{l s='New' mod='postabcateslider'}</span>
											</a>
										{/if}
										{if isset($product.on_sale) && $product.on_sale && isset($product.show_price) && $product.show_price && !$PS_CATALOG_MODE}
											<a class="sale-box" href="{$product.link|escape:'html':'UTF-8'}">
												<span class="sale-label">{l s='Sale!' mod='postabcateslider'}</span>
											</a>
										{/if}
										<div class="btn_content">
												<a 	title="{l s='Quick view' mod='postabcateslider'}"
													class="quick-view"
													href="{$product.link|escape:'html':'UTF-8'}"
													rel="{$product.link|escape:'html':'UTF-8'}">
													<i class="icon-search"></i>
												</a>
												{if ($product.id_product_attribute == 0 || (isset($add_prod_display) && ($add_prod_display == 1))) && $product.available_for_order && !isset($restricted_country_mode) && $product.minimal_quantity <= 1 && $product.customizable != 2 && !$PS_CATALOG_MODE}
													{if ($product.allow_oosp || $product.quantity > 0)}
														{if isset($static_token)}
															<a class="exclusive ajax_add_to_cart_button btn btn-default" href="{$link->getPageLink('cart',false, NULL, "add=1&amp;id_product={$product.id_product|intval}&amp;token={$static_token}", false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart' mod='postabcateslider'}" data-id-product="{$product.id_product|intval}">
															<a class="exclusive ajax_add_to_cart_button btn btn-default" href="{$link->getPageLink('cart',false, NULL, "add=1&amp;id_product={$product.id_product|intval}&amp;token={$static_token}", false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart' mod='postabcateslider'}" data-id-product="{$product.id_product|intval}">
																<i class="icon-shopping-cart"></i>
															</a>
														{else}
															<a class="exclusive ajax_add_to_cart_button btn btn-default" href="{$link->getPageLink('cart',false, NULL, 'add=1&amp;id_product={$product.id_product|intval}', false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart' mod='postabcateslider'}" data-id-product="{$product.id_product|intval}">
																<i class="icon-shopping-cart"></i>
															</a>
														{/if}
													{else}
														<span class="exclusive ajax_add_to_cart_button btn btn-default disabled">
															<i class="icon-shopping-cart"></i>
														</span>
													{/if}
												{/if}
												<a class="add_to_compare" 
													href="{$product.link|escape:'html':'UTF-8'}" 
													title="{l s='Add to compare' mod='postabcateslider'}"
													data-id-product="{$product.id_product}">
													<i class="icon-retweet"></i>
												</a>
												<a 	title="{l s='Add to wishlist' mod='postabcateslider'}"
													class="addToWishlist wishlistProd_{$product.id_product|intval}"
													href="#"
													onclick="WishlistCart('wishlist_block_list', 'add', '{$product.id_product|intval}', false, 1); return false;">
													<i class="icon-heart-o"></i>
												</a>
										</div>
									</div>
									<div class="home_tab_info">
										<div class="comment_box">
											{hook h='displayProductListReviews' product=$product}
										</div>
										<a class="product-name" href="{$product.link|escape:'html'}" title="{$product.name|truncate:50:'...'|escape:'htmlall':'UTF-8'}">
											{$product.name|truncate:35:'...'|escape:'htmlall':'UTF-8'}
										</a>
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
							{if $smarty.foreach.myLoop.iteration % 1 == 0 || $smarty.foreach.myLoop.last}
								</div>
							{/if}
						{/foreach}
					</div>
					</div>
				</div>
				<script type="text/javascript">
					$(document).ready(function() {
						var postabcateslider = $("#tab3_{$counts}_in");
						postabcateslider.owlCarousel({
							items : 4,
							itemsDesktop : [1199,4],
							itemsDesktopSmall : [991,3], 
							itemsTablet: [767,2], 
							itemsMobile : [480,1],
							autoPlay :  false,
							stopOnHover: false,
						});
						$(".postabcateslider #tab3_{$counts} .nexttab").click(function(){
							postabcateslider.trigger('owl.next');})
						$(".postabcateslider #tab3_{$counts} .prevtab").click(function(){
							postabcateslider.trigger('owl.prev');})
					});
				</script>
				{$counts = $counts+1}
			{/foreach}
	</div>
	<div class="title_block">
		<h2 class="hidden">{l s='In other categories' mod='postabcateslider'}</h2>
		<ul class="tabs3"> 
			{$count=0}
			{foreach from=$productCates item=productCate name=postabcateslider}
				<li class="{if $count==0} active {/if}" rel="tab3_{$count}">
					{$productCate.name}
				</li>
			{$count= $count+1}
			{/foreach}	
		</ul>
	</div>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$(".tab_content").hide();
		$(".tab_content:first").show(); 
		$("ul.tabs3 li").click(function() {
			$("ul.tabs3 li").removeClass("active");
			$(this).addClass("active");
			$(".tab_content").hide();
			var activeTab = $(this).attr("rel"); 
			$("#"+activeTab).fadeIn(); 
		});
	});
</script>