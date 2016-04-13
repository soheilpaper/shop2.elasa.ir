<?php /* Smarty version Smarty-3.1.19, created on 2015-09-09 00:17:54
         compiled from "/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/modules/blockuseronline/blockuseronline.tpl" */ ?>
<?php /*%%SmartyHeaderCode:111030695055ef3b6a2f7814-52935661%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'daf2f63cbe87d5a306bca2ab7c9895fb42dfae96' => 
    array (
      0 => '/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/modules/blockuseronline/blockuseronline.tpl',
      1 => 1440996568,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '111030695055ef3b6a2f7814-52935661',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_dir' => 0,
    'useronline' => 0,
    'today' => 0,
    'total' => 0,
    'yourip' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55ef3b6a33abc0_53988839',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55ef3b6a33abc0_53988839')) {function content_55ef3b6a33abc0_53988839($_smarty_tpl) {?><!-- MODULE Flash Clock -->
    <div id="informations_block_right" class="block">
    	<h4><img align="absmiddle" src="<?php echo $_smarty_tpl->tpl_vars['base_dir']->value;?>
modules/blockuseronline/online.gif"/> <?php echo smartyTranslate(array('s'=>'User Online','mod'=>'blockuseronline'),$_smarty_tpl);?>
</h4>
            	<div align="right" class="block_content" style="padding:3px 10px;">
                <?php echo smartyTranslate(array('s'=>'User Online:','mod'=>'blockuseronline'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['useronline']->value;?>
<br>
                <?php echo smartyTranslate(array('s'=>'Today Accessed:','mod'=>'blockuseronline'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['today']->value;?>
<br>
                <?php echo smartyTranslate(array('s'=>'Total Accessed:','mod'=>'blockuseronline'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['total']->value;?>
<br>
                <?php echo smartyTranslate(array('s'=>'Your IP:','mod'=>'blockuseronline'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['yourip']->value;?>

    			</div>
    </div>
<!-- /MODULE Flash Clock --><?php }} ?>
