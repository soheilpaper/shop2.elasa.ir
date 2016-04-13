<?php /* Smarty version Smarty-3.1.19, created on 2015-09-08 23:26:20
         compiled from "/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/modules/postabcateslider/postabcateslider.tpl" */ ?>
<?php /*%%SmartyHeaderCode:82717889855ef2f54c83960-18335783%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a426bdd31da10ccc22cd82822d9175a728a18753' => 
    array (
      0 => '/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/modules/postabcateslider/postabcateslider.tpl',
      1 => 1440888566,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '82717889855ef2f54c83960-18335783',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'productCates' => 0,
    'counts' => 0,
    'productCate' => 0,
    'product' => 0,
    'link' => 0,
    'PS_CATALOG_MODE' => 0,
    'add_prod_display' => 0,
    'restricted_country_mode' => 0,
    'static_token' => 0,
    'priceDisplay' => 0,
    'count' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55ef2f54e4fcd6_00220466',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55ef2f54e4fcd6_00220466')) {function content_55ef2f54e4fcd6_00220466($_smarty_tpl) {?><div class="col-xs-12">
<div class="postabcateslider">
	<div class="tab_container"> 
		
			<?php $_smarty_tpl->tpl_vars['counts'] = new Smarty_variable(0, null, 0);?>
			<?php  $_smarty_tpl->tpl_vars['productCate'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['productCate']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['productCates']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['productCate']->key => $_smarty_tpl->tpl_vars['productCate']->value) {
$_smarty_tpl->tpl_vars['productCate']->_loop = true;
?>
				<div id="tab3_<?php echo $_smarty_tpl->tpl_vars['counts']->value;?>
" class="tab_content">
					<div class="navi">
					<a class="prevtab"><i class="icon-angle-left"></i></a>
					<a class="nexttab"><i class="icon-angle-right"></i></a>
					</div>
					<div class="row">
					<div id="tab3_<?php echo $_smarty_tpl->tpl_vars['counts']->value;?>
_in" class="tabSlide">
						<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['productCate']->value['product']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->_loop = true;
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
												<span class="new-label"><?php echo smartyTranslate(array('s'=>'New','mod'=>'postabcateslider'),$_smarty_tpl);?>
</span>
											</a>
										<?php }?>
										<?php if (isset($_smarty_tpl->tpl_vars['product']->value['on_sale'])&&$_smarty_tpl->tpl_vars['product']->value['on_sale']&&isset($_smarty_tpl->tpl_vars['product']->value['show_price'])&&$_smarty_tpl->tpl_vars['product']->value['show_price']&&!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?>
											<a class="sale-box" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
">
												<span class="sale-label"><?php echo smartyTranslate(array('s'=>'Sale!','mod'=>'postabcateslider'),$_smarty_tpl);?>
</span>
											</a>
										<?php }?>
										<div class="btn_content">
												<a 	title="<?php echo smartyTranslate(array('s'=>'Quick view','mod'=>'postabcateslider'),$_smarty_tpl);?>
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
<?php $_tmp11=ob_get_clean();?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('cart',false,null,"add=1&amp;id_product=".$_tmp11."&amp;token=".((string)$_smarty_tpl->tpl_vars['static_token']->value),false), ENT_QUOTES, 'UTF-8', true);?>
" rel="nofollow" title="<?php echo smartyTranslate(array('s'=>'Add to cart','mod'=>'postabcateslider'),$_smarty_tpl);?>
" data-id-product="<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
">
															<a class="exclusive ajax_add_to_cart_button btn btn-default" href="<?php ob_start();?><?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
<?php $_tmp12=ob_get_clean();?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('cart',false,null,"add=1&amp;id_product=".$_tmp12."&amp;token=".((string)$_smarty_tpl->tpl_vars['static_token']->value),false), ENT_QUOTES, 'UTF-8', true);?>
" rel="nofollow" title="<?php echo smartyTranslate(array('s'=>'Add to cart','mod'=>'postabcateslider'),$_smarty_tpl);?>
" data-id-product="<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
">
																<i class="icon-shopping-cart"></i>
															</a>
														<?php } else { ?>
															<a class="exclusive ajax_add_to_cart_button btn btn-default" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('cart',false,null,'add=1&amp;id_product={$product.id_product|intval}',false), ENT_QUOTES, 'UTF-8', true);?>
" rel="nofollow" title="<?php echo smartyTranslate(array('s'=>'Add to cart','mod'=>'postabcateslider'),$_smarty_tpl);?>
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
													title="<?php echo smartyTranslate(array('s'=>'Add to compare','mod'=>'postabcateslider'),$_smarty_tpl);?>
"
													data-id-product="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
">
													<i class="icon-retweet"></i>
												</a>
												<a 	title="<?php echo smartyTranslate(array('s'=>'Add to wishlist','mod'=>'postabcateslider'),$_smarty_tpl);?>
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
				<script type="text/javascript">
					$(document).ready(function() {
						var postabcateslider = $("#tab3_<?php echo $_smarty_tpl->tpl_vars['counts']->value;?>
_in");
						postabcateslider.owlCarousel({
							items : 4,
							itemsDesktop : [1199,4],
							itemsDesktopSmall : [991,3], 
							itemsTablet: [767,2], 
							itemsMobile : [480,1],
							autoPlay :  false,
							stopOnHover: false,
						});
						$(".postabcateslider #tab3_<?php echo $_smarty_tpl->tpl_vars['counts']->value;?>
 .nexttab").click(function(){
							postabcateslider.trigger('owl.next');})
						$(".postabcateslider #tab3_<?php echo $_smarty_tpl->tpl_vars['counts']->value;?>
 .prevtab").click(function(){
							postabcateslider.trigger('owl.prev');})
					});
				</script>
				<?php $_smarty_tpl->tpl_vars['counts'] = new Smarty_variable($_smarty_tpl->tpl_vars['counts']->value+1, null, 0);?>
			<?php } ?>
	</div>
	<div class="title_block">
		<h2 class="hidden"><?php echo smartyTranslate(array('s'=>'In other categories','mod'=>'postabcateslider'),$_smarty_tpl);?>
</h2>
		<ul class="tabs3"> 
			<?php $_smarty_tpl->tpl_vars['count'] = new Smarty_variable(0, null, 0);?>
			<?php  $_smarty_tpl->tpl_vars['productCate'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['productCate']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['productCates']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['productCate']->key => $_smarty_tpl->tpl_vars['productCate']->value) {
$_smarty_tpl->tpl_vars['productCate']->_loop = true;
?>
				<li class="<?php if ($_smarty_tpl->tpl_vars['count']->value==0) {?> active <?php }?>" rel="tab3_<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
">
					<?php echo $_smarty_tpl->tpl_vars['productCate']->value['name'];?>

				</li>
			<?php $_smarty_tpl->tpl_vars['count'] = new Smarty_variable($_smarty_tpl->tpl_vars['count']->value+1, null, 0);?>
			<?php } ?>	
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
</script><?php }} ?>
