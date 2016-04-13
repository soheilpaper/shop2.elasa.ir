<?php /* Smarty version Smarty-3.1.19, created on 2015-09-08 23:26:21
         compiled from "/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/themes/pos_bstore1/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:76058012655ef2f553235e1-63346902%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0476f6285ee08f0b102d15bb7c0f1bcd079ea394' => 
    array (
      0 => '/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/themes/pos_bstore1/footer.tpl',
      1 => 1434709378,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '76058012655ef2f553235e1-63346902',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content_only' => 0,
    'right_column_size' => 0,
    'HOOK_RIGHT_COLUMN' => 0,
    'HOOK_FOOTER' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55ef2f55394197_76852326',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55ef2f55394197_76852326')) {function content_55ef2f55394197_76852326($_smarty_tpl) {?>
<?php if (!isset($_smarty_tpl->tpl_vars['content_only']->value)||!$_smarty_tpl->tpl_vars['content_only']->value) {?>
					</div><!-- #center_column -->
					<?php if (isset($_smarty_tpl->tpl_vars['right_column_size']->value)&&!empty($_smarty_tpl->tpl_vars['right_column_size']->value)) {?>
						<div id="right_column" class="col-xs-12 col-sm-<?php echo intval($_smarty_tpl->tpl_vars['right_column_size']->value);?>
 column"><?php echo $_smarty_tpl->tpl_vars['HOOK_RIGHT_COLUMN']->value;?>
</div>
					<?php }?>
					</div><!-- .row -->
				</div><!-- #columns -->
			</div><!-- .columns-container -->
			<div class="brandSlider">
				<div class="container">
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"brandSlider"),$_smarty_tpl);?>

				</div>
			</div>
			<div class="static_bottom_out">
				<div class="container">
					<div class="row">
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"blockPosition5"),$_smarty_tpl);?>

					</div>
				</div>
			</div>
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"blockFooterExtra"),$_smarty_tpl);?>

				<!-- Footer -->
			<div class="footer-container">
				<footer id="footer">
					<div class="container footer_center">
						<div class="row">
							<div class="col-xs-12 col-sm-3">
								<div class="footer_center1">
									<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"blockFooter1"),$_smarty_tpl);?>

								</div>
							</div>
							<div class="col-xs-12 col-sm-9">
								<div class="footer_center2">
									<div class="row">
									<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"blockFooter2"),$_smarty_tpl);?>

									</div>
								</div>
								<div class="footer_center3">
									<div class="row">
									<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"blockFooter3"),$_smarty_tpl);?>

									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="footer_bottom">
						<div class="container">
							<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"blockFooter4"),$_smarty_tpl);?>

							<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"blockFooter5"),$_smarty_tpl);?>

						</div>
					</div>
					<?php if (isset($_smarty_tpl->tpl_vars['HOOK_FOOTER']->value)) {?> <?php echo $_smarty_tpl->tpl_vars['HOOK_FOOTER']->value;?>
 <?php }?>
				</footer>
			</div><!-- #footer -->
		</div><!-- #page -->
<?php }?>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./global.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<div class="back-top"><a href= "#" class="back-top-button hidden-xs"></a></div>
	</body>
</html><?php }} ?>
