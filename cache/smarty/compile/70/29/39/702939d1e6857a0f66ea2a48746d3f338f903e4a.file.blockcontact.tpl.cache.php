<?php /* Smarty version Smarty-3.1.19, created on 2015-09-08 23:26:20
         compiled from "/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/themes/pos_bstore1/modules/blockcontact/blockcontact.tpl" */ ?>
<?php /*%%SmartyHeaderCode:55479990155ef2f540a3310-87664789%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '702939d1e6857a0f66ea2a48746d3f338f903e4a' => 
    array (
      0 => '/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/themes/pos_bstore1/modules/blockcontact/blockcontact.tpl',
      1 => 1434972438,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '55479990155ef2f540a3310-87664789',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'telnumber' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55ef2f540ff7f6_62144822',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55ef2f540ff7f6_62144822')) {function content_55ef2f540ff7f6_62144822($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['telnumber']->value!='') {?>
	<div id="contact_block">
		<h3><?php echo smartyTranslate(array('s'=>'call us free','mod'=>'blockcontact'),$_smarty_tpl);?>
</h3>
		<span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['telnumber']->value, ENT_QUOTES, 'UTF-8', true);?>
</span>
	</div>
<?php }?><?php }} ?>
