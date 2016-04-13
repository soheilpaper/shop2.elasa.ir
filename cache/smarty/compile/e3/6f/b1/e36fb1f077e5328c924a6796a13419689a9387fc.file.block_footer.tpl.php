<?php /* Smarty version Smarty-3.1.19, created on 2015-09-08 23:26:21
         compiled from "/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/modules/posstaticfooter/block_footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:105053191155ef2f556231b1-58533562%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e36fb1f077e5328c924a6796a13419689a9387fc' => 
    array (
      0 => '/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/modules/posstaticfooter/block_footer.tpl',
      1 => 1427906714,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '105053191155ef2f556231b1-58533562',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'staticblocks' => 0,
    'block' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55ef2f5566ac59_67262460',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55ef2f5566ac59_67262460')) {function content_55ef2f5566ac59_67262460($_smarty_tpl) {?>
	<?php  $_smarty_tpl->tpl_vars['block'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['block']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['staticblocks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['block']->key => $_smarty_tpl->tpl_vars['block']->value) {
$_smarty_tpl->tpl_vars['block']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['block']->key;
?>
		<?php if ($_smarty_tpl->tpl_vars['block']->value['active']==1) {?>
			<p class ="title_block"> <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['block']->value['title'];?>
<?php $_tmp14=ob_get_clean();?><?php echo smartyTranslate(array('s'=>$_tmp14),$_smarty_tpl);?>
 </p>
		      
		<?php }?>
		<?php echo $_smarty_tpl->tpl_vars['block']->value['description'];?>

		<?php if ($_smarty_tpl->tpl_vars['block']->value['insert_module']==1) {?>
		      <?php echo $_smarty_tpl->tpl_vars['block']->value['block_module'];?>

		 <?php }?>
	<?php } ?>

<?php }} ?>
