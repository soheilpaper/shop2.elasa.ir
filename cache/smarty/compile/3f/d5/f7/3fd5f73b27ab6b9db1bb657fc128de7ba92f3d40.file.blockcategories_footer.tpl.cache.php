<?php /* Smarty version Smarty-3.1.19, created on 2015-09-08 23:26:21
         compiled from "/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/themes/pos_bstore1/modules/blockcategories/blockcategories_footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:160518370155ef2f556f2249-19309797%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3fd5f73b27ab6b9db1bb657fc128de7ba92f3d40' => 
    array (
      0 => '/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/themes/pos_bstore1/modules/blockcategories/blockcategories_footer.tpl',
      1 => 1434652892,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '160518370155ef2f556f2249-19309797',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'widthColumn' => 0,
    'isDhtml' => 0,
    'blockCategTree' => 0,
    'child' => 0,
    'numberColumn' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55ef2f5576f3d9_11702032',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55ef2f5576f3d9_11702032')) {function content_55ef2f5576f3d9_11702032($_smarty_tpl) {?>

<div class="blockcategories_footer">
<!-- Block categories module -->
	<h4 class="title_block"><?php echo smartyTranslate(array('s'=>'Categories','mod'=>'blockcategories'),$_smarty_tpl);?>
</h4>
<div class="category_footer" style="float:left;clear:none;width:<?php echo $_smarty_tpl->tpl_vars['widthColumn']->value;?>
%">
	<div style="float:left" class="list">
		<ul class="tree <?php if ($_smarty_tpl->tpl_vars['isDhtml']->value) {?>dhtml<?php }?>">
	
		<?php  $_smarty_tpl->tpl_vars['child'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['child']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['blockCategTree']->value['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['child']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['child']->iteration=0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['blockCategTree']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['child']->key => $_smarty_tpl->tpl_vars['child']->value) {
$_smarty_tpl->tpl_vars['child']->_loop = true;
 $_smarty_tpl->tpl_vars['child']->iteration++;
 $_smarty_tpl->tpl_vars['child']->last = $_smarty_tpl->tpl_vars['child']->iteration === $_smarty_tpl->tpl_vars['child']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['blockCategTree']['iteration']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['blockCategTree']['last'] = $_smarty_tpl->tpl_vars['child']->last;
?>
			<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['blockCategTree']['last']) {?>
				<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['branche_tpl_path']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array('node'=>$_smarty_tpl->tpl_vars['child']->value,'last'=>'true'), 0);?>

			<?php } else { ?>
				<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['branche_tpl_path']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array('node'=>$_smarty_tpl->tpl_vars['child']->value), 0);?>

			<?php }?>
		
			<?php if (($_smarty_tpl->getVariable('smarty')->value['foreach']['blockCategTree']['iteration']%$_smarty_tpl->tpl_vars['numberColumn']->value)==0&&!$_smarty_tpl->getVariable('smarty')->value['foreach']['blockCategTree']['last']) {?>
		</ul>
	</div>
</div>

<div class="category_footer" style="float:left;clear:none;width:<?php echo $_smarty_tpl->tpl_vars['widthColumn']->value;?>
%">
		<div style="float:left" class="list">
		<ul class="tree <?php if ($_smarty_tpl->tpl_vars['isDhtml']->value) {?>dhtml<?php }?>">
			<?php }?>
			<?php } ?>
		</ul>
	</div>
</div>
<br class="clear"/>
<!-- /Block categories module -->
</div>
<?php }} ?>
