<?php /* Smarty version Smarty-3.1.19, created on 2015-09-08 23:26:21
         compiled from "/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/modules/posbestsellers/posbestsellers.tpl" */ ?>
<?php /*%%SmartyHeaderCode:177564823155ef2f550731f1-58910984%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8337e2d780720c3c02abb9b315c1155c9fb65fb4' => 
    array (
      0 => '/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/modules/posbestsellers/posbestsellers.tpl',
      1 => 1440863102,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '177564823155ef2f550731f1-58910984',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'best_sellers' => 0,
    'product' => 0,
    'link' => 0,
    'PS_CATALOG_MODE' => 0,
    'add_prod_display' => 0,
    'restricted_country_mode' => 0,
    'static_token' => 0,
    'priceDisplay' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55ef2f55230a99_03584189',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55ef2f55230a99_03584189')) {function content_55ef2f55230a99_03584189($_smarty_tpl) {?><?php if (count($_smarty_tpl->tpl_vars['best_sellers']->value)>0&&$_smarty_tpl->tpl_vars['best_sellers']->value!=null) {?>
	<div class="col-xs-12">
	<div class="pos_bestseller">
		<div class="title_block">
			<h3><?php echo smartyTranslate(array('s'=>'BESTSELLER','mod'=>'posbestsellers'),$_smarty_tpl);?>
</h3>
			<div class="navi">
				<a class="prevtab"><i class="icon-angle-left"></i></a>
				<a class="nexttab"><i class="icon-angle-right"></i></a>
			</div>
		</div>
		<div class="block_content">
		<div class="row">
			<div class="bestsellerSlide">
				<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['best_sellers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['product']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['product']->iteration=0;
 $_smarty_tpl->tpl_vars['product']->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['myLoop']['iteration']=0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['myLoop']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->_loop = true;
 $_smarty_tpl->tpl_vars['product']->iteration++;
 $_smarty_tpl->tpl_vars['product']->index++;
 $_smarty_tpl->tpl_vars['product']->first = $_smarty_tpl->tpl_vars['product']->index === 0;
 $_smarty_tpl->tpl_vars['product']->last = $_smarty_tpl->tpl_vars['product']->iteration === $_smarty_tpl->tpl_vars['product']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['myLoop']['first'] = $_smarty_tpl->tpl_vars['product']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['myLoop']['iteration']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['myLoop']['index']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['myLoop']['last'] = $_smarty_tpl->tpl_vars['product']->last;
?>
					<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['myLoop']['index']%1==0||$_smarty_tpl->getVariable('smarty')->value['foreach']['myLoop']['first']) {?>
						<div class="item_out">
					<?php }?>
						<div class="item">
							<div class="home_tab_img">
								<a class="product_img_link"	href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
" itemprop="url">
									<img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],'large_default'), ENT_QUOTES, 'UTF-8', true);?>
"
									alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['legend'], ENT_QUOTES, 'UTF-8', true);?>
"
									class="img-responsive"/>
								</a>
								<?php if (isset($_smarty_tpl->tpl_vars['product']->value['new'])&&$_smarty_tpl->tpl_vars['product']->value['new']==1) {?>
									<a class="new-box" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
">
										<span class="new-label"><?php echo smartyTranslate(array('s'=>'New','mod'=>'posbestsellers'),$_smarty_tpl);?>
</span>
									</a>
								<?php }?>
								<?php if (isset($_smarty_tpl->tpl_vars['product']->value['on_sale'])&&$_smarty_tpl->tpl_vars['product']->value['on_sale']&&isset($_smarty_tpl->tpl_vars['product']->value['show_price'])&&$_smarty_tpl->tpl_vars['product']->value['show_price']&&!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?>
									<a class="sale-box" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
">
										<span class="sale-label"><?php echo smartyTranslate(array('s'=>'Sale!','mod'=>'posbestsellers'),$_smarty_tpl);?>
</span>
									</a>
								<?php }?>
								<div class="btn_content">
										<a 	title="<?php echo smartyTranslate(array('s'=>'Quick view','mod'=>'posbestsellers'),$_smarty_tpl);?>
"
											class="quick-view"
											href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
"
											rel="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
">
											<i class="icon-search"></i>
										</a>
										<?php if (($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']==0||(isset($_smarty_tpl->tpl_vars['add_prod_display']->value)&&($_smarty_tpl->tpl_vars['add_prod_display']->value==1)))&&$_smarty_tpl->tpl_vars['product']->value['available_for_order']&&!isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)&&$_smarty_tpl->tpl_vars['product']->value['minimal_quantity']<=1&&$_smarty_tpl->tpl_vars['product']->value['customizable']!=2&&!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?>
											<?php if (($_smarty_tpl->tpl_vars['product']->value['allow_oosp']||$_smarty_tpl->tpl_vars['product']->value['quantity']>0)) {?>
												<?php if (isset($_smarty_tpl->tpl_vars['static_token']->value)) {?>
													<a class="exclusive ajax_add_to_cart_button btn btn-default" href="<?php ob_start();?><?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
<?php $_tmp13=ob_get_clean();?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('cart',false,null,"add=1&amp;id_product=".$_tmp13."&amp;token=".((string)$_smarty_tpl->tpl_vars['static_token']->value),false), ENT_QUOTES, 'UTF-8', true);?>
" rel="nofollow" title="<?php echo smartyTranslate(array('s'=>'Add to cart','mod'=>'posbestsellers'),$_smarty_tpl);?>
" data-id-product="<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
">
														<i class="icon-shopping-cart"></i>
													</a>
												<?php } else { ?>
													<a class="exclusive ajax_add_to_cart_button btn btn-default" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('cart',false,null,'add=1&amp;id_product={$product.id_product|intval}',false), ENT_QUOTES, 'UTF-8', true);?>
" rel="nofollow" title="<?php echo smartyTranslate(array('s'=>'Add to cart','mod'=>'posbestsellers'),$_smarty_tpl);?>
" data-id-product="<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
">
														<i class="icon-shopping-cart"></i>
													</a>
												<?php }?>
											<?php } else { ?>
												<span class="exclusive ajax_add_to_cart_button btn btn-default disabled">
													<i class="icon-shopping-cart"></i>
												</span>
											<?php }?>
										<?php }?>
										<a class="add_to_compare" 
											href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
" 
											title="<?php echo smartyTranslate(array('s'=>'Add to compare','mod'=>'posbestsellers'),$_smarty_tpl);?>
"
											data-id-product="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
">
											<i class="icon-retweet"></i>
										</a>
										<a 	title="<?php echo smartyTranslate(array('s'=>'Add to wishlist','mod'=>'posbestsellers'),$_smarty_tpl);?>
"
											class="addToWishlist wishlistProd_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
"
											href="#"
											onclick="WishlistCart('wishlist_block_list', 'add', '<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
', false, 1); return false;">
											<i class="icon-heart-o"></i>
										</a>
								</div>
							</div>
							<div class="home_tab_info">
								<div class="comment_box">
									<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayProductListReviews','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl);?>

								</div>
								<a class="product-name" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['product']->value['name'],50,'...'), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
									<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['product']->value['name'],35,'...'), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

								</a>
								<div class="price-box">
									<meta itemprop="priceCurrency" content="<?php echo $_smarty_tpl->tpl_vars['priceDisplay']->value;?>
" />
									<span class="price"><?php if (!$_smarty_tpl->tpl_vars['priceDisplay']->value) {?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['product']->value['price']),$_smarty_tpl);?>
<?php } else { ?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['product']->value['price_tax_exc']),$_smarty_tpl);?>
<?php }?></span>
									<?php if (isset($_smarty_tpl->tpl_vars['product']->value['specific_prices'])&&$_smarty_tpl->tpl_vars['product']->value['specific_prices']&&isset($_smarty_tpl->tpl_vars['product']->value['specific_prices']['reduction'])&&$_smarty_tpl->tpl_vars['product']->value['specific_prices']['reduction']>0) {?>
										<span class="old-price product-price">
											<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPrice'][0][0]->displayWtPrice(array('p'=>$_smarty_tpl->tpl_vars['product']->value['price_without_reduction']),$_smarty_tpl);?>

										</span>
									<?php }?>
								</div>
							</div>
						</div>
					<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['myLoop']['iteration']%1==0||$_smarty_tpl->getVariable('smarty')->value['foreach']['myLoop']['last']) {?>
						</div>
					<?php }?>
				<?php } ?>
			</div>
		</div>
		</div>
	</div>
	</div>
	<script>
		$(document).ready(function() {
			var bestsellerSlide = $(".bestsellerSlide");
			bestsellerSlide.owlCarousel({
				items : 5,
				itemsDesktop : [1199,4],
				itemsDesktopSmall : [991,3],
				itemsTablet: [767,2],
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
<?php }?><?php }} ?>
