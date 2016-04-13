<?php /* Smarty version Smarty-3.1.19, created on 2015-09-09 00:07:03
         compiled from "/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/admin3120tsmcd/themes/default/template/controllers/modules/warning_module.tpl" */ ?>
<?php /*%%SmartyHeaderCode:128790947955ef38df836cc0-72999869%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '349a9d89481cd0a30733f55dc4bf32672270b8ad' => 
    array (
      0 => '/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/admin3120tsmcd/themes/default/template/controllers/modules/warning_module.tpl',
      1 => 1425652760,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '128790947955ef38df836cc0-72999869',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module_link' => 0,
    'text' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55ef38df8f0272_63729260',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55ef38df8f0272_63729260')) {function content_55ef38df8f0272_63729260($_smarty_tpl) {?>
<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['module_link']->value, ENT_QUOTES, 'UTF-8', true);?>
"><?php echo $_smarty_tpl->tpl_vars['text']->value;?>
</a><?php }} ?>
