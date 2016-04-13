<?php /* Smarty version Smarty-3.1.19, created on 2015-09-08 23:28:24
         compiled from "/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/themes/pos_bstore1/modules/blockcategories/views/blockcategories_admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:170074843055ef2fd04a0b51-95361233%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8f5e71dc7c38b27ba0add1e825c9971d16206e01' => 
    array (
      0 => '/var/lib/openshift/55e37f347628e110a30000f4/app-root/data/current/themes/pos_bstore1/modules/blockcategories/views/blockcategories_admin.tpl',
      1 => 1434652892,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '170074843055ef2fd04a0b51-95361233',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'helper' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55ef2fd04fbb96_69602094',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55ef2fd04fbb96_69602094')) {function content_55ef2fd04fbb96_69602094($_smarty_tpl) {?>
<div class="form-group">
	<label class="control-label col-lg-3">
		<span class="label-tooltip" data-toggle="tooltip" data-html="true" title="" data-original-title="<?php echo smartyTranslate(array('s'=>'You can upload a maximum of 3 images.','mod'=>'blockcategories'),$_smarty_tpl);?>
">
			<?php echo smartyTranslate(array('s'=>'Thumbnails','mod'=>'blockcategories'),$_smarty_tpl);?>

		</span>
	</label>
	<div class="col-lg-4">
		<?php echo $_smarty_tpl->tpl_vars['helper']->value;?>

	</div>
</div>
<?php }} ?>
