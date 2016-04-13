<?php /* Smarty version Smarty-3.1.19, created on 2015-09-08 23:29:18
         compiled from "/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/admin3120tsmcd/themes/default/template/helpers/list/list_action_delete.tpl" */ ?>
<?php /*%%SmartyHeaderCode:214564915955ef30067f9ea6-95850112%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5103335496e85da01d5d0396de03f4297e414cc3' => 
    array (
      0 => '/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/admin3120tsmcd/themes/default/template/helpers/list/list_action_delete.tpl',
      1 => 1425652760,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '214564915955ef30067f9ea6-95850112',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'href' => 0,
    'confirm' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55ef3006830a22_58336855',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55ef3006830a22_58336855')) {function content_55ef3006830a22_58336855($_smarty_tpl) {?>
<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['href']->value, ENT_QUOTES, 'UTF-8', true);?>
"<?php if (isset($_smarty_tpl->tpl_vars['confirm']->value)) {?> onclick="if (confirm('<?php echo $_smarty_tpl->tpl_vars['confirm']->value;?>
')){return true;}else{event.stopPropagation(); event.preventDefault();};"<?php }?> title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8', true);?>
" class="delete">
	<i class="icon-trash"></i> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8', true);?>

</a><?php }} ?>
