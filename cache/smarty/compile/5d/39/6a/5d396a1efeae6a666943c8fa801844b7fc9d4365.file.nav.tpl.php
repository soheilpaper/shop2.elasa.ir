<?php /* Smarty version Smarty-3.1.19, created on 2015-09-08 23:26:19
         compiled from "/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/themes/pos_bstore1/modules/blockuserinfo/nav.tpl" */ ?>
<?php /*%%SmartyHeaderCode:26108357155ef2f53e0fa40-74827940%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5d396a1efeae6a666943c8fa801844b7fc9d4365' => 
    array (
      0 => '/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/themes/pos_bstore1/modules/blockuserinfo/nav.tpl',
      1 => 1440861140,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26108357155ef2f53e0fa40-74827940',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'is_logged' => 0,
    'cookie' => 0,
    'link' => 0,
    'order_process' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55ef2f53ebb1d3_74581473',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55ef2f53ebb1d3_74581473')) {function content_55ef2f53ebb1d3_74581473($_smarty_tpl) {?><!-- Block user information module NAV  -->
<div class="header_user_info welcome_note">
	<?php if ($_smarty_tpl->tpl_vars['is_logged']->value) {?>
		<?php echo smartyTranslate(array('s'=>'Welcome','mod'=>'blockuserinfo'),$_smarty_tpl);?>
 <span><?php echo $_smarty_tpl->tpl_vars['cookie']->value->customer_firstname;?>
 <?php echo $_smarty_tpl->tpl_vars['cookie']->value->customer_lastname;?>
</span>
	<?php } else { ?>
		<?php echo smartyTranslate(array('s'=>'Welcome','mod'=>'blockuserinfo'),$_smarty_tpl);?>
<span><?php echo smartyTranslate(array('s'=>'Guest','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</span>
	<?php }?>
</div>
<div class="header_user_info last">
	<?php if ($_smarty_tpl->tpl_vars['is_logged']->value) {?>
		<a class="logout" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('index',true,null,"mylogout"), ENT_QUOTES, 'UTF-8', true);?>
" rel="nofollow" title="<?php echo smartyTranslate(array('s'=>'Log me out','mod'=>'blockuserinfo'),$_smarty_tpl);?>
">
			<?php echo smartyTranslate(array('s'=>'Sign out','mod'=>'blockuserinfo'),$_smarty_tpl);?>

		</a>
	<?php } else { ?>
		<a class="login" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
" rel="nofollow" title="<?php echo smartyTranslate(array('s'=>'Log in to your customer account','mod'=>'blockuserinfo'),$_smarty_tpl);?>
">
			<?php echo smartyTranslate(array('s'=>'Sign in','mod'=>'blockuserinfo'),$_smarty_tpl);?>

		</a>
	<?php }?>
</div>
<div class="header_user_info">
	<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink($_smarty_tpl->tpl_vars['order_process']->value,true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'View my shopping cart','mod'=>'blockuserinfo'),$_smarty_tpl);?>
" rel="nofollow">
		<?php echo smartyTranslate(array('s'=>'My Cart','mod'=>'blockuserinfo'),$_smarty_tpl);?>

	</a>
</div>
<div class="header_user_info">
	<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'View my customer account','mod'=>'blockuserinfo'),$_smarty_tpl);?>
" rel="nofollow">
		<?php echo smartyTranslate(array('s'=>'My Account','mod'=>'blockuserinfo'),$_smarty_tpl);?>

	</a>
</div>
<div class="header_user_info">
	<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getModuleLink('blockwishlist','mywishlist',array(),true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'My wishlists','mod'=>'blockuserinfo'),$_smarty_tpl);?>
" rel="nofollow">
		<?php echo smartyTranslate(array('s'=>'Wishlist','mod'=>'blockuserinfo'),$_smarty_tpl);?>

	</a>
</div>
<div class="header_user_info">
	<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink(((string)$_smarty_tpl->tpl_vars['order_process']->value),true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Check out','mod'=>'blockuserinfo'),$_smarty_tpl);?>
" rel="nofollow">
		<?php echo smartyTranslate(array('s'=>'Check out','mod'=>'blockuserinfo'),$_smarty_tpl);?>

	</a>
</div>
<!-- /Block usmodule NAV --><?php }} ?>
