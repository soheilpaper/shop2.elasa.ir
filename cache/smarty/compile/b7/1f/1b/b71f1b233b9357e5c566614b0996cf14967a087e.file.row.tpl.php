<?php /* Smarty version Smarty-3.1.19, created on 2015-09-08 23:29:18
         compiled from "/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/admin3120tsmcd/themes/default/template/helpers/kpi/row.tpl" */ ?>
<?php /*%%SmartyHeaderCode:162002959155ef300610ee16-61103929%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b71f1b233b9357e5c566614b0996cf14967a087e' => 
    array (
      0 => '/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/admin3120tsmcd/themes/default/template/helpers/kpi/row.tpl',
      1 => 1425652760,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '162002959155ef300610ee16-61103929',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'kpis' => 0,
    'kpi' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55ef3006148a56_26238296',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55ef3006148a56_26238296')) {function content_55ef3006148a56_26238296($_smarty_tpl) {?>
<div class="panel kpi-container">
	<div class="row">
		<div class="col-lg-2" style="float:right"><button class="close refresh" type="button" onclick="refresh_kpis();"><i class="process-icon-refresh" style="font-size:1em"></i></button></div>
		<?php  $_smarty_tpl->tpl_vars['kpi'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['kpi']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['kpis']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['kpi']->key => $_smarty_tpl->tpl_vars['kpi']->value) {
$_smarty_tpl->tpl_vars['kpi']->_loop = true;
?>
		<div class="col-sm-5 col-lg-2">
			<?php echo $_smarty_tpl->tpl_vars['kpi']->value;?>

		</div>			
		<?php } ?>
	</div>
</div><?php }} ?>
