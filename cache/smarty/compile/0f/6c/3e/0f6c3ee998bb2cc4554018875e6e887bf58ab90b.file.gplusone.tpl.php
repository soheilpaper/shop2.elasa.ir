<?php /* Smarty version Smarty-3.1.19, created on 2015-09-08 23:26:20
         compiled from "/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/modules/gplusone/gplusone.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6593759155ef2f5403cd95-20352442%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0f6c3ee998bb2cc4554018875e6e887bf58ab90b' => 
    array (
      0 => '/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/modules/gplusone/gplusone.tpl',
      1 => 1440995182,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6593759155ef2f5403cd95-20352442',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'gpo_default_hook' => 0,
    'gpo_layout' => 0,
    'gpo_count' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55ef2f54092b54_48106042',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55ef2f54092b54_48106042')) {function content_55ef2f54092b54_48106042($_smarty_tpl) {?><script type="text/javascript">
function track_plusone(gpovote) {
_gaq.push(['_trackEvent', 'Social Shares', 'Google +1 Vote', gpovote.href]);
}
</script>
<?php if ($_smarty_tpl->tpl_vars['gpo_default_hook']->value) {?>
<li>
<?php } else { ?>

<div class="gplusone_container">
<?php }?>
	<g:plusone size="<?php echo $_smarty_tpl->tpl_vars['gpo_layout']->value;?>
" count="<?php if ($_smarty_tpl->tpl_vars['gpo_count']->value=='1') {?>true<?php } else { ?>false<?php }?>"></g:plusone>
<?php if ($_smarty_tpl->tpl_vars['gpo_default_hook']->value) {?>
</li>
<?php } else { ?>
</div>
<?php }?><?php }} ?>
