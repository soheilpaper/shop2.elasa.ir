<?php /* Smarty version Smarty-3.1.19, created on 2015-09-08 23:26:21
         compiled from "/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/modules/poslogo/logo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1168695555ef2f553a4826-34616723%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '19755bd98013ca0d3920a44b102088e38e686533' => 
    array (
      0 => '/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/modules/poslogo/logo.tpl',
      1 => 1434478488,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1168695555ef2f553a4826-34616723',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'logos' => 0,
    'logo' => 0,
    'slideOptions' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55ef2f55415f10_59713112',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55ef2f55415f10_59713112')) {function content_55ef2f55415f10_59713112($_smarty_tpl) {?><div class="pos-logo">
	<div class="title_block">
		<h3><?php echo smartyTranslate(array('s'=>'BRAND & CLIENTS','mod'=>'poslogo'),$_smarty_tpl);?>
</h3>
		<div class="navi">
			<a class="prevtab"><i class="icon-angle-left"></i></a>
			<a class="nexttab"><i class="icon-angle-right"></i></a>
		</div>
	</div>
	<div class="pos-content-logo">
		<div class="row">
		<div class="pos-logo-slide">
			<?php  $_smarty_tpl->tpl_vars['logo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['logo']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['logos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['logo']->key => $_smarty_tpl->tpl_vars['logo']->value) {
$_smarty_tpl->tpl_vars['logo']->_loop = true;
?>
				<div class="item">
				    <a href ="<?php echo $_smarty_tpl->tpl_vars['logo']->value['link'];?>
">
						<img class="img-responsive" src ="<?php echo $_smarty_tpl->tpl_vars['logo']->value['image'];?>
" alt ="<?php echo smartyTranslate(array('s'=>'Logo','mod'=>'poslogo'),$_smarty_tpl);?>
" />
				    </a>
				</div>
			<?php } ?>
		</div>
		</div>
	</div>
</div>
<script type="text/javascript"> 
    $(document).ready(function() {
		var logo = $(".pos-logo-slide");
		logo.owlCarousel({
		items :<?php echo $_smarty_tpl->tpl_vars['slideOptions']->value['min_item'];?>
,
		itemsDesktop : [1024,4],
		itemsDesktopSmall : [900,3], 
		itemsTablet: [600,2], 
		itemsMobile : [480,1]
		});
		 
		// Custom Navigation Events
		$(".pos-logo .nexttab").click(function(){
		logo.trigger('owl.next');
		})
		$(".pos-logo .prevtab").click(function(){
		logo.trigger('owl.prev');
		})     
    });
</script><?php }} ?>
