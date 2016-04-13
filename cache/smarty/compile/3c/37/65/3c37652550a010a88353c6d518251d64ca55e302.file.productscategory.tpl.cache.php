<?php /* Smarty version Smarty-3.1.19, created on 2015-09-09 04:13:28
         compiled from "/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/themes/pos_bstore1/modules/productscategory/productscategory.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16469813955ef72a0659231-34458254%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3c37652550a010a88353c6d518251d64ca55e302' => 
    array (
      0 => '/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/themes/pos_bstore1/modules/productscategory/productscategory.tpl',
      1 => 1434825134,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16469813955ef72a0659231-34458254',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'categoryProducts' => 0,
    'categoryProduct' => 0,
    'link' => 0,
    'ProdDisplayPrice' => 0,
    'restricted_country_mode' => 0,
    'PS_CATALOG_MODE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55ef72a06e25a7_81735560',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55ef72a06e25a7_81735560')) {function content_55ef72a06e25a7_81735560($_smarty_tpl) {?>
<?php if (count($_smarty_tpl->tpl_vars['categoryProducts']->value)>0&&$_smarty_tpl->tpl_vars['categoryProducts']->value!==false) {?>
<section class="blockproductscategory">
	<div class="title_block">
			<h3><?php echo smartyTranslate(array('s'=>'RELATED PRODUCTS','mod'=>'productscategory'),$_smarty_tpl);?>
</h3>
			<div class="navi">
				<a class="prevtab"><i class="icon-angle-left"></i></a>
				<a class="nexttab"><i class="icon-angle-right"></i></a>
			</div>
		</div>
	<div class="block_content">
		<div class="row">
			<div class="productscategorysld">
			<?php  $_smarty_tpl->tpl_vars['categoryProduct'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['categoryProduct']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['categoryProducts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['categoryProduct']->key => $_smarty_tpl->tpl_vars['categoryProduct']->value) {
$_smarty_tpl->tpl_vars['categoryProduct']->_loop = true;
?>
				<div class="item">
					<div class="home_tab_img">
						<a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['categoryProduct']->value['id_product'],$_smarty_tpl->tpl_vars['categoryProduct']->value['link_rewrite'],$_smarty_tpl->tpl_vars['categoryProduct']->value['category'],$_smarty_tpl->tpl_vars['categoryProduct']->value['ean13']);?>
" class="lnk_img product-image" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['categoryProduct']->value['name']);?>
">
							<img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['categoryProduct']->value['link_rewrite'],$_smarty_tpl->tpl_vars['categoryProduct']->value['id_image'],'home_default'), ENT_QUOTES, 'UTF-8', true);?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['categoryProduct']->value['name']);?>
" class="img-responsive"/>
						</a>
					</div>
					<div class="comment_box">
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayProductListReviews','product'=>$_smarty_tpl->tpl_vars['categoryProduct']->value),$_smarty_tpl);?>

					</div>
					<h5 itemprop="name" class="product-name">
						<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['categoryProduct']->value['id_product'],$_smarty_tpl->tpl_vars['categoryProduct']->value['link_rewrite'],$_smarty_tpl->tpl_vars['categoryProduct']->value['category'],$_smarty_tpl->tpl_vars['categoryProduct']->value['ean13']), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['categoryProduct']->value['name']);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['categoryProduct']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</a>
					</h5>
					<?php if ($_smarty_tpl->tpl_vars['ProdDisplayPrice']->value&&$_smarty_tpl->tpl_vars['categoryProduct']->value['show_price']==1&&!isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)&&!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?>
						<p class="price_display">
						<?php if (isset($_smarty_tpl->tpl_vars['categoryProduct']->value['specific_prices'])&&$_smarty_tpl->tpl_vars['categoryProduct']->value['specific_prices']&&(number_format($_smarty_tpl->tpl_vars['categoryProduct']->value['displayed_price'],2)!==number_format($_smarty_tpl->tpl_vars['categoryProduct']->value['price_without_reduction'],2))) {?>

							<span class="price special-price"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['categoryProduct']->value['displayed_price']),$_smarty_tpl);?>
</span>
							<span class="old-price"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPrice'][0][0]->displayWtPrice(array('p'=>$_smarty_tpl->tpl_vars['categoryProduct']->value['price_without_reduction']),$_smarty_tpl);?>
</span>

						<?php } else { ?>
							<span class="price"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['categoryProduct']->value['displayed_price']),$_smarty_tpl);?>
</span>
						<?php }?>
						</p>
					<?php } else { ?>
					<br />
					<?php }?>
				</div>
			<?php } ?>
			</div>
		</div>
	</div>
</section>
<?php }?><?php }} ?>
